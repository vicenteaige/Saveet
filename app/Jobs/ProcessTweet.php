<?php

namespace App\Jobs;

use App\Jobs\Job;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessTweet extends Job implements SelfHandling
{
    use InteractsWithQueue, SerializesModels;

    protected $tweet;
    /**
     * Create a new job instance.
     *
     * @return void
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

        // TODO: TESTING! Implement better tweet handling
        $tweet = json_decode($this->tweet,true);
        echo '-------------------------------------------------------------'.PHP_EOL;
        var_dump($tweet['text']) . PHP_EOL;
        var_dump($tweet['id_str']) . PHP_EOL;
        echo '-------------------------------------------------------------'.PHP_EOL;
    }
}
