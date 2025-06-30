<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Question;
use App\Models\Student;
use App\Models\StudentExam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentExamController extends Controller
{
    public function index()
    {
        $student = Auth::guard('student')->user();
        $exams = Exam::where('section_id', $student->section_id)->get();
        return view('student.exams.index', compact('exams'));
    }

    // public function show(Exam $exam)
    // {
    //     $student = Auth::guard('student')->user();
    //     $now = now('Asia/Kolkata');
    //     $examDateTime = $exam->exam_date . ' ' . $exam->exam_time;

    //     // Check if the student has already submitted the exam
    //     $studentExam = StudentExam::where('student_id', $student->id)
    //                             ->where('exam_id', $exam->id)
    //                             ->first();
    //     if ($studentExam) {
    //         return redirect()->route('student.exams.index')->with('error', 'You have already submitted this exam.');
    //     }

    //     if ($now->greaterThanOrEqualTo($examDateTime)) {
    //         $questions = $exam->questions;
    //         $teacher = $exam->teacher; // Fetch the teacher through the relationship
    //         $subject = $exam->subject; // Fetch the subject through the relationship

    //         return view('student.exams.show', [
    //             'exam' => $exam,
    //             'questions' => $questions,
    //             'username' => $student->name,
    //             'teacher' => $teacher ? $teacher->name : 'N/A', // Handle null if no teacher is assigned
    //             'subject' => $subject ? $subject->name : 'N/A', // Handle null if no subject is assigned
    //         ]);
    //     }

    //     return redirect()->route('student.exams.index')->with('error', 'Exam is not available yet.');
    // }

    public function show(Exam $exam)
    {
        $student = Auth::guard('student')->user();

        // Fetch total students assigned to the exam
        $totalStudentsAssigned = $exam->students()->count();

        // Fetch number of students who submitted the exam
        $studentsSubmitted = $exam->students()->wherePivot('submitted', true)->count();

        // Existing logic
        $now = now('Asia/Kolkata');
        $examDateTime = $exam->exam_date . ' ' . $exam->exam_time;

        // Check if the student has already submitted the exam
        $studentExam = StudentExam::where('student_id', $student->id)
                                ->where('exam_id', $exam->id)
                                ->first();
        if ($studentExam) {
            return redirect()->route('student.exams.index')->with('error', 'You have already submitted this exam.');
        }

        if ($now->greaterThanOrEqualTo($examDateTime)) {
            $questions = $exam->questions;
            $teacher = $exam->teacher;
            $subject = $exam->subject;

            return view('student.exams.show', [
                'exam' => $exam,
                'questions' => $questions,
                'username' => $student->name,
                'teacher' => $teacher ? $teacher->name : 'N/A',
                'subject' => $subject ? $subject->name : 'N/A',
                'totalStudentsAssigned' => $totalStudentsAssigned, // Pass total students assigned
                'studentsSubmitted' => $studentsSubmitted, // Pass students who have submitted
            ]);
        }

        return redirect()->route('student.exams.index')->with('error', 'Exam is not available yet.');
    }





    public function submit(Request $request, Exam $exam)
    {
        $student = Auth::guard('student')->user();
        $score = 0;
        $answers = $request->input('answers', []);

        // Check if the student has already submitted the exam
        $studentExam = StudentExam::where('student_id', $student->id)->where('exam_id', $exam->id)->first();
        if ($studentExam) {
            return redirect()->route('student.exams.index')->with('error', 'You have already submitted this exam.');
        }

        $storedAnswers = [];
        foreach ($answers as $questionId => $answer) {
            $question = Question::find($questionId);
            if ($question) {
                if ($question->question_type == 'objective' && $question->correct_option == $answer) {
                    $score += $question->points;
                }
                $storedAnswers[$questionId] = $answer;
            }
        }

        StudentExam::create([
            'student_id' => $student->id,
            'exam_id' => $exam->id,
            'score' => $score,
            'answers' => $storedAnswers,
        ]);

        return redirect()->route('student.exams.index')->with('success', 'Thank you for completing the exam.');
    }

    public function showInstruction(Exam $exam)
    {
        $student = Auth::guard('student')->user();
        return view('student.exams.instruction', compact('exam', 'student'));
    }

    public function showRules(Exam $exam)
    {
        return view('student.exams.rule', compact('exam'));
    }

    public function startExam(Exam $exam)
    {
        $student = Auth::guard('student')->user();
        $now = now('Asia/Kolkata');
        $examDateTime = $exam->exam_date . ' ' . $exam->exam_time;

        // Check if the student has already submitted the exam
        $studentExam = StudentExam::where('student_id', $student->id)->where('exam_id', $exam->id)->first();
        if ($studentExam) {
            return redirect()->route('student.exams.index');
        }

        if ($now->greaterThanOrEqualTo($examDateTime)) {
            return redirect()->route('student.exams.show', $exam->id);
        }

        return redirect()->route('student.exams.index')->with('error', 'Exam is not available yet.');
    }
}
