<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Student extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'name', 'father_name', 'email', 'mobile_number', 'section_id', 'password', 'admission_no', 
        'gender', 'dob', 'roll_number', 'photo'
    ];

    // Many-to-many relationship with Teacher
    public function teachers()
    {
        return $this->belongsToMany(Teacher::class, 'student_teacher', 'student_id', 'teacher_id');
    }

    // Many-to-many relationship with Exam, including the 'submitted' status in the pivot table
    public function exams()
    {
        return $this->belongsToMany(Exam::class, 'exam_student', 'student_id', 'exam_id')
                    ->withPivot('submitted') // 'submitted' is a column in the pivot table
                    ->withTimestamps(); // Track the timestamps
    }

    // Many-to-many relationship with Subject
    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'student_subject', 'student_id', 'subject_id');
    }

    // One-to-many relationship for exam results
    public function examResults()
    {
        return $this->hasMany(StudentExam::class);
    }

    // One-to-many relationship with Section
    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id');
    }

    // One-to-many relationship for student exams
    public function studentExams()
    {
        return $this->hasMany(StudentExam::class);
    }
}
