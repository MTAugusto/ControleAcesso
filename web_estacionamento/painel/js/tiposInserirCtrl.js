angular.module('spa')
     .controller('tiposInserirCtrl', ['$scope', '$rootScope', '$routeParams', '$http', '$location', '$mdToast',
          function($scope, $rootScope, $routeParams, $http, $location, $mdToast) {
               $scope.name = 'Inserir novo tipo de veiculo';

               $scope.cancelar = function() {
                    $location.path('tipos').search({});
               };


               $scope.inserir = function() {
                    var token = sessionStorage.getItem("user_session") || localStorage.getItem("user_session");
                    if (token) {
                         $http({
                              url: $rootScope.api + '/tipos',
                              dataType: 'json',
                              method: 'POST',
                              headers: {
                                   'Authorization': token,
                                   'Content-Type': 'application/x-www-form-urlencoded'
                              },
                              data: $.param({
                                   'Tipo': $scope.tipos.nome,
                                   'valor por dia': $scope.tipos.valorporhora,
                                   'valor por mes': $scope.tipos.valorpormes
                              })
                         }).success(function(response) {
                              $mdToast.show($mdToast.simple()
                                   .content(response.message)
                                   .hideDelay(3000));
                              $location.path('tipos').search({});

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
