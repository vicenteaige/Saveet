angular.module('login',['ngResource']);

/*service.factory("login", function ($resource) {
    return $resource(
        "api url",
        {},
        {
            "update": {method: "PUT"},
            "check": {'method': 'POST', 'params': {'reviews_only': "true"}, isArray: true}

        }
    );
});*/

angular.module('login').controller(
    'MainController',
    [
        '$scope',
        'LoginModel',
        function($scope, LoginModel){
            $scope.login = function(sendEmail, sendPassword){
                //alert(sendEmail + sendPassword);
                LoginModel.sendData($scope, sendEmail, sendPassword);

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
                sendData : { method : 'POST', isArray : true },
                //getData : { method : 'GET', isArray : true }
            });

            resource.sendData = function($scope, sendEmail, sendPassword) {
               // alert(sendEmail + sendPassword);
                item.sendData({email:sendEmail, password:sendPassword}).$promise.then( function( data ){
                   console.log(data[0].header);
                    if (data[0].header.success == "yes"){
                        //window.location.replace = 'http://localhost:8080/home';
                        $window.location.href = 'http://localhost:8080/home';
                        //$location.url('/home');

                    }else if(data[0].header.success == "no"){
                        //error message
                        $scope.error = data[0].header.msg;
                        $scope.myValue = true;
                    }

                });
            };
            return resource;
        }
    ]
);

