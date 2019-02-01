<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsInStudentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('student', function (Blueprint $table) {
            $table->integer('type_id')->unsigned()->after('id');
            $table->string('email')->unique();
            $table->string('first_name', 50);
            $table->string('middle_name', 50)->nullable();
            $table->string('last_name', 50)->nullable();
            $table->string('nickname', 50)->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('country_of_birth')->nullable();
            $table->string('city_of_birth')->nullable();
            $table->string('country_of_citizenship')->nullable();
            $table->string('sex')->nullable();
            $table->datetime('created_at');
            $table->integer('created_by')->unsigned();
            $table->datetime('updated_at');
            $table->integer('updated_by')->unsigned();
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
        Schema::table('student', function (Blueprint $table) {
            $table->dropColumn([
                'type_id',
                'email',
                'first_name',
                'middle_name',
                'last_name',
                'nickname',
                'date_of_birth',
                'country_of_birth',
                'city_of_birth',
                'country_of_citizenship',
                'sex',
                'created_at',
                'created_by',
                'updated_at',
                'updated_by',
                'deleted_at',
                'deleted_by'
            ]);
        });
    }
}
