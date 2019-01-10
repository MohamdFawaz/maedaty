<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('product_name');
            $table->string('product_description')->nullable();
            $table->string('price')->nullable();
            $table->string('product_image')->nullable();
            $table->string('category_id')->nullable();
            $table->string('subcategory_id')->nullable();
            $table->string('status')->default(0);
            $table->timestamps();
        });
        Schema::create('product_translations', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('product_id')->unsigned();
            $table->string('name');
            $table->string('description');
            $table->string('locale')->index();
            $table->unique(['product_id','locale']);
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
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
