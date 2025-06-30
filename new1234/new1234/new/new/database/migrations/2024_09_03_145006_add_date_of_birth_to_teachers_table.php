<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDateOfBirthToTeachersTable extends Migration
{
    public function up()
    {
        Schema::table('teachers', function (Blueprint $table) {
            $table->date('date_of_birth')->nullable(); // Add date_of_birth column
        });
    }

    public function down()
    {
        Schema::table('teachers', function (Blueprint $table) {
            $table->dropColumn('date_of_birth'); // Remove the column if the migration is rolled back
        });
    }
}
