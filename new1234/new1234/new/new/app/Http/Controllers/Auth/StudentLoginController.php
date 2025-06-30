<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Teacher;
use App\Models\Section;
use App\Models\Subject;
use App\Models\Exam;
use Illuminate\Validation\ValidationException;

class StudentLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.student-login');
    }

    public function login(Request $request)
    {
        $this->validateLogin($request);

        if ($this->attemptLogin($request)) {
            return redirect()->intended('/student/dashboard');
        }

        throw ValidationException::withMessages([
            'admission_no' => [trans('auth.failed')],
        ]);
    }

    protected function validateLogin(Request $request)
    {
        $request->validate([
            'admission_no' => 'required|string',
            'password' => 'required|string',
        ]);
    }

    protected function attemptLogin(Request $request)
    {
        $credentials = $this->credentials($request);

        return Auth::guard('student')->attempt($credentials, $request->filled('remember'));
    }

    protected function credentials(Request $request)
    {
        return [
            'admission_no' => $request->input('admission_no'),
            'password' => $request->input('password'),
        ];
    }

    public function dashboard()
{
    $student = Auth::guard('student')->user();

    // Get the student's section
    $studentSection = Section::find($student->section_id);

    // Fetch teachers who have subjects with the student's section
    $teachers = Teacher::whereHas('subjects', function($query) use ($student) {
        $query->where('teacher_section_subject.section_id', $student->section_id);
    })->with(['subjects' => function($query) use ($student) {
        $query->wherePivot('section_id', $student->section_id);
    }])->get();

    // Get all subjects assigned to the student
    $studentSubjects = Subject::where('section_id', $student->section_id)->get();

    // Count the number of teachers
    $teacherCount = $teachers->count();

    // Pass all data to the view
    return view('student.dashboard', compact('student', 'teachers', 'studentSection', 'studentSubjects', 'teacherCount'));
}


    




public function examdashboard()
{
    // Get the logged-in student
    $student = Auth::guard('student')->user();

    // Fetch the student's section
    $studentSection = Section::find($student->section_id);

    // Fetch the subjects assigned to the student based on their section
    $studentSubjects = Subject::where('section_id', $student->section_id)->get();

    // Fetch the teachers associated with the student's section and subjects
    $teachers = Teacher::whereHas('subjects', function ($query) use ($student) {
        $query->where('teacher_section_subject.section_id', $student->section_id);
    })->with(['subjects' => function ($query) use ($student) {
        $query->wherePivot('section_id', $student->section_id);
    }])->get();

    // Fetch exams that are linked to the student's section and subjects
    $exams = Exam::whereIn('subject_id', $studentSubjects->pluck('id'))
                  ->where('section_id', $student->section_id)
                  ->get();

    // Count the number of teachers assigned to the student's subjects
    $teacherCount = $teachers->count();

    // Pass the data to the exam dashboard view
    return view('student.examdashboard', compact('student', 'studentSection', 'studentSubjects', 'teachers', 'exams', 'teacherCount'));
}






    public function resultgenerate()
    {
        $student = Auth::guard('student')->user();
        
        // Fetch teachers who have subjects with the student's section
        $teachers = Teacher::whereHas('subjects', function($query) use ($student) {
            $query->where('teacher_section_subject.section_id', $student->section_id);
        })->with(['subjects' => function($query) use ($student) {
            $query->wherePivot('section_id', $student->section_id);
        }, 'exams' => function($query) use ($student) {
            $query->where('section_id', $student->section_id);
        }])->get();
        
        return view('student.resultgenerate', compact('student', 'teachers'));
    }


}


