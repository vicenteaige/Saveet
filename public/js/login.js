angular.module('login',['ngResource']);

angular.module('login').controller(
    'MainController',
    [
        '$scope',
        'LoginModel',
        function($scope, LoginModel){
            $scope.login = function(event, sendEmail, sendPassword, remember, _token){
                //alert(sendEmail + sendPassword);
                LoginModel.sendData($scope, sendEmail, sendPassword, remember, _token);
                event.preventDefault();

            };
        }
    ]
);

angular.module ('login').factory(
    'LoginModel',
    [
        '$resource',
        '$window',
        function ($resource, $window ) {

            var resource = {};
            //resource.items = [];
            var item = $resource ( '/v1/user/login', {}, {
                sendData : { method : 'POST', isArray : false }
            });

            resource.sendData = function($scope, sendEmail, sendPassword, remember, _token) {
                item.sendData({email:sendEmail, password:sendPassword, remember:remember, _token:_token}).$promise.then(
                    //Success callback
                    function( data ){
                        console.log(data);
                        if (data.header.success == "yes"){
                            $window.location.href = 'http://localhost:8080/home';
                        }
                    },
                    //Failure callback
                    function (data){
                        console.log(data);
                        //error message
                        $scope.error = data.data.header.msg;
                        $scope.myValue = true;
                });
            };
            return resource;
        }
    ]
);

