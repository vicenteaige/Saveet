<?php
/**
 * Created by PhpStorm.
 * User: Vicente
 * Date: 5/6/16
 * Time: 20:19
 */

namespace App\Http\Controllers;


use Auth;
use App\Http\Requests;
use DB;
use Exception;

class TweetController extends Controller
{
    public function apiGetLatestTweets(){
        $user = Auth::user();

        try{
            $latestTweets = DB::select('select * from tweets t
                                    join hashtag_tweet ht on t.id = ht.tweet_id
                                    join hashtag_user hu on ht.hashtag_id = hu.hashtag_id
                                    where hu.user_id = ?
                                    order by t.created_at desc limit 6;', [$user->id]);

            $httpStatus = 200;
            $outcome = 'yes';
            $error = 'Ok';

            foreach ($latestTweets as $key=>$element){
                $json = json_decode($latestTweets[$key]->json, true);
                $latestTweets[$key]->name = $json['user']['name'];
            }

            return response()->api($httpStatus, $outcome, $error, $latestTweets);
        }catch (Exception $e){
            $httpStatus = 500;
            $outcome = 'no';
            $error = 'Server error';

            return response()->api($httpStatus, $outcome, $error, '');
        }

    }

    public function apiGetGraph(){
        $user = Auth::user();

        $latestTweets = DB::select('SELECT
                                      DATE_FORMAT(
                                        MIN(t.created_at),
                                        \'%d/%m/%Y %H:%i:00\'
                                      ) AS tmstamp,
                                      hashtag,
                                      COUNT(id) AS cnt
                                    FROM
                                      tweets t
                                    join hashtag_tweet ht on t.id = ht.tweet_id
                                    join hashtag_user hu on ht.hashtag_id = hu.hashtag_id
                                    where hu.user_id = ?
                                    GROUP BY ROUND(UNIX_TIMESTAMP(t.created_at) / 1850), hashtag ORDER BY tmstamp ASC;', [$user->id]);

        $latestTweets = json_decode(json_encode($latestTweets), true);

        $result = array();
        foreach($latestTweets as $item){
            $result[] = array('date' => $item['tmstamp'], $item['hashtag'] => $item['cnt']);
        }
/*
        $fp = fopen('/var/www/app/public/json/tweetsGraph.json', 'w');
        fwrite($fp, json_encode($result));
        fclose($fp);
        // file_put_contents('/var/www/app/public/test/tweetsGraph.json', json_encode($result));

*/
        $httpStatus = 200;
        $outcome = 'yes';
        $error = 'Ok';

        return response()->api($httpStatus, $outcome, $error, $result);



    }

}