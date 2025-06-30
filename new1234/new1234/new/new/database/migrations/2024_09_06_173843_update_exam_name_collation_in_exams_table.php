<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateExamNameCollationInExamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('exams', function (Blueprint $table) {
            // Modify the exam_name column to use case-insensitive collation
            \DB::statement("ALTER TABLE exams MODIFY exam_name VARCHAR(255) COLLATE utf8mb4_unicode_ci");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('exams', function (Blueprint $table) {
            // You can specify a collation if you want to revert the changes, or just reset it to the default
            \DB::statement("ALTER TABLE exams MODIFY exam_name VARCHAR(255) COLLATE utf8mb4_bin");
        });
    }
}
