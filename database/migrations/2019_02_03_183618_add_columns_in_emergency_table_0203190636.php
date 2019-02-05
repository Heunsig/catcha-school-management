<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsInEmergencyTable0203190636 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('emergency_contact', function (Blueprint $table) {
            $table->string('category')->default('cellphone')->after('number');
            $table->string('email')->nullable()->after('category');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('emergency_contact', function (Blueprint $table) {
            $table->dropColumn(['category', 'email']);
        });
    }
}
