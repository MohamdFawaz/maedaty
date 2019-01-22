<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRolesUpdateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('title');
            $table->timestamps();

        });

        Schema::table('users',function (Blueprint $table){
            $table->integer('role_id')->after('lang');
        });

        Schema::create('permissions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 191)->unique();
            $table->string('display_name', 191);
            $table->smallInteger('sort')->unsigned()->default(0);
            $table->boolean('status')->default(1);
            $table->integer('created_by')->unsigned();
            $table->integer('updated_by')->unsigned()->nullable();
            $table->timestamps();
            $table->softDeletes();
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
