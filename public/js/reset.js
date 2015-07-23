angular.module('reset',['ngResource']);


angular.module('reset').controller(
    'MainController',
    [
        '$scope',
        'ResetModel',
        //function($scope, ResetModel, $event){
        function($scope, ResetModel){
            $scope.reset = function(sendPassword, sendPasswordConfirmation){
                $scope.loading = true;
                var pathArray = window.location.pathname.split( '/' );
                var token = pathArray[3];

                ResetModel.sendData($scope, sendPassword, sendPasswordConfirmation, token);
               
            };
            //$event.preventDefault();
        }
    ]
);

angular.module ('reset').factory(
    'ResetModel',
    [
        '$resource',
        '$window',
        function ($resource, $window ) {

            var resource = {};
            var item = $resource ( '/v1/user/password/reset', {}, {
                sendData : { method : 'POST', isArray : false }
            });




            resource.sendData = function($scope, sendPassword, sendPasswordConfirmation, token) {
                item.sendData({password:sendPassword, password_confirmation:sendPasswordConfirmation, token:token}).$promise.then( 
                    function( data ){
                        console.log(data);
                        if(data.header.success== "yes"){
                           $window.location.href = 'login';
                        }
                        $scope.loading = false;
                    },
                    function( data ){
                        console.log(data);
                });

            };
            return resource;
        }
    ]
);