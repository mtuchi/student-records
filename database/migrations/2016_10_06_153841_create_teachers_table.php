<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->nullable();
			      $table->foreign('user_id')->references('id')->on('users');
            $table->integer('grade_id')->unsigned()->nullable();
			      $table->foreign('grade_id')->references('id')->on('grades');
            $table->integer('subject_id')->unsigned()->nullable();
			      $table->foreign('subject_id')->references('id')->on('subjects');
            $table->string('slug');
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
        Schema::dropIfExists('teachers');
    }
}
