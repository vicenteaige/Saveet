angular.module('bootcamp',['ngResource', 'ngTagsInput']); 
//inicia una aplicacion 
//[ llama al modulo para que funcione ]
//Añadido el modulo ngTagsInput como una dependencia en la aplicación Angular

angular.module ('bootcamp').factory(
	'nombre_modelo',
	[
		'$resource',
		function ($resource ) {

			var resource = {}; //funcion pública			
			resource.items = [];			
			var item = $resource ( 'v1/tag', {}, {
				CrearTag : { method : 'POST', isArray : true }
			});

			resource.CrearTag = function(tag_nuevo) {
				item.CrearTag({tag:tag_nuevo}).$promise.then( function( data ){
					console.log(data);
				});
			};
			return resource;
		}
	]
);

angular.module ('bootcamp').factory(
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

angular.module('bootcamp').controller(
	'MainController',
	[
		'$scope', 
		'ItemResource',
		function($scope, ItemResource){
			
			$scope.items = ItemResource.items;
			ItemResource.getItems();

			/*var config ={
				prefix: 'Hola'
			};
			$scope.foo = "test";
			$scope.name = "Carlos";
			$scope.fnAlert = function (str){
				alert(config.prefix + ' ' + str);
			};	
			alert("HOLA!");
			var hola = {test:"hola"};
			console.log("HOLA!");
			hola.test={"adios"}
			*/
		}	
	]
);

angular.module('bootcamp').controller(
	'TagController',
	[
		'$scope',
		'nombre_modelo',
		function($scope,nombre_modelo){

			$scope.envia = function(str_name){ 
				nombre_modelo.CrearTag(str_name);
			 };
		}
	]
);

angular.module('bootcamp').controller(
	'MyCtrl',
	[ 
		'$scope',
		'$http',
		'ItemResource',
		'nombre_modelo',
		function($scope, $http, ItemResource,nombre_modelo) {

			$scope.tags = ItemResource.items;
			ItemResource.getItems();

	        $scope.loadTags = function(query) {
           // return ['Tag1', 'Tag2', 'Tag3', 'Tag4', 'Tag5'];
	        return $http.get('v1/tag');
	        };

	        $scope.envia = function(str_name){ 
				nombre_modelo.CrearTag(str_name);
			 };
	    }
    ]
);

