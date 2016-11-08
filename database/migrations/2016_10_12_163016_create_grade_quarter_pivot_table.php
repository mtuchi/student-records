<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGradeQuarterPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grade_quarter', function (Blueprint $table) {
            $table->integer('grade_id')->unsigned()->index();
            $table->foreign('grade_id')->references('id')->on('grades')->onDelete('cascade');
            $table->integer('quarter_id')->unsigned()->index();
            $table->foreign('quarter_id')->references('id')->on('quarters')->onDelete('cascade');
            $table->primary(['grade_id', 'quarter_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('grade_quarter');
    }
}
