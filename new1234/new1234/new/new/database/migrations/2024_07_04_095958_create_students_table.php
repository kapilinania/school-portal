<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('father_name');
            $table->string('email')->unique();
            $table->string('admission_no')->unique();
            $table->string('mobile_number');
            $table->unsignedBigInteger('section_id')->nullable(); // Define section_id as nullable
            $table->string('gender');
            // $table->string('religion');
            $table->date('dob');
            $table->string('roll_number')->unique();
            $table->string('photo')->nullable();
            $table->string('password');
            $table->string('progress')->nullable();
            $table->timestamps();

            // Add foreign key constraint to section_id
            $table->foreign('section_id')->references('id')->on('sections')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            // Drop foreign key constraint first
            $table->dropForeign(['section_id']);
        });

        // Drop the students table
        Schema::dropIfExists('students');
    }
};
