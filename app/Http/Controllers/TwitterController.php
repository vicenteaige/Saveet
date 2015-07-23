<?php

namespace App\Http\Controllers;

use Log;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Hashtag;
use Redis;
use App\Http\Controllers\DaemonController;

/*
 * Twitter Api Exchange
 * Ad "j7mbo/twitter-api-php": "dev-master" to your composer.json
 * run composer.phar (install)
 * run php composer.phar dump-auto
*/
use TwitterAPIExchange;

class TwitterController extends Controller
{

    # Public Methods

    public function getTrends()
    {
        // TODO laravel connection
        $redis = new Redis();
        $redis->connect('localhost', 6379);

        $redisTrends = json_decode($redis->get('woeid_hashtags'));

        $rs = array("trends"=> []);
        if ($redisTrends){
            $rs["trends"] = $redisTrends;
        }

        return response()
            ->json($rs)
            ->header('Content-Type', 'application/json');
    }

    # Public Methods

    public function daemonServiceTrends()
    {

        $hashtags = Hashtag::all();

        // Api Woeid trends
        $trends = [];
        foreach ($this->getPlaces() as $city => $woeid) {
            $trends = array_merge($trends, $this->requestTrendsByLocation($woeid));
        }
        $woeid_hashtags_encoded = json_encode($trends);

        // User trends
        foreach($hashtags as $hashtag){
            array_push($trends, $hashtag->name);
        }

        // Discard duplicates
        array_unique($trends);

        // Encode trends
        $encodedTrends = json_encode(array($trends));


        // TODO laravel connection
        $redis = new Redis();
        $redis->connect('localhost', 6379);

        // Save woeid_hashtags
        $redis->set('woeid_hashtags', $woeid_hashtags_encoded);

        $redisTrends = json_decode($redis->get('daemon_hashtags'));

        if ($redisTrends == $trends) {
            return response()
                ->json(null)
                ->header('Content-Type', 'application/json');
        }

        $redis->set('daemon_hashtags', $encodedTrends);
        $notify = new DaemonController();
        $notify->updateTrends($trends);


        return response()
            ->json($trends)
            ->header('Content-Type', 'application/json');
    }

    # Private Methods

    /**
     * Loads a twitter auth settings array.
     *
     * @return Array of settings
     */
    private function getTwitterSettings(){
        return array(
            'consumer_key'              => env('TWITTER_CONSUMER_KEY'),
            'consumer_secret'           => env('TWITTER_CONSUMER_SECRET'),
            'oauth_access_token'        => env('TWITTER_OAUTH_ACCESS_TOKEN'),
            'oauth_access_token_secret' => env('TWITTER_OAUTH_ACCESS_TOKEN_SECRET'),
        );
    }

    /**
     * Loads a key-value array of locations and they woeid identifier.
     *
     * @return Array of woeids
     */
    private function getPlaces(){
        return array(
            'worldwide' => 1,
            'barcelona' => 753692,
            'madrid'    => 766273,
            'sevilla'   => 774508,
            'bilbao'    => 754542,
            #'donostia'  => 773418, # No hay data
            #'corunha'   => 763246, # No hay data
            #'leon'      => 765099, # No hay data
            #'santander' => 773964  # No hay data
        );
    }

    /**
     * Returns the Top 10 trends by a given $woeid location.
     *
     * @param $woeid
     * @return Array of Twitter Trends
     * @throws \Exception
     */
    private function requestTrendsByLocation($woeid)
    {

        $url = 'https://api.twitter.com/1.1/trends/place.json';
        $getfield = '?id='.urlencode($woeid);
        $requestMethod = 'GET';

        $twitter = new TwitterAPIExchange($this->getTwitterSettings());

        $rsJsonString = $twitter->setGetfield($getfield)
            ->buildOauth($url, $requestMethod)
            ->performRequest();

        $rsArray = json_decode($rsJsonString, true);

        if (!array_key_exists('errors', $rsArray)){
            $trends = [];
            foreach ($rsArray[0]['trends'] as $trend)
                $trends[] = $trend['name'];
            return $trends;
        }

        abort(500, "Twitter error: ".$rsJsonString);

    }
}
