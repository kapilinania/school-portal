<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'exam_id', 'question', 'question_image', 'option_a', 'option_b', 'option_c', 'option_d',
        'correct_option', 'points', 'question_type', 'subjective_answer', 'image','question_status'
    ];

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }
    
}
