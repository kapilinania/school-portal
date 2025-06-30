<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'section_id'];

    // Many-to-many relationship with Teacher
    public function teachers()
    {
        return $this->belongsToMany(Teacher::class, 'teacher_section_subject', 'subject_id', 'teacher_id')
                    ->withPivot('section_id')
                    ->withTimestamps();
    }

    // Many-to-many relationship with Student
    public function students()
    {
        return $this->belongsToMany(Student::class, 'student_subject', 'subject_id', 'student_id');
    }

    // One-to-many relationship with Exam
    public function exams()
    {
        return $this->hasMany(Exam::class);
    }

    // Belongs-to relationship with Section
    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id');
    }
}
