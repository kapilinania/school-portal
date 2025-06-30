<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\StudentController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\Auth\StudentLoginController;
use App\Http\Controllers\Auth\TeacherLoginController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\StudentExamController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\PageController;

Route::get('/', function () {
    return view('welcome');
});

//basic routes is here

// Home Page Route
Route::get('', [PageController::class, 'index'])->name('home');

// About Page Route
Route::get('about', [PageController::class, 'about'])->name('about');

// Contact Page Route
Route::get('/contact', [PageController::class, 'contact'])->name('contact');

// Course Page Route
Route::get('/course', [PageController::class, 'course'])->name('course');

// Detail Page Route
Route::get('/detail', [PageController::class, 'detail'])->name('detail');
Route::get('/detail/{id}', [PageController::class, 'detail'])->name('course.detail');
Route::get('/enroll', [PageController::class, 'enroll'])->name('enroll');

// Feature Page Route
Route::get('basic/feature', [PageController::class, 'feature'])->name('feature');

// Team Page Route
Route::get('basic/team', [PageController::class, 'team'])->name('team');

// Testimonial Page Route
Route::get('basic/testimonial', [PageController::class, 'testimonial'])->name('testimonial');

// contact Page Route
Route::get('basic/contact', [PageController::class, 'contact'])->name('contact');


Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
});
//admin 
Route::middleware(['auth', AdminMiddleware::class])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');

    Route::resource('admin/teachers', TeacherController::class)->names([
        'index' => 'admin.teachers.index',
        'create' => 'admin.teachers.create',
        'store' => 'admin.teachers.store',
        'show' => 'admin.teachers.show',
        'edit' => 'admin.teachers.edit',
        'update' => 'admin.teachers.update',
        'destroy' => 'admin.teachers.destroy',
    ]);

    Route::resource('admin/students', StudentController::class)->names([
        'index' => 'admin.students.index',
        'create' => 'admin.students.create',
        'store' => 'admin.students.store',
        'show' => 'admin.students.show',
        'edit' => 'admin.students.edit',
        'update' => 'admin.students.update',
        'destroy' => 'admin.students.destroy',
    ]);

    Route::resource('admin/subjects', SubjectController::class)->except(['show'])->parameters(['subjects' => 'section'])->names([
        'index' => 'admin.subjects.index',
        'create' => 'admin.subjects.create',
        'store' => 'admin.subjects.store',
        'edit' => 'admin.subjects.edit',
        'update' => 'admin.subjects.update',
        'destroy' => 'admin.subjects.destroy',
    ]);
    // Route for deleting a specific subject
    Route::delete('admin/subjects/{section}/subject', [SubjectController::class, 'destroy'])->name('admin.subjects.destroy.subject');

    Route::resource('admin/sections', SectionController::class)->names([
        'index' => 'admin.sections.index',
        'create' => 'admin.sections.create',
        'store' => 'admin.sections.store',
        'edit' => 'admin.sections.edit',
        'update' => 'admin.sections.update',
        'destroy' => 'admin.sections.destroy',
    ]);

    Route::get('/admin/subjects-by-section', [SubjectController::class, 'getSubjectsBySection']);
    Route::get('/admin/profile', [AdminController::class, 'showProfile'])->name('admin.profile');
    Route::post('/admin/profile', [AdminController::class, 'updateProfile'])->name('admin.profile.update');
});


// For student login    
Route::get('/student/login', [StudentLoginController::class, 'showLoginForm'])->name('student.login');
Route::post('/student/login', [StudentLoginController::class, 'login'])->name('student.login.submit');

// Student routes
Route::middleware('auth:student')->group(function () {
    Route::get('/student/dashboard', [StudentLoginController::class, 'dashboard'])->name('student.dashboard');
    Route::get('/student/examdashboard', [StudentLoginController::class, 'examdashboard'])->name('student.examdashboard');
    Route::get('/student/resultgenerate', [StudentLoginController::class, 'resultgenerate'])->name('student.resultgenerate');

    // Exam routes
    Route::get('/student/exams', [StudentExamController::class, 'index'])->name('student.exams.index');
    Route::get('/student/exams/{exam}/instruction', [StudentExamController::class, 'showInstruction'])->name('student.show.instruction');
    Route::get('/student/exams/{exam}/rules', [StudentExamController::class, 'showRules'])->name('student.show.rules');
    Route::get('/student/exams/{exam}/start', [StudentExamController::class, 'startExam'])->name('student.start.exam');
    Route::get('/student/exams/{exam}', [StudentExamController::class, 'show'])->name('student.exams.show');
    Route::post('/student/exams/{exam}/submit', [StudentExamController::class, 'submit'])->name('student.exams.submit');
    
    // Additional routes for profile or other functionalities can go here
});



