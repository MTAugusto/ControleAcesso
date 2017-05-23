angular.module('spa')
	.controller('UsuariosCtrl', ['$scope', '$rootScope', '$mdToast', '$http', '$location',
	function($scope, $rootScope, $mdToast, $http, location){
		$scope.name = 'Administração de Usuarios';

		$scope.consultarUsuarios = function(){
            var token = sessionStorage.getItem("user_session") || localStorage.getItem("user_session");
            if(token) {
                $http({
                        url: $rootScope.api + '/Usuarios.php',
                        method:'GET',
                        headers: {'Authorization': token},
                    }).success(function (response) {
                        $scope.Usuarios = response;
                        console.log(response);
                    }).error(function (response) {
                        $mdToast.show($mdToast.simple()
                            .content(response.message)
                            .hideDelay(3000));
                        console.log(response);
                        if (response.status == 2) window.location = "/#/login";
                    });
            }else{
                console.log("sem token");
                window.location = "/#/login";
            }
        };

      	$scope.getUsuariosPorId = function(id){
        	return _.find($scope.Usuarios, function(item){
            	return item.id === id;
        	})
        };

	}]
);
