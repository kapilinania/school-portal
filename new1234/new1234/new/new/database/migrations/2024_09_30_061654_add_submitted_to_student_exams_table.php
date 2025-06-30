<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSubmittedToStudentExamsTable extends Migration
{
    public function up()
    {
        // Check if the 'submitted' column already exists
        if (!Schema::hasColumn('student_exams', 'submitted')) {
            Schema::table('student_exams', function (Blueprint $table) {
                $table->boolean('submitted')->default(0);
            });
        }
    }

    public function down()
    {
        Schema::table('student_exams', function (Blueprint $table) {
            $table->dropColumn('submitted');
        });
    }
}
