<?php
/**
 * Created by PhpStorm.
 * User: Vicente
 * Date: 28/5/16
 * Time: 19:22
 */

namespace App\Http\Controllers;


use App\Hashtag;
use Artisan;
use Illuminate\Support\Facades\DB;

class TweetCommandController
{

    /**
     * UpdateCommandController constructor.
     */
    public function __construct()
    {
    }

    public function update(){
        $hashtags['name'] = DB::table('hashtags')->lists('name');

        Artisan::call('connect_to_streaming_api', $hashtags);

      return;
    }
}