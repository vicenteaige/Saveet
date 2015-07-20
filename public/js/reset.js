angular.module('reset',['ngResource']);


angular.module('reset').controller(
    'MainController',
    [
        '$scope',
        'ResetModel',
        //function($scope, ResetModel, $event){
        function($scope, ResetModel){
            $scope.reset = function(sendEmail, sendPassword, sendPasswordConfirmation){
                alert("Hola");
                ResetModel.sendData(sendEmail, sendPassword, sendPasswordConfirmation);
                alert(sendEmail + sendPassword);
            };
            //$event.preventDefault();
        }
    ]
);

angular.module ('reset').factory(
    'ResetModel',
    [
        '$resource',
        function ($resource ) {

            var resource = {};
            var item = $resource ( '/v1/user/password/reset', {}, {
                sendData : { method : 'POST', isArray : false }
            });

            resource.sendData = function(sendEmail, sendPassword, sendPasswordConfirmation) {
                item.sendData({email:sendEmail, password:sendPassword, password_confirmation:sendPasswordConfirmation}).$promise.then( function( data ){
                    console.log(data.header);
                    //angular.copy( data, resource.items);
                });
            };
            return resource;
        }
    ]
);