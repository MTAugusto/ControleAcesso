    angular.module('spa').controller('HomeCtrl', ['$scope', '$rootScope', '$mdToast', '$http', '$location',
              function($scope, $rootScope, $mdToast, $http, location, $mdDialog) {
            $scope.name = 'Início';

            var token = sessionStorage.getItem("user_session") || localStorage.getItem("user_session");
            var idUserByToken = JSON.parse(atob((token.split("."))[1])).id;

            $scope.finalizacao = false;

            $scope.finalizar = function () {
              $scope.finalizacao = false;
            }

            $scope.cadastrarVeiculo = function() {
                     window.location = "/painel/#/veiculos/inserir";
                 };


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

        $scope.consultarVeiculos = function(){
              var token = sessionStorage.getItem("user_session") || localStorage.getItem("user_session");
              if(token) {
                  $http({
                          url: $rootScope.api + '/veiculo',
                          method:'GET',
                          headers: {'Authorization': token},
                      }).success(function (response) {
                          $scope.veiculos = response;
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

          $scope.inserirSaida = function(placa, cortesia) {
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
                                  'cortesia': cortesia
                                  })
                           }).success(function(response) {
                                $mdToast.show($mdToast.simple()
                                     .content(response.message)
                                     .hideDelay(3000));
                                $scope.saida = response;
                                $scope.finalizacao = true;
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
