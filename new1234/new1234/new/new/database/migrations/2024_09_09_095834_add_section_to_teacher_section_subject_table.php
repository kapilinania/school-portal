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
        Schema::table('teacher_section_subject', function (Blueprint $table) {
            $table->integer('section')->after('subject_id'); // Add the column
        });
    }

    public function down()
    {
        Schema::table('teacher_section_subject', function (Blueprint $table) {
            $table->dropColumn('section');
        });
    }

};
