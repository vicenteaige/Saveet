<?php

namespace App\Http\Controllers;

use Elasticsearch\Client as Es;
# use Elasticsearch\Client;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Redis;

class ElasticController extends Controller
{
    /**
     * Publishes a 'stop' event to Redis Pub/Sub 'daemon-notify' channel
     *
     * @return Response
     */
    public function testEs(){

        $searchParams['index'] = 'mongoindex';
        $searchParams['size'] = 50;
        $searchParams['body']['query']['bool']['must'][array(["wildcard"])] = 'foofield:barstring';

        /*
         *
* {
              "query": {
                "bool": {
                  "must": [
                    {
                      "wildcard": {
                        "tweet.text": "*lol*"
                      }
                    }
                  ],
                  "must_not": [],
                  "should": []
                }
              },
              "from": 0,
              "size": 10,
              "sort": [],
              "facets": {}
            }
         */

        $elastic = new Es();

        $result = $elastic->search($searchParams);

        //$result = Es::search($searchParams);
        return response()
            ->json($result)
            ->header('Content-Type', 'application/json');
    }

    public function testEs2(){

        $searchParams['index'] = 'mongoindex';
        $searchParams['size'] = 50;
        $searchParams['body']['query']['query_string']['query'] = 'foofield:barstring';

        $elastic = new Es();

        $result = $elastic->search($searchParams);

        //$result = Es::search($searchParams);
        return response()
            ->json($result)
            ->header('Content-Type', 'application/json');
    }

}
