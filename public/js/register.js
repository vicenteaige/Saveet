angular.module('register',['ngResource']);


angular.module('register').controller(
    'MainController',
    [
        '$scope',
        'RegisterModel',
        //function($scope, RegisterModel, $event){
        function($scope, RegisterModel){
            $scope.register = function(sendName, sendEmail, sendTwitterUserName, sendPassword, sendPasswordConfirmation){
                RegisterModel.sendData(sendName, sendEmail, sendTwitterUserName, sendPassword, sendPasswordConfirmation);
                //alert(sendEmail + " " + sendTwitterUserName);
            };
            //$event.preventDefault();
        }
    ]
);

angular.module ('register').factory(
    'RegisterModel',
    [
        '$resource',
        function ($resource ) {

            var resource = {};
            var item = $resource ( '/v1/user/register', {}, {
                sendData : { method : 'POST', isArray : false }
            });

            resource.sendData = function(sendName, sendEmail, sendTwitterUserName, sendPassword, sendPasswordConfirmation) {
                //alert(sendEmail + " " + sendTwitterUserName);
                item.sendData({name:sendName, email:sendEmail, twitter_username:sendTwitterUserName, password:sendPassword, password_confirmation:sendPasswordConfirmation}).$promise.then( function( data ){
                    console.log(data.header);
                    //angular.copy( data, resource.items);
                });
            };
            return resource;
        }
    ]
);