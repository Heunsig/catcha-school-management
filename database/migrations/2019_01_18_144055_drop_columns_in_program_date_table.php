<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropColumnsInProgramDateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('program_date', function (Blueprint $table) {
            $table->dropColumn(['created_at', 'created_by', 'updated_at', 'updated_by']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('program_date', function (Blueprint $table) {
            $table->datetime('created_at')->after('reason');
            $table->integer('created_by')->unsigned()->after('created_at');
            $table->datetime('updated_at')->after('created_by');
            $table->integer('updated_by')->unsigned()->after('updated_at');
        });
    }
}
