<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentExam extends Model
{
    use HasFactory;

    protected $fillable = ['student_id', 'exam_id', 'score', 'answers', 'updated_points', 'result_generated'];

    protected $casts = [
        'answers' => 'array',
        'updated_points' => 'array',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }

    public function exam()
    {
        return $this->belongsTo(Exam::class, 'exam_id');
    }

    public function updateAnswer($questionId, $score)
    {
        $updatedPoints = $this->updated_points ?? [];
        $updatedPoints[$questionId] = $score;
        $this->updated_points = $updatedPoints;
        $this->save();
    }
    
}
