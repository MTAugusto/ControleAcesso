angular.module('spa')
	.controller('usuariosInserirCtrl', [ '$scope', '$rootScope', '$routeParams', '$http', '$location', '$mdToast',
	function($scope, $rootScope,$routeParams, $http, $location, $mdToast){
    	$scope.name = 'Inserir novo usuario';

        $scope.cancelar = function(){
            $location.path('clientes').search({});
        };


    	$scope.inserir = function(){
            var token = sessionStorage.getItem("user_session") || localStorage.getItem("user_session");
            if(token) {
                $http({
                        url: $rootScope.api + '/Cliente.php',
                        dataType: 'json',
                        method:'POST',
                        headers: {'Authorization': token,'Content-Type': 'application/x-www-form-urlencoded'},
                        data: $.param
                        ({
                            'nome': $scope.usuario.nome,
                            'cpf': $scope.usuario.cpf,
                            'telefone': $scope.usuario.telefone
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
