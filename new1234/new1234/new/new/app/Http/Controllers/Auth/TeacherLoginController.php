<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Models\Teacher;
use App\Models\Student;
use App\Models\Exam;

class TeacherLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.teacher-login');
    }

    public function login(Request $request)
    {
        $this->validateLogin($request);

        if ($this->attemptLogin($request)) {
            return redirect()->intended('/teacher/dashboard');
        }

        throw ValidationException::withMessages([
            'teacher_id' => [trans('auth.failed')],
        ]);
    }

    protected function validateLogin(Request $request)
    {
        $request->validate([
            'teacher_id' => 'required|string',
            'password' => 'required|string',
        ]);
    }

    protected function attemptLogin(Request $request)
    {
        $credentials = $this->credentials($request);

        return Auth::guard('teacher')->attempt($credentials, $request->filled('remember'));
    }

    protected function credentials(Request $request)
    {
        return [
            'teacher_id' => $request->input('teacher_id'),
            'password' => $request->input('password'),
        ];
    }

    public function dashboard()
    {
        $teacher = Auth::guard('teacher')->user()->load('subjects');
        $students = Student::where('section', $teacher->section)->get();
        $exams = Exam::where('section', $teacher->section)->get();

        return view('teacher.dashboard', compact('teacher', 'students', 'exams'));
    }
}




