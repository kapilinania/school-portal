<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;

    protected $fillable = ['exam_name', 'section_id', 'teacher_id', 'exam_date', 'exam_time', 'duration', 'subject_id'];

    // One-to-many relationship with Question model
    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    // Belongs to relationship with Teacher
    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }

    // Many-to-many relationship with Student, including the 'submitted' status
    public function students()
    {
        return $this->belongsToMany(Student::class, 'exam_student', 'exam_id', 'student_id')
                    ->withPivot('submitted') // Include the 'submitted' status from pivot table
                    ->withTimestamps(); // if you want to track the timestamps
    }

    // One-to-many relationship with StudentExam model
    public function studentResults()
    {
        return $this->hasMany(StudentExam::class);
    }

    // Get total points of all questions for this exam
    public function getTotalPointsAttribute()
    {
        return $this->questions->sum('points');
    }

    // Get total number of questions for this exam
    public function getTotalQuestionsAttribute()
    {
        return $this->questions->count();
    }

    // Check if an exam name already exists for a teacher
    public static function examNameExistsForTeacher($exam_name, $teacher_id)
    {
        return static::where('exam_name', $exam_name)
                    ->where('teacher_id', $teacher_id)
                    ->exists();
    }

    // Belongs to relationship with Section
    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id');
    }

    // Belongs to relationship with Subject
    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }
}
