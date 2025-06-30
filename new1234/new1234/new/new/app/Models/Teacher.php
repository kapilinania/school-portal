<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Teacher extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'name', 'teacher_id', 'email', 'password', 'mobile_number', 'profile_image', 'date_of_birth' , 'section', 'subject'
    ];

    protected $dates = ['date_of_birth']; // This ensures date_of_birth is treated as a date instance

    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'teacher_section_subject')
                    ->withPivot('section_id')
                    ->withTimestamps();
    }

    public function students()
    {
        return $this->belongsToMany(Student::class, 'student_teacher', 'teacher_id', 'student_id');
    }

    public function exams()
    {
        return $this->hasMany(Exam::class);
    }
    // public function sections()
    // {
    //     return $this->belongsToMany(Section::class, 'teacher_section_subject')
    //                 ->withPivot('section_id')
    //                 ->withTimestamps();
    // }

        public function sections()
        {
            return $this->belongsToMany(Section::class, 'teacher_section_subject');
        }

        // public function subjects()
        // {
        //     return $this->belongsToMany(Subject::class, 'teacher_section_subject');
        // }

}
