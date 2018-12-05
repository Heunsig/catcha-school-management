<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_product_id')->unsigned()->nullable();
            $table->string('name');
            $table->string('description')->nullable();
            $table->integer('price');
            $table->integer('quantity');
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
        Schema::dropIfExists('product');
    }
}