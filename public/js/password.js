angular.module('password',['ngResource']);


angular.module('password').controller(
    'MainController',
    [
        '$scope',
        'ResetModel',
        function($scope, ResetModel){
            $scope.password = function(sendEmail){
                ResetModel.sendData(sendEmail);
               
            };
        }
    ]
);

angular.module ('password').factory(
    'ResetModel',
    [
        '$resource',
        '$window',
        function ($resource, $window ) {
            var resource = {};
            var item = $resource ( '/v1/user/password/email', {}, {
                sendData : { method : 'POST', isArray : false }
            });

            resource.sendData = function(sendEmail) {
                item.sendData({email:sendEmail}).$promise.then(
                    function( data ){
                        console.log(data);
                    },
                    function( data ){
                        console.log(data);
                });

            };
            return resource;
        }
    ]
);