<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLinkClassStudentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('link_class_student', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('classinfo_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->datetime('created_at');
            $table->integer('created_by')->unsigned();
            $table->datetime('updated_at')->nullable();
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
        Schema::dropIfExists('link_class_student');
    }
}
