<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentExamsTable extends Migration
{
    public function up()
    {
        Schema::create('student_exams', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('exam_id');
            $table->integer('score')->nullable();
            $table->json('answers');
            $table->json('updated_points')->nullable();
            $table->timestamps();
            $table->boolean('submitted')->default(false);
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            $table->foreign('exam_id')->references('id')->on('exams')->onDelete('cascade');
            $table->boolean('result_generated')->default(false);
        });
    }

    public function down()
    {
        Schema::dropIfExists('student_exams');
    }
}


