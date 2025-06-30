<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeacherSectionSubjectTable extends Migration
{
    public function up()
    {
        Schema::create('teacher_section_subject', function (Blueprint $table) {
            $table->unsignedBigInteger('teacher_id');
            $table->unsignedBigInteger('subject_id');
            $table->unsignedBigInteger('section_id');

            $table->timestamps();

            // Foreign key constraints
            $table->foreign('teacher_id')->references('id')->on('teachers')->onDelete('cascade');
            $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('cascade');
            $table->foreign('section_id')->references('id')->on('sections')->onDelete('cascade');

            // Composite primary key
            $table->primary(['teacher_id', 'subject_id', 'section_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('teacher_section_subject');
    }
}
