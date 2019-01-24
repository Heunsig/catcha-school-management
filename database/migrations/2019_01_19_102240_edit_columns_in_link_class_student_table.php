<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditColumnsInLinkClassStudentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('link_class_student', function (Blueprint $table) {
            $table->datetime('updated_at')->nullable()->change();
            $table->integer('updated_by')->nullable()->unsigned()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('link_class_student', function (Blueprint $table) {
            $table->datetime('updated_at')->nullable($value = false)->change();
            $table->integer('updated_by')->nullable($value = false)->unsigned()->change();
        });
    }
}
