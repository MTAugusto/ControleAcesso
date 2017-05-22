(function(){

    let main = angular.module('spa', ['iconesSVG','ngRoute','ui.utils.masks', 'mdDataTable', 'ngMdIcons', 'ngSanitize']);

    angular.module('spa').config(function($routeProvider){
        $routeProvider
        .when('/', {
            templateUrl: 'includes/home.html',
            controller: 'HomeCtrl'
        })
        
        //CONFIGURAÇÃO

        .when('/configuration', {
            templateUrl: 'includes/configuration.html',
            controller: 'ConfigurationCtrl'
        })

        //ROTAS NOVAS
        .when('/clientes', {
            templateUrl: 'includes/clientes.html',
            controller: 'clientesCtrl'
        })
        .when('/clientes/inserir', {
            templateUrl: 'includes/clientesInserir.html',
            controller: 'clientesInserirCtrl'
        })
        .when('/clientes/editar', {
            templateUrl: 'includes/clientesEditar.html',
            controller: 'clientesEditarCtrl'
        })

        .otherwise({ redirectTo: '/'});
    });

    main.controller('mainCtrl', function($rootScope, $scope, $http) {

        $rootScope.api = "http://localhost/ControleAcesso/BackEnd/api/controlador";
        //$rootScope.api = "http://montanheiro.me/api/controlador";

        $scope.verificarLogin = function(){
            var token = sessionStorage.getItem("user_session") || localStorage.getItem("user_session");     
            if(token) {
                $http({ 
                    url: $rootScope.api + '/Login.php', 
                    dataType: 'json', 
                    method:'GET',
                    headers: {'Authorization': token},
                }).success(function (response) {
                    console.log("Usuário já tem token OK");
                }).error(function (response) {
                    console.log("Token do usuário é inválido");  
                    console.log(response);
                    window.location = "/#/login";            
                });
            }    
        };

    });

    main.config(function($mdThemingProvider) {
      $mdThemingProvider.theme('default')
        .primaryPalette('indigo')
        .accentPalette('red');
    });    

})();


