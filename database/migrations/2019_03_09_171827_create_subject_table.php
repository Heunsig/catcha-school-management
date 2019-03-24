<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubjectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subject', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('classinfo_id')->unsigned();
            $table->string('name');
            $table->string('description')->nullable();
            $table->integer('teacher_id')->unsigned()->nullable();
            $table->integer('order')->nullable();
            $table->datetime('created_at');
            $table->integer('created_by')->unsigned()->nullable();
            $table->datetime('updated_at');
            $table->integer('updated_by')->unsigned()->nullable();
            $table->datetime('deleted_at')->nullable();
            $table->integer('deleted_by')->unsigned()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subject');
    }
}
