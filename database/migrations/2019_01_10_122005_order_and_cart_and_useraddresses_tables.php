<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class OrderAndCartAndUseraddressesTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_carts', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('user_id');
            $table->string('product_id');
            $table->integer('qty');
            $table->foreign('product_id')->references('id')->on('products')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
        Schema::create('orders', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('order_number')->unique();
            $table->integer('user_id');
            $table->string('subtotal_fees');
            $table->string('shipping_fees');
            $table->string('order_products');
            $table->string('order_qty');
            $table->integer('delivery_address_id')->default(0);
            $table->integer('payment_method')->comment('1 for COD, 2 for credit card');
            $table->date('order_date')->nullable();
            $table->time('order_time')->nullable();
            $table->integer('order_status')->default(0)->comment('0 new unconfirmed order, 1 new confirmed order	');
            $table->timestamps();
        });
        Schema::create('addresses', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('user_id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('phone');
            $table->text('address');
            $table->decimal('lat',11,7)->nullable();
            $table->decimal('lng', 11, 7)->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
