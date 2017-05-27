angular.module('spa')
     .controller('tiposCtrl', ['$scope', '$rootScope', '$mdToast', '$http', '$location',
          function($scope, $rootScope, $mdToast, $http, location) {
               $scope.name = 'Administração de Tipos de Veiculos';

               $scope.consultarTipos = function() {
                    var token = sessionStorage.getItem("user_session") || localStorage.getItem("user_session");
                    if (token) {
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
                    } else {
                         console.log("sem token");
                         window.location = "/#/login";
                    }
               };

               $scope.getTiposPorId = function(id) {
                    return _.find($scope.tipos, function(item) {
                         return item.id === id;
                    })
               };

          }
     ]);
