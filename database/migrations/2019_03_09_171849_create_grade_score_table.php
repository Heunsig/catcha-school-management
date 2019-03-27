<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGradeScoreTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grade_score', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('grade_group_id')->unsigned();
            $table->integer('student_id')->unsigned();
            $table->integer('classinfo_id')->unsigned();
            $table->integer('subject_id')->unsigned();
            $table->integer('score');
            $table->datetime('date');
            $table->datetime('updated_at');
            $table->integer('updated_by')->unsigned()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('grade_score');
    }
}
