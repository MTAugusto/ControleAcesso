angular.module('spa')
	.controller('usuariosEditarCtrl', [ '$scope', '$rootScope', '$routeParams', '$http', '$location', '$mdToast',
	function($scope, $rootScope,$routeParams, $http, $location, $mdToast){
    	$scope.name = 'Usuários > Editar usuário';

        $scope.parametrosDaUrl = $location.search();

        $scope.statusList = [
            {status: 0, value: "Inativo"},
            {status: 1, value: "Ativo"}
        ];

        $scope.adminList = [
            {admin: 0, value: "Usuário comum"},
            {admin: 1, value: "Administrador"}
        ];

        $scope.cancelar = function(){
            $location.path('usuarios').search({});
        };

        $scope.consultar = function(){
            var token = sessionStorage.getItem("user_session") || localStorage.getItem("user_session");
            if(token) {
                $http({
                        url: $rootScope.api + '/usuario?id=' + $scope.parametrosDaUrl.id,
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
                        url: $rootScope.api + '/usuario/' + $scope.usuario.id,
                        dataType: 'json',
                        method:'PUT',
                        headers: {'Authorization': token,'Content-Type': 'application/x-www-form-urlencoded'},
                        data: $.param({
                            'id': $scope.usuario.id,
                            'nome': $scope.usuario.nome,
                            'usuario': $scope.usuario.usuario,
                            'status': $scope.usuario.status,
                            'admin': $scope.usuario.admin
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
