<?php

// database/migrations/xxxx_xx_xx_create_exams_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamsTable extends Migration
{
    public function up()
    {
        Schema::create('exams', function (Blueprint $table) {
            $table->id();
            $table->string('exam_name');
            $table->unsignedBigInteger('teacher_id');
            $table->date('exam_date');
            $table->time('exam_time');
            $table->time('duration');
            $table->timestamps();

            $table->foreign('teacher_id')->references('id')->on('teachers')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('exams');
    }
}


