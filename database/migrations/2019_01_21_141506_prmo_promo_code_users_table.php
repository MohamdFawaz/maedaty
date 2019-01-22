<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PrmoPromoCodeUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promo_codes', function(Blueprint $table)
    {
        $table->increments('id');
        $table->string('code');
        $table->string('valid_times');
        $table->timestamp('valid_from')->nullable();
        $table->timestamp('valid_to')->nullable();
        $table->integer('status')->default(0);
        $table->timestamps();
        $table->softDeletes();

    });

        Schema::create('user_apply_promos',function (Blueprint $table){
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('promo_id');
            $table->integer('order_id')->default(0);
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
