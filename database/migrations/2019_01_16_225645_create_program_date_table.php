<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProgramDateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('program_date', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('program_id')->unsigned();
            $table->date('start_date')->nullable();
            $table->date('completion_date')->nullable();
            $table->string('reason')->nullable();
            // $table->datetime('created_at');
            // $table->integer('created_by')->unsigned();
            // $table->datetime('updated_at');
            // $table->integer('updated_by')->unsigned();
            // $table->datetime('deleted_at')->nullable();
            // $table->integer('deleted_by')->unsigned()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('program_date');
    }
}
