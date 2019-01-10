<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SocialLogin extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('social_login', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('user_id');
            $table->string('provider')->nullable();
            $table->string('auth_id')->nullable();
            $table->string('username')->nullable();
            $table->string('email')->nullable();
            $table->string('profile_picture')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
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
