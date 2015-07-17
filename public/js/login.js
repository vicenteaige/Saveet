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
                LoginModel.sendData(sendEmail, sendPassword);

            };
        }
    ]
);

angular.module ('login').factory(
    'LoginModel',
    [
        '$resource',
        function ($resource ) {

            var resource = {};
            //resource.items = [];
            var item = $resource ( '/v1/user/login', {}, {
                sendData : { method : 'POST', isArray : true },
                //getData : { method : 'GET', isArray : true }
            });

            resource.sendData = function(sendEmail, sendPassword) {
               // alert(sendEmail + sendPassword);
                item.sendData({email:sendEmail, password:sendPassword}).$promise.then( function( data ){
                   console.log(data[0].header);

                    //angular.copy( data, resource.items);
                });
            };
            return resource;
        }
    ]
);
