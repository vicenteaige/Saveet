angular.module('usertags',['ngResource', 'ngTagsInput']); 
//inicia una aplicacion 
//[ llama al modulo para que funcione ]
//Añadido el modulo ngTagsInput como una dependencia en la aplicación Angular

angular.module ('usertags').factory(
	'HashtagModel',
	[
		'$resource',
		function ($resource ) {

			var resource = {}; //funcion pública			
			resource.items = [];			
			var item = $resource ( 'v1/tag', {}, {
				CrearTag : { method : 'POST', isArray : false }
			});

			resource.CrearTag = function(tag_nuevo){
				item.CrearTag({tag:tag_nuevo}).$promise.then( function( data ){
					console.log(data);
				});
			};
			
			resource.EliminarTag = function(tag_a_borrar){
				
				var item2 = $resource ( 'v1/tag/' + tag_a_borrar, {}, {
					//DELETE - destroy
					EliminarTag : { method : 'DELETE', isArray : false }
				});

				item2.EliminarTag().$promise.then( function( data ){
					console.log(data);
				});
			};

			return resource;
		}
	]
);

angular.module ('usertags').factory(
	'ItemResource',
	[
		'$resource',
		function ($resource ) {

			var resource = {}; //funcion pública			
			resource.items = [];
			
			var item = $resource ( 'v1/tag', {}, {
				get : { method : 'GET', isArray : true }
			});

			resource.getItems = function() {
				item.get().$promise.then( function( data ){
					angular.copy( data, resource.items);
				});
			};

			return resource;
		}
	]
);

angular.module('usertags').controller(
	'HashtagController',
	[ 
		'$scope',
		'$http',
		'ItemResource',
		'HashtagModel',
		function($scope, $http, ItemResource,HashtagModel) {

			$scope.tags = ItemResource.items;
			ItemResource.getItems();

	        $scope.loadTags = function(query) {
	        return $http.get('v1/tag');
	        };

	        $scope.envia = function(str_name){ 
				HashtagModel.CrearTag(str_name);
			 };

			$scope.elimina = function(str_name){ 
				console.log('Sha creat elimina ' + str_name);
				HashtagModel.EliminarTag(str_name);
			};
	    }
    ]
);