angular.module('spa')
     .controller('veiculosEditarCtrl', ['$scope', '$rootScope', '$routeParams', '$http', '$location', '$mdToast',
          function($scope, $rootScope, $routeParams, $http, $location, $mdToast) {
               $scope.name = 'Veiculos > Editar veiculo';

               $scope.parametrosDaUrl = $location.search();

               $scope.mensalidadesList = [
                    {ismensal: 0, desc: "Cobrança diária"},
                    {ismensal: 1, desc: "Cobrança mensal"}
               ];

               $scope.cancelar = function() {
                    $location.path('veiculos').search({});
               };

               $scope.consultar = function() {
                    var token = sessionStorage.getItem("user_session") || localStorage.getItem("user_session");
                    if (token) {
                         $scope.consultarClientes(token);
                         $scope.consultarTipos(token);
                         $scope.consultarVeiculo(token);
                    }else {
                         console.log("sem token");
                         window.location = "/#/login";
                    }
               };

               $scope.consultarClientes = function(token) {
                    $http({
                              url: $rootScope.api + '/cliente',
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
               };

               $scope.consultarTipos = function(token) {
                         $http({
                              url: $rootScope.api + '/tipo',
                              method: 'GET',
                              headers: {
                                   'Authorization': token
                              },
                         }).success(function(response) {
                              $scope.tipos = response;
                         }).error(function(response) {
                              $mdToast.show($mdToast.simple()
                                   .content(response.message)
                                   .hideDelay(3000));
                              console.log(response);
                              if (response.status == 2) window.location = "/#/login";
                         });
               };
               
               $scope.consultarVeiculo = function(token) {
                         $http({
                              url: $rootScope.api + '/veiculo/' + $scope.parametrosDaUrl.id,
                              dataType: 'json',
                              method: 'GET',
                              headers: {
                                   'Authorization': token
                              }
                         }).success(function(response) {
                              $scope.veiculo = response[0];
                         }).error(function(response) {
                              $mdToast.show($mdToast.simple()
                                   .content(response.message)
                                   .hideDelay(3000));
                              console.log(response);
                              if (response.status == 2) window.location = "/#/login";
                         });
               };

               $scope.editar = function() {
                    var token = sessionStorage.getItem("user_session") || localStorage.getItem("user_session");
                    if (token) {
                         $http({
                              url: $rootScope.api + '/veiculo/' + $scope.parametrosDaUrl.id,
                              dataType: 'json',
                              method: 'PUT',
                              headers: {
                                   'Authorization': token,
                                   'Content-Type': 'application/x-www-form-urlencoded'
                              },
                              data: $.param($scope.veiculo)
                         }).success(function(response) {
                              $mdToast.show($mdToast.simple()
                                   .content(response.message)
                                   .hideDelay(3000));
                              $location.path('/veiculos').search({});
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
