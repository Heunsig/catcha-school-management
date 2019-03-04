<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditEmergencyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('emergency_contact', function (Blueprint $table) {
            $table->string('email')->after('name');
            $table->string('type')->nullable()->after('relationship');
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
            $table->dropColumn(['email', 'type']);
        });
    }
}
