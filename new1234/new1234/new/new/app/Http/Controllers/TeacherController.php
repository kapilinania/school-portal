<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\Subject;
use App\Models\Student;
use App\Models\Section;
use App\Models\Exam;
use App\Models\Question;
use App\Models\StudentExam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use App\Mail\TeacherCredentialsMail;
use Illuminate\Support\Facades\DB;
use App\Models\Log;
use Illuminate\Support\Facades\Auth;


class TeacherController extends Controller
{
    

    public function index()
    {
        $teachers = Teacher::with('subjects')->get();
        return view('admin.teachers.index', compact('teachers'));
    }

    public function create()
    {
        // Retrieve distinct sections from the sections table, not the subjects table
        $sections = Section::all(); // Assuming 'name' is the column for section names
        $subjects = Subject::all(); // Retrieve all subjects
    
        return view('admin.teachers.create', compact('sections', 'subjects'));
    }
    

    public function edit(Teacher $teacher)
    {
        // $sections = Subject::distinct()->pluck('section');
        $sections = Section::all();
        $subjects = Subject::all();
        return view('admin.teachers.edit', compact('teacher', 'sections', 'subjects'));
    }


    public function store(Request $request)
{
    // Validate incoming request
    $request->validate([
        'name' => 'required|string|max:255',
        'teacher_id' => 'required|string|max:255|unique:teachers',
        'email' => 'required|string|email|max:255|unique:teachers',
        'password' => 'required|string|min:8|confirmed',
        'mobile_number' => 'required|string|max:20',
        'sections' => 'required|array',
        'sections.*' => 'exists:sections,id',
        'subjects' => 'required|array',
        'subjects.*' => 'exists:subjects,id',
        'date_of_birth' => 'required|date',
        'profile_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    // Handle profile image upload if exists
    $path = null;
    if ($request->hasFile('profile_image')) {
        $path = $request->file('profile_image')->store('profile_images', 'public');
    }

    // Create the teacher record
    $teacher = Teacher::create([
        'name' => $request->name,
        'teacher_id' => $request->teacher_id,
        'email' => $request->email,
        'mobile_number' => $request->mobile_number,
        'password' => Hash::make($request->password),
        'date_of_birth' => $request->date_of_birth,
        'profile_image' => $path,
    ]);

    // Attach sections and subjects to the teacher
    foreach ($request->sections as $sectionId) {
        foreach ($request->subjects[$sectionId] ?? [] as $subjectId) {
            $teacher->subjects()->attach($subjectId, ['section_id' => $sectionId]);
        }
    }

    // Optionally, send an email with credentials (if needed)
    Mail::to($teacher->email)->send(new TeacherCredentialsMail($teacher, $request->password));

    // Redirect back with success message
    return redirect()->route('admin.teachers.index')->with('success', 'Teacher registered successfully and email sent.');
}










public function update(Request $request, Teacher $teacher)
{
    // Validate the request
    $request->validate([
        'name' => 'required|string|max:255',
        'teacher_id' => 'required|string|max:255|unique:teachers,teacher_id,' . $teacher->id,
        'email' => 'required|string|email|max:255|unique:teachers,email,' . $teacher->id,
        'password' => 'nullable|string|min:8|confirmed',
        'mobile_number' => 'required|string|max:20',
        'date_of_birth' => 'required|date',
        'profile_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        'sections' => 'required|array',
        'subjects' => 'required|array',
    ]);

    // Handle image upload
    $path = $teacher->profile_image;
    if ($request->hasFile('profile_image')) {
        if ($path) {
            Storage::disk('public')->delete($path);  // Remove the old image
        }
        $path = $request->file('profile_image')->store('profile_images', 'public');
    }

    // Check for duplicate subject assignments
    foreach ($request->sections as $section) {
        foreach ($request->subjects as $subjectId) {
            $existingTeacher = Teacher::whereHas('subjects', function ($query) use ($subjectId, $section, $teacher) {
                $query->where('subject_id', $subjectId)
                      ->where('teacher_section_subject.section_id', $section) // Adjust column name
                      ->where('teacher_section_subject.teacher_id', '!=', $teacher->id);
            })->first();
            
            

            if ($existingTeacher) {
                return redirect()->back()->withErrors(['subjects' => 'A teacher is already assigned to this subject in this section.']);
            }
        }
    }

    // Update the teacher
    $teacher->update([
        'name' => $request->name,
        'teacher_id' => $request->teacher_id,
        'email' => $request->email,
        'password' => $request->password ? Hash::make($request->password) : $teacher->password,
        'mobile_number' => $request->mobile_number,
        'date_of_birth' => $request->date_of_birth,
        'profile_image' => $path,
    ]);

    // Sync subjects with section data
    $subjectsWithSections = [];
    foreach ($request->subjects as $subjectId) {
        $subject = Subject::find($subjectId);
        $subjectsWithSections[$subjectId] = ['section_id' => $subject->section_id]; // Adjust field names as necessary
    }

    $teacher->subjects()->sync($subjectsWithSections);


    return redirect()->route('admin.teachers.index')->with('success', 'Teacher updated successfully.');
}




    public function destroy(Teacher $teacher)
    {
        if ($teacher->profile_image) {
            Storage::disk('public')->delete($teacher->profile_image);
        }
        $teacher->delete();

        return redirect()->route('admin.teachers.index')->with('success', 'Teacher deleted successfully.');
    }

    public function show($id)
    {
        $teacher = Teacher::with(['subjects' => function($query) {
            $query->withPivot('section_id'); // Ensure correct column name
        }, 'exams.subject'])->findOrFail($id);
        return view('admin.teachers.show', compact('teacher'));
    }



    public function dashboard()
{
    // Get the currently authenticated teacher
    $teacher = auth()->user()->load('subjects');

    // Fetch all sections associated with the teacher's subjects
    $sectionIds = $teacher->subjects->pluck('pivot.section_id')->unique();

    // Fetch all students for the sections that the teacher's subjects are in
    $students = Student::whereIn('section_id', $sectionIds)->with('subjects')->get();

    // Fetch section details (including name) for these sections
    $sections = Section::whereIn('id', $sectionIds)->get()->keyBy('id');

    // Prepare class-wise student count
    $classWiseCounts = [];
    foreach ($teacher->subjects as $subject) {
        $sectionId = $subject->pivot->section_id;

        // Ensure the section exists in our results
        if (!isset($classWiseCounts[$sectionId])) {
            $classWiseCounts[$sectionId] = [
                'section_name' => $sections[$sectionId]->name ?? 'Unknown Section',
                'subjects' => [],
            ];
        }

        // Get students for the current section and subject
        $subjectStudents = $students->filter(function ($student) use ($subject) {
            return $student->subjects->contains($subject->id);
        });

        // Store the student count in the class-wise count array
        $classWiseCounts[$sectionId]['subjects'][$subject->name] = [
            'student_count' => $subjectStudents->unique('id')->count(),
            'students' => $subjectStudents->unique('id'), // Store unique students
        ];
    }

    // Calculate total unique students assigned to the teacher
    $totalStudents = $students->unique('id')->count();

    // Calculate total subjects assigned to the teacher
    $totalSubjects = $teacher->subjects->count();

    return view('teacher.dashboard', compact('teacher', 'classWiseCounts', 'totalStudents', 'totalSubjects'));
}



    

    





    // ----generateresult is here--- 
    
    public function teacherstudentlist()
{
    // Load the authenticated teacher with their subjects and the related sections
    $teacher = auth()->user()->load('subjects');

    // Get the section IDs that the teacher is responsible for
    $sectionIds = $teacher->subjects->pluck('pivot.section_id')->unique();

    // Fetch students that belong to those sections
    $students = Student::with('section') // Include section data for displaying class/section name
        ->whereIn('section_id', $sectionIds)
        ->get();

    // Fetch exams related to the sections the teacher is responsible for
    $exams = Exam::whereIn('section_id', $sectionIds)
        ->with('studentResults') // Load student results for the exams
        ->get();

    // Group subjects by section ID
    $sectionSubjects = [];
    foreach ($teacher->subjects as $subject) {
        $sectionId = $subject->pivot->section_id;
        if (!isset($sectionSubjects[$sectionId])) {
            $sectionSubjects[$sectionId] = [];
        }
        $sectionSubjects[$sectionId][] = $subject->name;
    }

    // Pass the teacher, students, exams, and sectionSubjects to the view
    return view('teacher.teacherstudentlist', compact('teacher', 'students', 'exams', 'sectionSubjects'));
}



    public function createExam()
    {
        return view('teacher.exams.create');
    }

    public function storeExam(Request $request)
    {
        $request->validate([
            'exam_name' => 'required|string|max:255',
            'section' => 'required|string|max:255',
            'exam_date' => 'required|date',
            'exam_time' => 'required',
            'duration' => 'required'
        ]);

        Exam::create([
            'exam_name' => $request->exam_name,
            'section' => $request->section,
            'exam_date' => $request->exam_date,
            'exam_time' => $request->exam_time,
            'duration' => $request->duration
        ]);

        return redirect()->route('teacher.exams.index')->with('success', 'Exam scheduled successfully.');
    }

    public function showGenerateResultsPage()
    {
        // Fetch necessary data for the view
        $students = Student::all(); // Adjust as necessary
        $exams = Exam::all(); // Adjust as necessary

        return view('teacher.generateresult', compact('students', 'exams'));
    }


    public function generateResults(Request $request)
    {
        $request->validate([
            'students' => 'required|array',
        ]);

        foreach ($request->students as $studentExamId) {
            $studentExam = StudentExam::findOrFail($studentExamId);
            $studentExam->update(['result_generated' => true]);
        }

        return redirect()->back()->with('success', 'Results generated successfully.');
    }

//total student fetch based on class and subject wise 
public function totalstudentindex()
{
    // Get the authenticated teacher
    $teacher = auth()->user();

    // Get the sections and subjects assigned to this teacher
    $assignedSections = $teacher->sections->pluck('id');
    $assignedSubjects = $teacher->subjects->pluck('id');

    // Fetch students who are in the teacher's assigned sections and studying the teacher's assigned subjects
    $students = Student::whereIn('section_id', $assignedSections)
                ->whereHas('subjects', function($query) use ($assignedSubjects) {
                    $query->whereIn('subject_id', $assignedSubjects);
                })
                ->with('section') // Eager load section data
                ->get();

    // Group students by section for displaying in the index
    $studentsGroupedBySection = $students->groupBy('section_id')->map(function($group) {
        return [
            'section' => $group->first()->section, // Get section info
            'total_students' => $group->count()    // Count total students in this section
        ];
    });

    // Pass data to the view
    return view('teacher.totalstudent.index', compact('studentsGroupedBySection'));
}


public function showStudentsBySection($id)
{
    // Fetch the section by ID along with its associated subjects
    $section = Section::with(['subjects'])->findOrFail($id);

    // Get the currently logged-in teacher
    $teacher = Auth::user();

    // Get the IDs of the subjects taught by the teacher
    $teacherSubjectIds = $teacher->subjects->pluck('id')->toArray();

    // Fetch the students associated with the section and filter based on subjects and teacher
    $students = Student::where('section_id', $section->id)
        ->whereHas('subjects', function ($query) use ($teacherSubjectIds) {
            $query->whereIn('subjects.id', $teacherSubjectIds);
        })
        ->get();

    // Pass the section and filtered students to the view
    return view('teacher.totalstudent.show', compact('section', 'students'));
}



# this code is belong to total student for teacher inside student section 
    // Method to show total student count per class
    public function studentindex()
    {
        // Fetch the sections assigned to the current teacher
        $assignedSections = Auth::user()->sections->pluck('id');

        // Fetch the total number of students per assigned section, including section names
        $students = Student::select('section_id', \DB::raw('COUNT(id) as total_students'))
                            ->whereIn('section_id', $assignedSections)
                            ->groupBy('section_id')
                            ->with('section') // Eager load the section relationship
                            ->get();

        // Fetch exams for assigned sections (if needed for the view)
        $exams = Exam::whereIn('section_id', $assignedSections)->get();

        // Pass data to the index view
        return view('teacher.student.index', compact('students', 'exams'));
    }

    // Method to show detailed student information for a specific class
    public function studentshow($class)
    {
        // Fetch the sections assigned to the current teacher
        $assignedSections = Auth::user()->sections->pluck('id');

        // Fetch students belonging to the specific class, including section details
        $students = Student::where('section_id', $class)
                            ->whereIn('section_id', $assignedSections)
                            ->with('section') // Eager load the section relationship
                            ->get();

        // Fetch exams for the specific class (if needed for the view)
        $exams = Exam::where('section_id', $class)->get();

        // Pass the students, class name, and exams to the view
        return view('teacher.student.class', compact('students', 'class', 'exams'));
    }

public function studentAnswers($examId, $studentId)
{
    // Fetch the exam and student
    $exam = Exam::findOrFail($examId);
    $student = Student::findOrFail($studentId);

    // Fetch the student's answer sheet
    $studentAnswerSheet = $exam->studentResults()->where('student_id', $studentId)->first();

    // Pass data to the view
    return view('teacher.student_answers', compact('exam', 'student', 'studentAnswerSheet'));
}



//here we are search student

    public function searchStudents(Request $request,$id)
    {
        // Get the logged-in teacher's name
        $teacherName = auth()->user()->name;

        $exam = Exam::with('students')->findOrFail($id);

        $query = Student::query();

        // If exam name is provided, filter by the exam name
        if ($request->filled('exam_name')) {
            $examName = $request->exam_name;
            $examIds = Exam::where('exam_name', 'LIKE', '%' . $examName . '%')
                        ->whereHas('teacher', function($q) use ($teacherName) {
                            $q->where('name', $teacherName);
                        })
                        ->pluck('id');
            $query->whereHas('studentExams', function ($q) use ($examIds) {
                $q->whereIn('exam_id', $examIds);
            });
        }

        // If section name is provided, filter by the section name
        if ($request->filled('section_name')) {
            $sectionName = $request->section_name;
            $sectionIds = Section::where('name', 'LIKE', '%' . $sectionName . '%')->pluck('id');
            $query->whereIn('section_id', $sectionIds);
        }

        // Get the filtered students with their section and exam details
        $students = $query->with(['section', 'studentExams.exam.teacher'])
                        ->get();

        // Pass the students and other necessary data to the view
        return view('teacher.student.fetchdata', compact('exam','students'));
        
    }


 



    

    }

    
