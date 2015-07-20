angular.module('reset',['ngResource']);


angular.module('reset').controller(
    'MainController',
    [
        '$scope',
        'ResetModel',
        //function($scope, ResetModel, $event){
        function($scope, ResetModel){
            $scope.reset = function(sendEmail, sendPassword, sendPasswordConfirmation){
                ResetModel.sendData(sendEmail, sendPassword, sendPasswordConfirmation);
               
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



            resource.sendData = function(sendEmail, sendPassword, sendPasswordConfirmation) {
                item.sendData({email:sendEmail, password:sendPassword, password_confirmation:sendPasswordConfirmation}).$promise.then( 
                    function( data ){
                        console.log(data);
                        if(data.header.success== "yes"){
                           $window.location.href = 'http://localhost:8080/login';
                        }
                    },
                    function( data ){
                        console.log(data);
                });

            };
            return resource;
        }
    ]
);