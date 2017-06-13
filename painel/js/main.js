  (function() {

       let main = angular.module('spa', ['iconesSVG', 'ngRoute', 'ui.utils.masks', 'mdDataTable', 'ngMdIcons', 'ngSanitize', 'angular-loading-bar', 'ngAnimate']);

       angular.module('spa').config(function($routeProvider) {
            $routeProvider
                 .when('/', {
                      templateUrl: 'includes/home.html',
                      controller: 'HomeCtrl'
                 })

                 //CONFIGURAÇÃO


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

                 .when('/usuarios', {
                      templateUrl: 'includes/usuarios.html',
                      controller: 'usuariosCtrl'
                 })
                 .when('/usuarios/inserir', {
                      templateUrl: 'includes/usuariosInserir.html',
                      controller: 'usuariosInserirCtrl'
                 })
                 .when('/usuarios/editar', {
                      templateUrl: 'includes/usuariosEditar.html',
                      controller: 'usuariosEditarCtrl'
                 })

                 .when('/tipos', {
                      templateUrl: 'includes/tipos.html',
                      controller: 'tiposCtrl'
                 })
                 .when('/tipos/inserir', {
                      templateUrl: 'includes/tiposInserir.html',
                      controller: 'tiposInserirCtrl'
                 })
                 .when('/tipos/editar', {
                      templateUrl: 'includes/tiposEditar.html',
                      controller: 'tiposEditarCtrl'
                 })

                 .when('/veiculos', {
                      templateUrl: 'includes/veiculos.html',
                      controller: 'veiculosCtrl'
                 })
                 .when('/veiculos/inserir', {
                      templateUrl: 'includes/veiculosInserir.html',
                      controller: 'veiculosInserirCtrl'
                 })
                 .when('/veiculos/editar', {
                      templateUrl: 'includes/veiculosEditar.html',
                      controller: 'veiculosEditarCtrl'
                 })

                 .when('/caixa-diario', {
                      templateUrl: 'includes/caixadiario.html',
                      controller: 'caixadiarioCtrl'
                 })

                 .otherwise({
                      redirectTo: '/'
                 });
       });

       main.controller('mainCtrl', function($rootScope, $scope, $http) {


            $rootScope.api = "http://localhost/ControleAcesso/api";
            //$rootScope.api = "http://montanheiro.me/api";

            $scope.verificarLogin = function() {
                 var token = sessionStorage.getItem("user_session") || localStorage.getItem("user_session");
                 if (token) {
                      $http({
                           url: $rootScope.api + '/login',
                           dataType: 'json',
                           method: 'GET',
                           headers: {
                                'Authorization': token
                           },
                      }).error(function(response) {
                           console.log("Token do usuário é inválido");
                           console.log(response);
                           window.location = "/#/login";
                      });
                 }
            };

       });

       main.config(function($mdThemingProvider) {
            $mdThemingProvider.theme('default')
                 .primaryPalette('teal')
                 .accentPalette('red');
            $
       });
       main.config(['cfpLoadingBarProvider', function(cfpLoadingBarProvider) {
            cfpLoadingBarProvider.includeSpinner = false;
       }]);


  })();