// For teacher login
// Authentication routes
Route::get('teacher/login', [TeacherLoginController::class, 'showLoginForm'])->name('teacher.login');
Route::post('teacher/login', [TeacherLoginController::class, 'login']);

// Routes for authenticated teachers
Route::middleware('auth:teacher')->group(function () {
    Route::get('/teacher/dashboard', [TeacherController::class, 'dashboard'])->name('teacher.dashboard');
    Route::get('/teacher/generateresult', [TeacherController::class, 'generateresult'])->name('teacher.generateresult');
    // Route to show the list of students
    Route::get('teacher/teacher-student-list', [TeacherController::class, 'teacherStudentList'])->name('teacher.teacherstudentlist');
    // Route to show total student count per class
    Route::get('teacher/total-students', [TeacherController::class, 'studentindex'])->name('teacher.student.index');
    Route::get('/teacher/student/search', [TeacherController::class, 'searchStudents'])->name('teacher.search.students');

    // Route to show detailed student information for a specific class
    Route::get('teacher/total-students/{class}', [TeacherController::class, 'studentshow'])->name('teacher.student.show');

    


    // Exam resource routes
    Route::resource('teacher/exams', ExamController::class)->names([
        'index' => 'teacher.exams.index',
        'create' => 'teacher.exams.create',
        'store' => 'teacher.exams.store',
        'edit' => 'teacher.exams.edit',
        'update' => 'teacher.exams.update',
        'destroy' => 'teacher.exams.destroy',
    ]);

    Route::get('/teacher/exams/{id}/student-detail', [TeacherController::class, 'searchStudents'])->name('teacher.exams.student_detail');
    Route::get('teacher/exams/{id}/student-detail', [TeacherController::class, 'searchStudents'])
    ->name('teacher.exams.studentDetail');

    // Question routes
    Route::prefix('teacher/exams/{exam}')->group(function () {
        Route::get('questions', [QuestionController::class, 'index'])->name('teacher.questions.index');
        Route::get('questions/create', [QuestionController::class, 'create'])->name('teacher.questions.create');
        Route::post('questions', [QuestionController::class, 'store'])->name('teacher.questions.store');
        Route::get('questions/{question}/edit', [QuestionController::class, 'edit'])->name('teacher.questions.edit');
        Route::put('questions/{question}', [QuestionController::class, 'update'])->name('teacher.questions.update');
        Route::delete('questions/{question}', [QuestionController::class, 'destroy'])->name('teacher.questions.destroy');
        Route::get('questions/{student}/answers', [QuestionController::class, 'showStudentAnswers'])->name('teacher.questions.student_answers');
    });
    Route::put('/teacher/exams/{exam}/questions/{id}', [QuestionController::class, 'update'])->name('teacher.questions.update');
    Route::get('/teacher/questions/exam-details', [ExamController::class, 'showExamDetails'])->name('teacher.exams.details');

    // Additional routes
    Route::post('/teacher/update-scores/{studentExam}', [QuestionController::class, 'updateScores'])->name('teacher.updateScores');
    // Add this route to handle displaying the result generation page
    Route::get('/teacher/generate-results', [TeacherController::class, 'showGenerateResultsPage'])->name('teacher.showGenerateResultsPage');

    // Keep your POST route for form submission
    Route::post('/teacher/generate-results', [TeacherController::class, 'generateResults'])->name('teacher.generateResults');


    //for student data fetch 

    // Route for total student count per class
    Route::get('/teacher/total-students', [TeacherController::class, 'totalstudentindex'])->name('teacher.totalstudent.index');
    
    // Route for viewing detailed student information for a specific class
    Route::get('/teacher/total-students/{class}', [TeacherController::class, 'showStudentsBySection'])->name('teacher.totalstudent.show');
    
});



