<?php

namespace App\Http\Controllers;



use Log;
use App\Http\Requests;
use Illuminate\Http\Request;

/*
 * Twitter Api Exchange
 * Ad "j7mbo/twitter-api-php": "dev-master" to your package.json
 * run composer.phar (install)
 * run php composer.phar dump-auto
*/
use TwitterAPIExchange;

class TwitterController extends Controller
{

    /**
     * Generates a twitter auth settings array.
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
     * Loads an array of valid woeid places
     *
     * @return Array of woeids
     */
    private function getPlaces(){

    }

    /**
     * Display the Top 10 World Trends
     *
     * @return Response
     */
    public function getWorldTrends()
    {

        $env = env('APP_DEBUG');

        $url = 'https://api.twitter.com/1.1/trends/place.json';
        $getfield = '?id=1';
        $requestMethod = 'GET';

        $twitter = new TwitterAPIExchange($this->getTwitterSettings());
        $response = $twitter->setGetfield($getfield)
            ->buildOauth($url, $requestMethod)
            ->performRequest();

        Log::debug($response);

        return response()
                    ->json(json_decode($response)[0])
                    ->header('Content-Type', 'application/json');

    }

    /**
     * Display trends by location.
     *
     * @return Response
     */
    public function getTrendsByLocation($woeid)
    {

        $url = 'https://api.twitter.com/1.1/trends/place.json';
        $getfield = '?id='.$woeid;
        $requestMethod = 'GET';

        $test = str('sdsd');

        $twitter = new TwitterAPIExchange($this->getTwitterSettings());
        $response = $twitter->setGetfield($getfield)
            ->buildOauth($url, $requestMethod)
            ->performRequest();

        Log::debug($response);

        return response()
            ->json(json_decode($response)[0])
            ->header('Content-Type', 'application/json');

    }
}
