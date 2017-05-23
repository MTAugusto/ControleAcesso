angular.module('spa')
     .controller('clientesCtrl', ['$scope', '$rootScope', '$mdToast', '$http', '$location',
          function($scope, $rootScope, $mdToast, $http, location) {
               $scope.name = 'Administração de Clientes';

               $scope.consultarClientes = function() {
                    var token = sessionStorage.getItem("user_session") || localStorage.getItem("user_session");
                    if (token) {
                         $http({
                              url: $rootScope.api + '/cliente',
                              method: 'GET',
                              headers: {
                                   'Authorization': token
                              },
                         }).success(function(response) {
                              $scope.clientes = response;
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

               $scope.getClientesPorId = function(id) {
                    return _.find($scope.clientes, function(item) {
                         return item.id === id;
                    })
               };

          }
     ]);
