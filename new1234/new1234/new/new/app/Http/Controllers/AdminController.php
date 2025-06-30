<?php

// app/Http/Controllers/AdminController.php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Section;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
// use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;


class AdminController extends Controller
{
    public function index(Request $request)
{
    $selectedSubject = $request->get('subject');
    $selectedSection = $request->get('section_id');
    $selectedStudentSection = $request->get('student_section');

    $teachers = Teacher::with(['subjects' => function ($query) use ($selectedSubject, $selectedSection) {
        if ($selectedSubject) {
            $query->where('name', $selectedSubject);
        }
        if ($selectedSection) {
            $query->wherePivot('section_id', $selectedSection);
        }
    }, 'exams'])->get();

    //recent student here i am get
    $recentStudents = Student::orderBy('created_at', 'desc')->limit(5)->get();

    $students = Student::with('examResults.exam')->when($selectedStudentSection, function ($query) use ($selectedStudentSection) {
        return $query->where('section_id', $selectedStudentSection);
    })->get();

    $subjects = Subject::pluck('name');
    $sections = Section::distinct()->pluck('name'); 
    $studentSections = Student::distinct()->pluck('section_id');

    // Get the count of students, teachers, sections, and subjects
    $studentCount = Student::count();
    $teacherCount = Teacher::count();
    $sectionCount = Section::count();
    $subjectCount = Subject::count();

    // Pie chart data
    $pieChartData = [
        'labels' => ['Teachers', 'Students'],
        'series' => [$teacherCount, $studentCount],
    ];
    //next chart data
    $nextChartData = [
        'labels' => ['Sections', 'Subjects'],
        'series' => [$sectionCount, $subjectCount],
    ];

    // Fetch logs from the database
    $logs = Log::latest()->limit(10)->get(); // Fetch the last 10 logs

    return view('admin.dashboard', compact(
        'teachers', 'students', 'subjects', 'sections', 'studentSections',
        'selectedSubject', 'selectedSection', 'selectedStudentSection',
        'studentCount', 'teacherCount', 'sectionCount', 'subjectCount',
        'pieChartData', 'recentStudents', 'nextChartData', 'logs'
    ));
}




    //admin profile is here

    public function showProfile()
    {
        $admin = Auth::user(); // This will get the current logged-in user (admin)
        return view('admin.profile', compact('admin'));
    }

    // Update profile method
    public function updateProfile(Request $request)
    {
        $admin = Auth::user();

        // Validate inputs
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $admin->id,
            'password' => 'nullable|min:8|confirmed',
            'old_password' => 'required'
        ]);

        // Check if the old password matches the current password
        if (!Hash::check($request->old_password, $admin->password)) {
            return redirect()->back()->with('error', 'Old password does not match.');
        }

        // Update name and email
        $admin->name = $request->name;
        $admin->email = $request->email;

        // Update password only if a new password is provided
        if ($request->filled('password')) {
            $admin->password = Hash::make($request->password);
        }

        // Save the updated profile
        $admin->save();

        // Store log in the database
        $logMessage = sprintf(
            'Admin %s updated their profile on %s',
            $admin->name,
            now()->toDateTimeString()
        );

        // Save the log to the logs table
        Log::create([
            'message' => $logMessage,
        ]);

        return redirect()->back()->with('success', 'Profile updated successfully.');
    }

}
