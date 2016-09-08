<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentSubjectPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_subject', function (Blueprint $table) {
            $table->integer('student_id')->unsigned()->index();
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            $table->integer('subject_id')->unsigned()->index();
            $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('cascade');
            $table->primary(['student_id', 'subject_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('student_subject');
    }
}
