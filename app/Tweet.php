<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tweet extends Model
{
    protected $fillable = ['tweet_id','json','tweet_text', 'hashtag', 'user_id','user_screen_name','user_avatar_url','public'];

    public function hashtags()
    {
        return $this->belongsToMany('App\Hashtag')->withTimestamps();
    }
}
