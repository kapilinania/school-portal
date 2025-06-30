<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeachersTable extends Migration
{
    public function up()
{
    Schema::create('teachers', function (Blueprint $table) {
        $table->id(); // This is an unsignedBigInteger
        $table->string('name');
        $table->string('teacher_id')->unique();
        $table->foreignId('section_id')->constrained()->onDelete('cascade');
        $table->foreignId('subject_id')->constrained()->onDelete('cascade');
        $table->string('email')->unique();
        $table->string('password');
        $table->string('mobile_number');
        $table->string('profile_image')->nullable();
        $table->timestamps();
    });
}


    public function down()
    {
        Schema::dropIfExists('teachers');
    }
}

