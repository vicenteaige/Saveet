
angular.module('bootcamp', [ 'ngResource' ]);

angular.module( 'bootcamp' ).factory(
	'ItemResource',
	[
		'$resource',
		function ( $resource ) {

			var resource = {};

			var item = $resource(  '/item', {}, {

				get : { method : 'GET', isArray : true }
			} );

			resource.items = [];

			resource.getItems = function() {

				item.get().$promise.then( function( data ){

					angular.copy( data, resource.items );

				} );
			};

			return resource;
		}
	]
);

angular.module( 'bootcamp' ).controller(
	'MainController',
	[
		'$scope',
		'ItemResource',
		function ( $scope, ItemResource ) {

			$scope.pulsado = true;

			$scope.fnAlert = function(){

				ItemResource.getItems();
			};


			$scope.items = ItemResource.items;


			ItemResource.getItems();

			//$scope.name = "Guillem";
		}
	]
);

angular.module( 'bootcamp' ).controller(
	'NameController',
	[
		'$scope',
		function ( $scope ) {

			//$scope.name = "Xavier";
		}
	]
);