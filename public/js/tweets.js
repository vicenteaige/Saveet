/**
 * Created by Vicente on 17/7/15.
 */
angular.module('tweet',['ngResource']);

angular.module('tweet').controller(
    'TweetController',
    [
        '$scope',
        'TweetModel',
        function($scope, TweetModel){
            $scope.tweet = function(){
                TweetModel.sendData($scope);
            };

        setInterval(function(){
            $scope.tweet();
        }, 2000)
        }
    ]
);

angular.module ('tweet').factory(
    'TweetModel',
    [
        '$resource',
        '$window',
        function ($resource) {

            var resource = {};
            var item = $resource ( '/v1/tweet/latest', {}, {
                sendData : { method : 'GET', isArray : false }
            });

            resource.sendData = function($scope) {
                item.sendData().$promise.then( function( data ){
                    if (data.header.success == "yes"){
                        //console.log(data['body'][0]);
                        $scope.tweets = data['body'][0];

                    }else{
                        //error message
                        $scope.error = data.header.msg;
                        $scope.myValue = true;
                        console.log("error");
                    }

                });
            };
            return resource;
        }
    ]
);

