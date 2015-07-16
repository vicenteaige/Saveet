<?php

namespace App\Http\Controllers;



use Log;
use App\Http\Requests;
use Illuminate\Http\Request;

/*
 * Twitter Api Exchange
 * Ad "j7mbo/twitter-api-php": "dev-master" to your package.json
 * run composer.phar (install or update)
 * run php composer.phar dump-auto
*/
use TwitterAPIExchange;

class TwitterController extends Controller
{
    // TODO move this to configuration

    private $settings = array(
        'consumer_key'              => "S6Nh2SWU2zBLkkdxX0vthJu9H",
        'consumer_secret'           => "YN8KRgcQgcb5WHnENJ2m8azAKDlD0ISq3iODwd5EKjGa2w4mc6",
        'oauth_access_token'        => "2830115382-NR19AHCRMPV0wq6p8yk5SRxCwIMLdhoRTb4SjDB",
        'oauth_access_token_secret' => "aaPY6B8MlPdvDa3546MlE0pj69lm5GS4N3ZDTWGBb6NrS"
    );

    /**
     * Display the Top 10 World Trends
     *
     * @return Response
     */
    public function index()
    {

        $url = 'https://api.twitter.com/1.1/trends/place.json';
        $getfield = '?id=1';
        $requestMethod = 'GET';

        $twitter = new TwitterAPIExchange($this->settings);
        $response = $twitter->setGetfield($getfield)
            ->buildOauth($url, $requestMethod)
            ->performRequest();

        Log::debug($response);

        return response()
                    ->json(json_decode($response)[0])
                    ->header('Content-Type', 'application/json');

    }
}
