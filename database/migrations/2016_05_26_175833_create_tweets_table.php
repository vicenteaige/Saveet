<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateTweetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tweets', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tweet_id');
            $table->text('json');
            $table->string('tweet_text')->nullable();
            $table->string('hashtag');
            $table->string('user_id')->nullable();
            $table->string('user_screen_name')->nullable();
            $table->string('user_avatar_url')->nullable();
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
        Schema::drop('tweets');
    }
}
