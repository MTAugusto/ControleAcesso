angular.module('spa')
	.controller('usuariosEditarCtrl', [ '$scope', '$rootScope', '$routeParams', '$http', '$location', '$mdToast',
	function($scope, $rootScope,$routeParams, $http, $location, $mdToast){
    	$scope.name = 'Editar usuario';

        $scope.parametrosDaUrl = $location.search();

        $scope.cancelar = function(){
            $location.path('usuarios').search({});
        };

        $scope.consultar = function(){
            var token = sessionStorage.getItem("user_session") || localStorage.getItem("user_session");
            if(token) {
                $http({
                        url: $rootScope.api + '/usuario.php?id=' + $scope.parametrosDaUrl.id,
                        dataType: 'json',
                        method:'GET',
                        headers: {'Authorization': token}
                    }).success(function (response) {
                        $scope.usuario = response[0];
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

    	$scope.editar = function(){
            var token = sessionStorage.getItem("user_session") || localStorage.getItem("user_session");
            if(token) {
                $http({
                        url: $rootScope.api + '/usuario.php',
                        dataType: 'json',
                        method:'PUT',
                        headers: {'Authorization': token,'Content-Type': 'application/x-www-form-urlencoded'},
                        data: $.param
                        ({
                            'id': $scope.usuario.id,
                            'nome': $scope.usuario.nome,
                            'cpf': $scope.usuario.cpf,
                            'telefone': $scope.usuario.telefone
                        })
                    }).success(function (response) {
                        $mdToast.show($mdToast.simple()
                            .content(response.message)
                            .hideDelay(3000));
                        $location.path('/usuarios').search({});
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
