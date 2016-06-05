<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateHashtagTweetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hashtag_tweet', function(Blueprint $table) {

            $table->integer('hashtag_id')->unsigned()->index();
            $table->foreign('hashtag_id')->references('id')->on('hashtags')->onDelete('cascade');
            $table->integer('tweet_id')->unsigned()->index();
            $table->foreign('tweet_id')->references('id')->on('tweets')->onDelete('cascade');
            $table->timestamps();

            /*
            $table->integer('hashtag_id')->unsigned()->index();
            $table->foreign('hashtag_id')->references('id')->on('hashtags')->onDelete('cascade');
            $table->integer('tweet_id')->unsigned()->index();
            $table->foreign('tweet_id')->references('id')->on('tweets')->onDelete('cascade');
            $table->timestamps();
            */
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('hashtag_tweet');
    }
}
