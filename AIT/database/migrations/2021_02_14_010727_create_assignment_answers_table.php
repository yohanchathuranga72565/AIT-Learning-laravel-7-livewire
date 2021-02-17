<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssignmentAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assignment_answers', function (Blueprint $table) {
            $table->id();
            $table->string('file');
            $table->foreign('assignment_id')->references('id')->on('assignments');
            $table->unsignedBigInteger('assignment_id');
            $table->foreign('student_id')->references('id')->on('students');
            $table->unsignedBigInteger('student_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('assignment_answers');
    }
}
