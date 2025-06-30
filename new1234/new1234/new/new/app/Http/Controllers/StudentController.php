<?php

namespace App\Http\Controllers;


use App\Models\Student;
use App\Models\Teacher;
use App\Models\Subject;
use App\Models\Section;
use App\Models\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use App\Mail\StudentCredentialsMail;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::with('section')->get();
        return view('admin.students.index', compact('students'));
    }


    public function create()
    {
        $sections = Section::all(); // Fetch all sections
        $subjects = Subject::all(); // Fetch all subjects

        return view('admin.students.create', compact('sections', 'subjects'));
    }



    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'father_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:students',
            'mobile_number' => 'required|string|max:20',
            'section_id' => 'required|exists:sections,id', // Use section_id
            'password' => 'required|string|min:8|confirmed',
            'admission_no' => 'required|string|max:255|unique:students',
            'gender' => 'required|string|max:10',
            // 'religion' => 'required|string|max:50',
            'dob' => 'required|date',
            'roll_number' => 'required|string|max:50|unique:students',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $path = null;
        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('student_photos', 'public');
        }

        $student = Student::create([
            'name' => $request->name,
            'father_name' => $request->father_name,
            'email' => $request->email,
            'mobile_number' => $request->mobile_number,
            'section_id' => $request->section_id, // Use section_id
            'password' => Hash::make($request->password),
            'admission_no' => $request->admission_no,
            'gender' => $request->gender,
            // 'religion' => $request->religion,
            'dob' => $request->dob,
            'roll_number' => $request->roll_number,
            'photo' => $path,
        ]);

        Mail::to($student->email)->send(new StudentCredentialsMail($student, $request->password));
        // Log the creation
    Log::create([
        'message' => sprintf('Student %s (Admission No: %s) created by Admin %s on %s',
            $student->name,
            $student->admission_no,
            auth()->user()->name,
            now()->toDateTimeString()
        ),
    ]);

        return redirect()->route('admin.students.index')->with('success', 'Student registered successfully and email sent.');
    }

    public function edit($id)
    {
        $student = Student::findOrFail($id);
        $sections = Section::all();
        $subjects = Subject::with('section')->get(); // Ensure you have section data with subjects

        return view('admin.students.edit', compact('student', 'sections', 'subjects'));
    }


    public function update(Request $request, $id)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'father_name' => 'required|string|max:255',
            'admission_no' => 'required|string|max:255',
            'section_id' => 'required|exists:sections,id', // Ensure section_id is required and valid
            'gender' => 'required|string|in:male,female,other',
            // 'religion' => 'required|string|in:hindi,jain,other',
            'email' => 'required|email',
            'dob' => 'required|date',
            'mobile_number' => 'required|string|max:15',
            'roll_number' => 'required|string|max:255',
            'password' => 'nullable|confirmed|min:8',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'subjects' => 'nullable|array',
            'subjects.*' => 'exists:subjects,id', // Validate that each subject ID exists
        ]);

        $student = Student::findOrFail($id);
        $student->update([
            'name' => $request->input('name'),
            'father_name' => $request->input('father_name'),
            'admission_no' => $request->input('admission_no'),
            'section_id' => $request->input('section_id'),
            'gender' => $request->input('gender'),
            // 'religion' => $request->input('religion'),
            'email' => $request->input('email'),
            'dob' => $request->input('dob'),
            'mobile_number' => $request->input('mobile_number'),
            'roll_number' => $request->input('roll_number'),
            'photo' => $request->file('photo') ? $request->file('photo')->store('photos', 'public') : $student->photo,
        ]);

        // Handle password update
        if ($request->filled('password')) {
            $student->update([
                'password' => bcrypt($request->input('password')),
            ]);
        }

        // Sync subjects
        $student->subjects()->sync($request->input('subjects', []));
        // Log the update
    Log::create([
        'message' => sprintf('Student %s (Admission No: %s) updated by Admin %s on %s',
            $student->name,
            $student->admission_no,
            auth()->user()->name,
            now()->toDateTimeString()
        ),
    ]);

        return redirect()->route('admin.students.index')->with('success', 'Student updated successfully.');
    }


    public function destroy(Student $student)
    {
        if ($student->photo) {
            Storage::disk('public')->delete($student->photo);
        }
        $student->delete();
        // Log the deletion
    Log::create([
        'message' => sprintf('Student %s (Admission No: %s) deleted by Admin %s on %s',
            $student->name,
            $student->admission_no,
            auth()->user()->name,
            now()->toDateTimeString()
        ),
    ]);

        return redirect()->route('admin.students.index')->with('success', 'Student deleted successfully.');
    }

    public function show($id)
    {
        $student = Student::with('section')->findOrFail($id);

        // Debugging
        if (!$student->section) {
            dd('No section found for this student');
        }

        $teachers = Teacher::whereHas('subjects', function ($query) use ($student) {
            $query->where('teacher_section_subject.section_id', $student->section_id); // Specify table name
        })->with(['subjects' => function ($query) use ($student) {
            $query->wherePivot('teacher_section_subject.section_id', $student->section_id); // Specify table name
        }, 'exams'])->get();

        return view('admin.students.show', compact('student', 'teachers'));
    }

}

