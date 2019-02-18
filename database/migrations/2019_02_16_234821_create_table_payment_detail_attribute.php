<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePaymentDetailAttribute extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_detail_attribute', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('payment_detail_id')->unsigned();
            $table->integer('attribute_id')->unsigned();
            $table->integer('attribute_value_id')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment_detail_attribute');
    }
}
