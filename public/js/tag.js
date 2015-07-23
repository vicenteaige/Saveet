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
				
				var item2 = $resource ( 'v1/tag/' + encodeURIComponent(tag_a_borrar), {}, {
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
			resource.userItems = [];
			resource.allItems = [];
			
			var item = $resource ( 'v1/tag', {}, {
				get : { method : 'GET', isArray : false }
			});

			resource.getUserItems = function() {
				item.get().$promise.then( function( data ){
					angular.copy( data.user, resource.userItems);
				});
			};

			resource.getAllItems = function(query) {
				item.get({tag:query}).$promise.then( function( data ){
					angular.copy( data.todos, resource.allItems);
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

			$scope.tags = ItemResource.userItems;
			ItemResource.getUserItems();

			
	        $scope.loadTags = function(query) {
	        ItemResource.getAllItems(query);
	        return ItemResource.allItems;
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