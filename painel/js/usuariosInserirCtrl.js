	angular.module('spa')
		.controller('usuariosInserirCtrl', [ '$scope', '$rootScope', '$routeParams', '$http', '$location', '$mdToast',
		function($scope, $rootScope,$routeParams, $http, $location, $mdToast){
	    	$scope.name = 'Usuários > Inserir novo usuario';

	        $scope.statusList = [
	            {status: 0, value: "Inativo"},
	            {status: 1, value: "Ativo"}
	        ];

	        $scope.adminList = [
	            {admin: 0, value: "Colaborador"},
	            {admin: 1, value: "Gerente"}
	        ];

	        $scope.cancelar = function(){
	            $location.path('usuarios').search({});
	        };

	    	$scope.inserir = function(){
	            var token = sessionStorage.getItem("user_session") || localStorage.getItem("user_session");
	            if(token) {
	                $http({
	                        url: $rootScope.api + '/usuario',
	                        dataType: 'json',
	                        method:'POST',
	                        headers: {'Authorization': token,'Content-Type': 'application/x-www-form-urlencoded'},
	                        data: $.param
	                        ({
	                            'nome': $scope.usuario.nome,
	                            'usuario': $scope.usuario.usuario,
	                            'senha': $scope.usuario.senha,
	                            'status': $scope.usuario.status,
	                            'admin': $scope.usuario.admin
	                        })
	                    }).success(function (response) {
	                        $mdToast.show($mdToast.simple()
	                            .content(response.message)
	                            .hideDelay(3000));
	                        $location.path('usuarios').search({});

	                    }).error(function (response) {
	                        $mdToast.show($mdToast.simple()
	                            .content(response.message)
	                            .hideDelay(3000));
	                        console.log(response);
	                        if (response.status == 2) window.location = "/#/login";
	                    });
	            }else{
	            	alert("sem token");
	                window.location = "/#/login";
	            }
	        };
		}
	]);
