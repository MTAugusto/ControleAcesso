angular.module('spa')
     .controller('veiculosCtrl', ['$scope', '$rootScope', '$mdToast', '$http', '$location',
     function($scope, $rootScope, $mdToast, $http, location){
          $scope.name = 'Administração de Usuários';

          $scope.consultarVeiculos = function(){
            var token = sessionStorage.getItem("user_session") || localStorage.getItem("user_session");
            if(token) {
                $http({
                        url: $rootScope.api + '/veiculo',
                        method:'GET',
                        headers: {'Authorization': token},
                    }).success(function (response) {
                        $scope.veiculos = response;

                        $scope.veiculos.map(function(element){
                            element.ismensal = element.ismensal == 1 ? "Mensal" : "Diária";
                        });
                    
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

          $scope.getVeiculosPorId = function(id){
          return _.find($scope.veiculos, function(item){
               return item.id === id;
          })
        };

     }]
);
