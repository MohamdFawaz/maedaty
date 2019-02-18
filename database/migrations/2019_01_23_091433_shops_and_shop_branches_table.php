<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ShopsAndShopBranchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('shops', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('user_id');
            $table->integer('status')->default(0);
            $table->string('image')->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::create('shop_translations', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('shop_id')->unsigned();
            $table->string('name');
            $table->string('description');
            $table->string('locale')->index();
            $table->unique(['shop_id','locale']);
            $table->foreign('shop_id')->references('id')->on('shops')->onDelete('cascade');
        });

        Schema::create('shop_branches', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('shop_id');
            $table->text('address')->nullable();
            $table->decimal('lat',11,7)->nullable();
            $table->decimal('lng', 11, 7)->nullable();
            $table->timestamps();
            $table->foreign('shop_id')->references('id')->on('shops')->onDelete('cascade');
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
