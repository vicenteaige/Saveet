/**
 * Created by Vicente on 17/7/15.
 */
angular.module('graph',['ngResource']);

angular.module('graph').controller(
    'GraphController',
    [
        '$scope',
        'GraphModel',
        function($scope, GraphModel){
            $scope.graph = function(){
                GraphModel.sendData($scope);
            };
/*
            setInterval(function(){
                $scope.graph();
            }, 10000)
*/
        }
    ]
);

angular.module ('graph').factory(
    'GraphModel',
    [
        '$resource',
        '$window',
        function ($resource) {

            var resource = {};
            var item = $resource ( '/v1/tweet/graph', {}, {
                sendData : { method : 'GET', isArray : false }
            });

            resource.sendData = function($scope) {
                item.sendData().$promise.then( function( data ){
                    if (data.header.success == "yes"){
                        console.log(data['body'][0]);
                        $scope.tweetsGraph = data['body'][0];

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

