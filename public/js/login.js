angular.module('login',['ngResource']);

angular.module('login').controller(
    'MainController',
    [
        '$scope',
        'LoginModel',
        function($scope, LoginModel){
            $scope.login = function(event, sendEmail, sendPassword){
                //alert(sendEmail + sendPassword);
                LoginModel.sendData($scope, sendEmail, sendPassword);
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

            resource.sendData = function($scope, sendEmail, sendPassword) {
                item.sendData({email:sendEmail, password:sendPassword}).$promise.then(
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

