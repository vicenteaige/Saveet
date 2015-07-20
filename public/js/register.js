angular.module('register',['ngResource']);


angular.module('register').controller(
    'MainController',
    [
        '$scope',
        'RegisterModel',
        //function($event, $scope, RegisterModel){
        function($scope, RegisterModel){
            $scope.register = function(event, sendName, sendEmail, sendTwitterUserName, sendPassword, sendPasswordConfirmation){
                RegisterModel.sendData($scope, sendName, sendEmail, sendTwitterUserName, sendPassword, sendPasswordConfirmation);
                event.preventDefault();
            };
        }
    ]
);

angular.module ('register').factory(
    'RegisterModel',
    [
        '$resource',
        '$window',
        function ($resource, $window ) {

            var resource = {};
            var item = $resource ( '/v1/user/register', {}, {
                sendData : { method : 'POST', isArray : false }
            });

            resource.sendData = function($scope, sendName, sendEmail, sendTwitterUserName, sendPassword, sendPasswordConfirmation) {
                item.sendData({name:sendName, email:sendEmail, twitter_username:sendTwitterUserName, password:sendPassword, password_confirmation:sendPasswordConfirmation}).$promise.then(
                    //Success callback
                    function( data ){
                        console.log(data);
                        if (data.header.success == "yes"){
                            $window.location.href = 'http://localhost:8080/login';
                        }
                    },
                    //Failure callback
                    function (data){
                        console.log(data);
                        //error message
                        $scope.errors = data.data.header.msg;
                        $scope.myValue = true;
                });
            };
            return resource;
        }
    ]
);