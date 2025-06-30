<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Section;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\Teacher;
use App\Models\Subject;


class ExamController extends Controller
{
    public function index()
    {
        $exams = Exam::with(['section', 'subject'])->where('teacher_id', Auth::guard('teacher')->id())->get();
        return view('teacher.exams.index', ['exams' => $exams]);
    }


    public function create()
    {
        $teacher = Auth::guard('teacher')->user()->load('subjects');
        $sections = $teacher->subjects->pluck('section')->unique()->map(function ($section) {
            return (object) ['id' => $section->id, 'name' => $section->name];
        });
        $subjects = $teacher->subjects;

        return view('teacher.exams.create', compact('sections', 'subjects'));
    }


    public function store(Request $request)
{

    // Validate the request
    $request->validate([
        'exam_name' => 'required|string|max:255',
        'section_id' => 'required|exists:sections,id', // Validate the section ID
        'subject_id' => 'required|exists:subjects,id', // Make sure the selected subject exists
        'exam_date' => 'required|date',
        'exam_time' => 'required|date_format:H:i',
        'duration' => 'required|regex:/^[0-9]{2}:[0-9]{2}$/', // Ensures the format HH:MM
    ]);

    // Convert the input exam name to lowercase for comparison
    $examNameInput = strtolower($request->input('exam_name'));

    // Check if an exam with the same name (case-insensitive) already exists for the same teacher
    $existingExam = Exam::whereRaw('LOWER(exam_name) = ?', [$examNameInput])
                        ->where('teacher_id', Auth::guard('teacher')->id()) // Ensure it's the same teacher
                        ->first();

    if ($existingExam) {
        return redirect()->back()->with('error', 'You have already created an exam with this name. Please use a different name.');
    }

    // Check if any other teacher has created an exam with the same name
    $existingExamOtherTeacher = Exam::whereRaw('LOWER(exam_name) = ?', [$examNameInput])
                                    ->where('teacher_id', '!=', Auth::guard('teacher')->id()) // Another teacher
                                    ->first();

    if ($existingExamOtherTeacher) {
        return redirect()->back()->with('error', 'An exam with this name has already been created by another teacher.');
    }

    // Create the exam with section_id and subject_id
    Exam::create([
        'exam_name' => $request->exam_name,
        'section_id' => $request->section_id,  // Use the section ID directly
        'subject_id' => $request->subject_id,  // Store the selected subject ID
        'teacher_id' => Auth::guard('teacher')->id(),
        'exam_date' => $request->exam_date,
        'exam_time' => $request->exam_time,
        'duration' => $request->duration,
    ]);

    return redirect()->route('teacher.exams.index')->with('success', 'Exam created successfully.');
}



    public function edit(Exam $exam)
    {
        $teacher = Auth::guard('teacher')->user()->load('subjects');
        $sections = $teacher->subjects->pluck('section')->unique();
        $subjects = $teacher->subjects;

        // Ensure that the current teacher is editing their own exam
        if ($exam->teacher_id !== Auth::guard('teacher')->id()) {
            return redirect()->back()->with('error', 'You are not authorized to edit this exam.');
        }

        return view('teacher.exams.edit', compact('exam', 'sections', 'subjects'));
    }

    public function update(Request $request, Exam $exam)
    {
        // Validate the request
        $request->validate([
            'exam_name' => 'required|string|max:255',
            'section' => 'required|string|max:255',
            'exam_date' => 'required|date',
            'exam_time' => 'required|date_format:H:i',
            'duration' => 'required|date_format:H:i',
        ]);

        // Ensure that the same teacher doesn't have an exam with the same name
        $existingExam = Exam::where('exam_name', $request->exam_name)
            ->where('teacher_id', Auth::guard('teacher')->id())
            ->where('id', '!=', $exam->id) // Exclude the current exam from the check
            ->first();

        if ($existingExam) {
            return redirect()->back()->with('error', 'You already have an exam with this name. Please use a different name.');
        }

        // Update the exam details
        $exam->update([
            'exam_name' => $request->exam_name,
            'section' => $request->section,
            'exam_date' => $request->exam_date,
            'exam_time' => $request->exam_time,
            'duration' => $request->duration,
        ]);

        return redirect()->route('teacher.exams.index')->with('success', 'Exam updated successfully.');
    }

    public function destroy(Exam $exam)
    {
        // Ensure that the current teacher is deleting their own exam
        if ($exam->teacher_id !== Auth::guard('teacher')->id()) {
            return redirect()->back()->with('error', 'You are not authorized to delete this exam.');
        }

        $exam->delete();
        return redirect()->route('teacher.exams.index')->with('success', 'Exam deleted successfully.');
    }

    public function showExamDetails()
    {
        // Get the logged-in teacher's ID
        $teacherId = Auth::id();

        // Fetch exams created by this teacher with related section and subject data
        $exams = Exam::with(['section', 'subject'])
                    ->where('teacher_id', $teacherId)
                    ->get();

        return view('teacher.questions.exam_details', compact('exams'));
    }

}
