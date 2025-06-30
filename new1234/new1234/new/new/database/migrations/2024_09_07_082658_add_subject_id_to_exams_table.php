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
    Schema::table('exams', function (Blueprint $table) {
        $table->unsignedBigInteger('subject_id')->nullable(); // Add subject_id as a foreign key
        $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('cascade');
    });
}

public function down()
{
    Schema::table('exams', function (Blueprint $table) {
        $table->dropForeign(['subject_id']);
        $table->dropColumn('subject_id');
    });
}

};
