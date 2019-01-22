<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class NotificationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('code');
            $table->string('status')->default(0);
            $table->string('target')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();
        });

        Schema::create('notification_translations', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('notification_id')->unsigned();
            $table->string('title');
            $table->string('message');
            $table->string('locale')->index();
            $table->unique(['notification_id','locale']);
            $table->foreign('notification_id')->references('id')->on('notifications')->onDelete('cascade');
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
