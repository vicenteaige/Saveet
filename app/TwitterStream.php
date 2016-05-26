<?php
/**
 * Created by PhpStorm.
 * User: Vicente
 * Date: 25/5/16
 * Time: 20:19
 */

namespace App;

use OauthPhirehose;
use App\Jobs\ProcessTweet;
use Illuminate\Foundation\Bus\DispatchesJobs;


/**
 * @property mixed consumerKey
 * @property mixed consumerSecret
 */
class TwitterStream extends OauthPhirehose
{
    use DispatchesJobs;

    /**
     * Enqueue each status
     *
     * @param string $status
     */
    public function enqueueStatus($status)
    {
        $this->dispatch(new ProcessTweet($status));
    }

}