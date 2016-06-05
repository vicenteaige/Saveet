<?php

namespace App\Jobs;

use App\Hashtag;
use App\Jobs\Job;
use App\Tweet;
use Auth;
use DB;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ProcessTweet extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    protected $tweet;

    /**
     * Create a new job instance.
     *
     * @param $tweet
     */
    public function __construct($tweet)
    {
        $this->tweet = $tweet;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $user = Auth::user();
        // select * from hashtags h  left join hashtag_user hu  on h.id = hu.hashtag_id where hu.user_id = 1;

        $user_hashtags = DB::table('hashtags')
            ->leftJoin('hashtag_user', 'hashtags.id', '=', 'hashtag_user.hashtag_id')
            ->select('hashtags.*')
            ->where('hashtag_user.user_id', 1)
            ->get();

        $tweet = json_decode($this->tweet,true);
        $tweet_text = isset($tweet['text']) ? $tweet['text'] : null;
        $user_id = isset($tweet['user']['id_str']) ? $tweet['user']['id_str'] : null;
        $user_screen_name = isset($tweet['user']['screen_name']) ? $tweet['user']['screen_name'] : null;
        $user_avatar_url = isset($tweet['user']['profile_image_url_https']) ? $tweet['user']['profile_image_url_https'] : null;
        $tweet_text = isset($tweet['text']) ? $tweet['text'] : null;
        $hashtags = isset($tweet['entities']['hashtags']) ? $tweet['entities']['hashtags'] : null;

        if(!is_null($hashtags)){
            foreach ($hashtags as $hashtag){
                foreach ($user_hashtags as $user_hashtag){
                    if (isset($tweet['id']) && $user_hashtag->name == $hashtag['text']) {

                        $create_tweet= Tweet::create([
                            'tweet_id' => $tweet['id_str'],
                            'json' => $this->tweet,
                            'tweet_text' => $tweet_text,
                            'hashtag' => $hashtag['text'],
                            'user_id' => $user_id,
                            'user_screen_name' => $user_screen_name,
                            'user_avatar_url' => $user_avatar_url,
                        ]);

                        // Save hashtag_tweet relation
                        $hashtagObj = new Hashtag();
                        $hashtagObj->id = $user_hashtag->id;
                        $hashtagObj->tweets()->attach($create_tweet->id);


                    }
                }
            }
        }

    }
}
