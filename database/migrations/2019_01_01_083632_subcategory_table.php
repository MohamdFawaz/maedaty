<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SubcategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subcategories', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('code');
            $table->string('category_id')->nullable();
            $table->string('category_image')->nullable();
            $table->timestamps();
        });

        Schema::create('subcategory_translations', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('subcategory_id')->unsigned();
            $table->string('name');
            $table->string('locale')->index();
            $table->unique(['subcategory_id','locale']);
            $table->foreign('subcategory_id')->references('id')->on('subcategories')->onDelete('cascade');
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
