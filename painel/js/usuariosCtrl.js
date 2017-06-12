angular.module('spa')
	.controller('usuariosCtrl', ['$scope', '$rootScope', '$mdToast', '$http', '$location',
	function($scope, $rootScope, $mdToast, $http, location){
		$scope.name = 'Administração de Usuários';

		$scope.consultarUsuarios = function(){
            var token = sessionStorage.getItem("user_session") || localStorage.getItem("user_session");
            if(token) {
                $http({
                        url: $rootScope.api + '/usuario',
                        method:'GET',
                        headers: {'Authorization': token},
                    }).success(function (response) {
                        $scope.usuarios = response;

                        //if ternario - if normal
                        $scope.usuarios.map(function(element){
                            element.status = element.status == 1 ? "Ativo" : "Inativo";
                        });
                        $scope.usuarios.map(function(element){
                            if (element.admin == 1) element.admin = "Administrador"; 
                            else element.admin = "Usuário comum";
                        });
                    
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
        	return _.find($scope.usuarios, function(item){
            	return item.id === id;
        	})
        };

	}]
);
