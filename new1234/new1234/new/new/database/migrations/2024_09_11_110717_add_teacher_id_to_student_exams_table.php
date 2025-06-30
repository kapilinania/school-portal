<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTeacherIdToStudentExamsTable extends Migration
{
    public function up()
    {
        Schema::table('student_exams', function (Blueprint $table) {
            $table->unsignedBigInteger('teacher_id')->nullable();

            // Assuming the teachers table exists with an id column
            $table->foreign('teacher_id')->references('id')->on('teachers')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('student_exams', function (Blueprint $table) {
            $table->dropForeign(['teacher_id']);
            $table->dropColumn('teacher_id');
        });
    }
}

