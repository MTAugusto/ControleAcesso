(function(){

    let main = angular.module('spa', ['iconesSVG','ngRoute','ui.utils.masks', 'mdDataTable', 'ngMdIcons', 'ngSanitize']);

    angular.module('spa').config(function($routeProvider){
        $routeProvider
        .when('/', {
            templateUrl: 'includes/login.html',
            controller: 'loginCtrl'
        })

        .otherwise({ redirectTo: '/'});
    });

    main.controller('mainCtrl', function($rootScope) {

        $rootScope.api = "http://localhost/ControleAcesso/BackEnd/api/controlador";
        //$rootScope.api = "http://montanheiro.me/api/controlador";
    });

    main.config(function($mdThemingProvider) {
      $mdThemingProvider.theme('default')
        .primaryPalette('indigo')
        .accentPalette('red');
    });

})();



