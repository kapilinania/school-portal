<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamStudentTable extends Migration
{
    public function up()
    {
        Schema::create('exam_student', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('students')->onDelete('cascade');
            $table->foreignId('exam_id')->constrained('exams')->onDelete('cascade');
            $table->boolean('submitted')->default(false); // Add the 'submitted' column
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('exam_student');
    }
}
