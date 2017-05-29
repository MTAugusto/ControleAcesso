  angular.module('spa').controller('HomeCtrl', ['$scope', '$rootScope', '$mdToast', '$http', '$location',
            function($scope, $rootScope, $mdToast, $http, location,$mdDialog) {
          $scope.name = 'Início';

          var token = sessionStorage.getItem("user_session") || localStorage.getItem("user_session");
          var idUserByToken = JSON.parse(atob((token.split("."))[1])).id;

          $scope.consultarCaixa = function() {
            if (token) {
                  $scope.caixaAberto = true;
                  $http({
                      url: $rootScope.api + '/caixadiario/usuario/' + idUserByToken,
                      method: 'GET',
                      headers: {
                    	       'Authorization': token
        	       	    	},
                      }).success(function(response) {
                          $scope.caixadiario = response[0];

                          if ($scope.caixadiario == null || $scope.caixadiario.isfechado == 1) {
                            $scope.caixaAberto = false;
                            return;
                          }
                          $scope.caixadiario.abertura = new Date($scope.caixadiario.abertura);
                          $scope.caixaAberto = true;
                          $scope.consultarSaidas();
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
                                $scope.consultarCaixa();
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
            if (token) {
                  $http({
                      url: $rootScope.api + '/saida-veiculo/caixa/' + $scope.caixadiario.id,
                      method: 'GET',
                      headers: {
                    	       'Authorization': token
        	       	    	},
                      }).success(function(response) {
                          $scope.saidasList = response;
                          console.log(response);
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


          $scope.fecharCaixaDiario = function() {
            if ($scope.caixadiario.isfechado == 1) {
              $mdToast.show($mdToast.simple()
                .content("O caixa diário já está fechado")
                .hideDelay(3000));
              return;
            }
                      if (token) {
                           $http({
                                url: $rootScope.api + '/caixadiario',
                                dataType: 'json',
                                method: 'PUT',
                                headers: {
                                     'Authorization': token,
                                     'Content-Type': 'application/x-www-form-urlencoded'
                                },
                                data: $.param({
                                     'id': $scope.caixadiario.id,
                                })
                           }).success(function(response) {
                              console.log(response);
                                $mdToast.show($mdToast.simple()
                                     .content(response.message)
                                     .hideDelay(3000));
                                $scope.consultarCaixa();
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




      $scope.consultarVeiculos = function(){
            var token = sessionStorage.getItem("user_session") || localStorage.getItem("user_session");
            if(token) {
                $http({
                        url: $rootScope.api + '/veiculo',
                        method:'GET',
                        headers: {'Authorization': token},
                    }).success(function (response) {
                        $scope.veiculos = response;
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


        $scope.inserirEntrada = function(veiculoId) {
                    var token = sessionStorage.getItem("user_session") || localStorage.getItem("user_session");
                    if (token) {
                         $http({
                              url: $rootScope.api + '/entrada-veiculo',
                              dataType: 'json',
                              method: 'POST',
                              headers: {
                                   'Authorization': token,
                                   'Content-Type': 'application/x-www-form-urlencoded'
                              },
                              data: $.param({
                                'veiculo': veiculoId
                                })
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

        $scope.inserirSaida = function(placa) {
                    var token = sessionStorage.getItem("user_session") || localStorage.getItem("user_session");
                    if (token) {
                         $http({
                              url: $rootScope.api + '/saida-veiculo',
                              dataType: 'json',
                              method: 'POST',
                              headers: {
                                   'Authorization': token,
                                   'Content-Type': 'application/x-www-form-urlencoded'
                              },
                              data: $.param({
                                'placa': placa,
                                'cortesia': 0
                                })
                         }).success(function(response) {
                              $mdToast.show($mdToast.simple()
                                   .content(response.message)
                                   .hideDelay(3000));
                              console.log(response);
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





      }]);