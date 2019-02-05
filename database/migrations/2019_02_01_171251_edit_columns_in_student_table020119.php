<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditColumnsInStudentTable020119 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('student', function (Blueprint $table) {
            $table->dropColumn(['type_id', 'status_id']);
            $table->string('type', 20)->after('id');
            $table->string('status', 20)->after('type');
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
            $table->dropColumn(['type', 'status']);
            $table->integer('type_id')->unsigned()->after('id');
            $table->integer('status_id')->unsigned()->after('type_id');
        });
    }
}
