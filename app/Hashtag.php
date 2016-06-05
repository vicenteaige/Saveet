<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hashtag extends Model
{
    protected $table = "hashtags";

    /**
     * Get the users associated with the given hashtag.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany('App\User')->withTimestamps();
    }

    /**
     * Get the tweet associated with the given hashtag.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tweets()
    {
        return $this->belongsToMany('App\Tweet')->withTimestamps();
    }
}
