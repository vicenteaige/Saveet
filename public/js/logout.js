/**
 * Created by Vicente on 17/7/15.
 */
angular.module('logout',['ngResource']);

angular.module('logout').controller(
    'LogoutController',
    [
        '$scope',
        'LogoutModel',
        function($scope, LogoutModel){
            $scope.logout = function(){
                LogoutModel.sendData($scope);
            };
        }
    ]
);

angular.module ('logout').factory(
    'LogoutModel',
    [
        '$resource',
        '$window',
        function ($resource, $window ) {

            var resource = {};
            var item = $resource ( '/v1/user/logout', {}, {
                sendData : { method : 'GET', isArray : false }
            });

            resource.sendData = function($scope) {
                item.sendData().$promise.then( function( data ){
                    console.log(data.header);
                    if (data.header.success == "yes"){
                        $window.location.href = 'http://localhost:8080/home';
                        console.log("you are logout");

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

