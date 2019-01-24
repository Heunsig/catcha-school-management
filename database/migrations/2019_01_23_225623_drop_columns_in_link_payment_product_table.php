<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropColumnsInLinkPaymentProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('link_payment_product', function (Blueprint $table) {
            $table->dropColumn(['start_date', 'completion_date']);
            $table->integer('week')->nullable()->after('quantity');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('link_payment_product', function (Blueprint $table) {
            $table->date('start_date')->nullable()->after('quantity');
            $table->date('completion_date')->nullable()->after('start_date');
            $table->dropColumn('week');
        });
    }
}
