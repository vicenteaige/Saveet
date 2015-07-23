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

			resource.CrearTag = function($scope,tag_nuevo){
				item.CrearTag({tag:tag_nuevo}).$promise.then( function( data ){
					console.log(data);
					$scope.loading = false;
				});
			};
			
			resource.EliminarTag = function($scope,tag_a_borrar){
				
				var item2 = $resource ( 'v1/tag/' + encodeURIComponent(tag_a_borrar), {}, {
					//DELETE - destroy
					EliminarTag : { method : 'DELETE', isArray : false }
				});

				item2.EliminarTag().$promise.then( function( data ){
					console.log(data);
					$scope.loading = false;
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

			resource.getUserItems = function($scope) {
				item.get().$promise.then( function( data ){
					angular.copy( data.user, resource.userItems);
					$scope.loading = false;
				});
			};

			resource.getAllItems = function($scope,query) {
				item.get({tag:query}).$promise.then( function( data ){
					angular.copy( data.todos, resource.allItems);
					$scope.loading = false;
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
			$scope.loading = true;
			ItemResource.getUserItems($scope);
			$scope.tags = ItemResource.userItems;	
			
	        $scope.loadTags = function(query) {
				$scope.loading = true;
	        	ItemResource.getAllItems($scope,query);
	       		return ItemResource.allItems;
	        };

	        $scope.envia = function(str_name){
	        	$scope.loading = true; 
				HashtagModel.CrearTag($scope,str_name);
			 };

			$scope.elimina = function(str_name){
				$scope.loading = true; 
				HashtagModel.EliminarTag($scope,str_name);
			};
			
	    }
    ]
);