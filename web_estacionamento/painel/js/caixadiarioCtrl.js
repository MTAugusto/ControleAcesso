angular.module('spa')
     .controller('caixadiarioCtrl', ['$scope', '$rootScope', '$mdToast', '$http', '$location',
          function($scope, $rootScope, $mdToast, $http, location) {
               $scope.name = 'Caixa Diário';

               $scope.valortotalcaixa = 0;

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
                              $scope.valortotalcaixa = 0;
                              for (var i = $scope.saidasList.length - 1; i >= 0; i--) {
                                $scope.valortotalcaixa += parseFloat($scope.saidasList[i].valor);;
                              }

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

          }
     ]);
