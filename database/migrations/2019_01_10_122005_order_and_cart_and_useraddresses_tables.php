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
            $table->string('order_number');
            $table->string('order_products');
            $table->string('order_qty');
            $table->integer('delivery_address');
            $table->integer('order_status')->default(0);
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
