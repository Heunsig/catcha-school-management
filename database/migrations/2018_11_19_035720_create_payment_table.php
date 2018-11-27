<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('payment_method_id')->unsigned();
            $table->string('status', 50);
            $table->boolean('is_refund')->default(false);
            $table->datetime('payment_date');
            $table->text('note')->nullable();
            $table->datetime('created_at');
            $table->integer('created_by')->unsigned();
            $table->datetime('updated_at')->nullable();
            $table->integer('updated_by')->unsigned()->nullable();
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
        Schema::dropIfExists('payment');
    }
}
