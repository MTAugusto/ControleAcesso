angular.module('spa')
    .controller('loginCtrl',
    function($scope, $rootScope, $http, $timeout, $mdToast){

    	$scope.verificar = function(){
            var token = sessionStorage.getItem("user_session") || localStorage.getItem("user_session");     
            if(token) {
                $http({ 
                    url: $rootScope.api + '/Login.php', 
                    dataType: 'json', 
                    method:'GET',
                    headers: {'Authorization': token},
                }).success(function (response) {
                	console.log("Usuário já tem token OK");
                	window.location = "/painel/#/";
                }).error(function (response) {
                    console.log("Token do usuário é inválido");                
                });
            }    
        };

        $scope.login = function(){
            
            $scope.login.error = "";
      
            var usuario = $scope.usuario.usuario;
            var senha = $scope.usuario.senha;
            var manterLogado = $scope.usuario.manterLogado;

            $http({ 
                url: $rootScope.api + '/Login.php', 
                dataType: 'json', 
                method:'POST',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                data: $.param({
                	'usuario': usuario, 
                    'senha': senha 
                })

            }).success(function (response) {
               	console.log(response);
               	if (manterLogado) {
                    localStorage.setItem('user_session', response.token);
                    console.log("token gravado no local storage");
                }else{
                    sessionStorage.setItem('user_session', response.token);
                    console.log("token gravado no session storage");
                }
                $mdToast.show(
                       $mdToast.simple()
                           .content("Logado com sucesso!")
                           .hideDelay(3000));
	                window.location = "/painel/#/";
            }).error(function (response) {
                $mdToast.show(
                        $mdToast.simple()
                            .content(response.message)
                            .hideDelay(3000));
                console.log(response);
            });
            
        };
	}
);