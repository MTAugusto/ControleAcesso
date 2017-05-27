angular.module('spa')
     .controller('tiposEditarCtrl', ['$scope', '$rootScope', '$routeParams', '$http', '$location', '$mdToast',
          function($scope, $rootScope, $routeParams, $http, $location, $mdToast) {
               $scope.name = 'Editar tipo veiculo';

               $scope.parametrosDaUrl = $location.search();

               $scope.cancelar = function() {
                    $location.path('tipos').search({});
               };

               $scope.consultar = function() {
                    var token = sessionStorage.getItem("user_session") || localStorage.getItem("user_session");
                    if (token) {
                         $scope.isLoad = true;
                         $http({
                              url: $rootScope.api + '/tipos?id=' + $scope.parametrosDaUrl.id,
                              dataType: 'json',
                              method: 'GET',
                              headers: {
                                   'Authorization': token
                              }
                         }).success(function(response) {
                              $scope.cliente = response[0];
                         }).error(function(response) {
                              $mdToast.show($mdToast.simple()
                                   .content(response.message)
                                   .hideDelay(3000));
                              console.log(response);
                              if (response.status == 2) window.location = "/#/login";

                         });
                         $scope.isLoad = false;
                    } else {
                         console.log("sem token");
                         window.location = "/#/login";
                    }
               };

               $scope.editar = function() {
                    var token = sessionStorage.getItem("user_session") || localStorage.getItem("user_session");
                    if (token) {
                         $http({
                              url: $rootScope.api + '/tipos',
                              dataType: 'json',
                              method: 'PUT',
                              headers: {
                                   'Authorization': token,
                                   'Content-Type': 'application/x-www-form-urlencoded'
                              },
                              data: $.param({
                                   'id': $scope.cliente.id,
                                   'nome': $scope.cliente.nome,
                                   'cpf': $scope.cliente.cpf,
                                   'telefone': $scope.cliente.telefone
                              })
                         }).success(function(response) {
                              $mdToast.show($mdToast.simple()
                                   .content(response.message)
                                   .hideDelay(3000));
                              $location.path('/clientes').search({});
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
