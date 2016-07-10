<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFollowerlistTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('followerlist', function (Blueprint $table) {
           $table->increments('id');
            $table->integer('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            
            $table->integer('follower_id')->unsigned()->index();
            $table->foreign('follower_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
        Schema::create('followinglist', function (Blueprint $table) {
           $table->increments('id');
            $table->integer('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            
            $table->integer('following_id')->unsigned()->index();
            $table->foreign('following_id')->references('id')->on('users')->onDelete('cascade');
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
        //Schema::drop('followerlist');
        //Schema::drop('followinglist');
    }
}
