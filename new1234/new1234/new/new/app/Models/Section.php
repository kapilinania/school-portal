<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    // Many-to-many relationship with Teacher through teacher_section_subject pivot
    public function teachers()
    {
        return $this->belongsToMany(Teacher::class, 'teacher_section_subject', 'section_id', 'teacher_id')
                    ->withPivot('subject_id')
                    ->withTimestamps();
    }

    // One-to-many relationship with Exam
    public function exams()
    {
        return $this->hasMany(Exam::class);
    }

    // One-to-many relationship with Subject
    public function subjects()
    {
        return $this->hasMany(Subject::class);
    }

    // One-to-many relationship with Student
    public function students()
    {
        return $this->hasMany(Student::class);
    }
}
