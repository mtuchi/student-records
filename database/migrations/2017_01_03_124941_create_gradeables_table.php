<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGradeablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gradeables', function (Blueprint $table) {
            $table->integer('grade_id');
						$table->integer('gradeable_id')->unsigned();
						$table->string('gradeable_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
			 Schema::dropIfExists('gradeables');
    }
}
