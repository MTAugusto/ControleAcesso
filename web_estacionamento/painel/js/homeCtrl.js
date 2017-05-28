angular.module('spa').controller('HomeCtrl', ['$scope', '$rootScope', '$mdToast', '$http', '$location',
          function($scope, $rootScope, $mdToast, $http, location) {
        $scope.name = 'Início';
        
        $scope.consultarCaixa = function() {
            var token = sessionStorage.getItem("user_session") || localStorage.getItem("user_session");
            if (token) {
                $http({
                    url: $rootScope.api + '/caixadiario/usuario/' + 0,
                    method: 'GET',
                    headers: {
                  	       'Authorization': token
      	       	    	},
                    }).success(function(response) {
                        $scope.caixadiario = response[0];
                        $scope.caixadiario.data = new Date($scope.caixadiario.data);
                        $scope.caixadiario.abertura = new Date($scope.caixadiario.abertura);
                        console.log($scope.caixadiario);
                    }).error(function(response) {
                        $mdToast.show($mdToast.simple()
                            .content(response.message)
                            .hideDelay(3000));
                        console.log(response);
                        if (response.status == 2) window.location = "/#/login";
                    });
           	} else {
                console.log("sem token");
                window.location = "/#/login";
            }
        };

        $scope.abrirCaixaDiario = function() {
                    var token = sessionStorage.getItem("user_session") || localStorage.getItem("user_session");
                    if (token) {
                         $http({
                              url: $rootScope.api + '/caixadiario',
                              dataType: 'json',
                              method: 'POST',
                              headers: {
                                   'Authorization': token,
                                   'Content-Type': 'application/x-www-form-urlencoded'
                              }
                         }).success(function(response) {
                              $mdToast.show($mdToast.simple()
                                   .content(response.message)
                                   .hideDelay(3000));

                         }).error(function(response) {
                              $mdToast.show($mdToast.simple()
                                   .content(response.message)
                                   .hideDelay(3000));
                              console.log(response);
                              if (response.status == 2) window.location = "/#/login";
                         });
                    } else {
                         alert("sem token");
                         window.location = "/#/login";
                    }
         };

        $scope.consultarSaidas = function() {
            var token = sessionStorage.getItem("user_session") || localStorage.getItem("user_session");
            if (token) {
                $http({
                    url: $rootScope.api + '/saida-veiculo/caixa/',
                    method: 'GET',
                    headers: {
                  	       'Authorization': token
      	       	    	},
                    }).success(function(response) {
                        $scope.clientes = response;
                    }).error(function(response) {
                        $mdToast.show($mdToast.simple()
                            .content(response.message)
                            .hideDelay(3000));
                        console.log(response);
                        if (response.status == 2) window.location = "/#/login";
                    });
           	} else {
                console.log("sem token");
                window.location = "/#/login";
            }
        };



    }]);