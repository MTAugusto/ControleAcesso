    angular.module('spa').controller('MenuItemsCtrl', function($scope) {
         //{name:'exemple', link:'http://exemple.com or #/exemple', icon:'assets-cache.js name'},
         
         var token = sessionStorage.getItem("user_session") || localStorage.getItem("user_session");
         var isAdmin = JSON.parse(atob((token.split("."))[1])).admin;

        if (isAdmin == 1) {
          $scope.MenuItems = [{
                   name: 'Início',
                   link: '#/',
                   icon: './img/ic_home_black_24px.svg',
                   accesskey: 'I'
              },
              {
                   name: 'Caixa Diário',
                   link: '#/caixa-diario',
                   icon: './img/ic_attach_money_black_24px.svg',
                   accesskey: 'A'
              },
              //{name:'Administração', link:'#/administracao', icon:'vendas'},
              {
                   name: 'Usuários',
                   link: '#/usuarios',
                   icon: './img/ic_person_add_black_24px.svg',
                   accesskey: 'U'

              },
              {
                   name: 'Clientes',
                   link: '#/clientes',
                   icon: './img/ic_group_add_black_24px.svg',
                   accesskey: 'C'
              },
              {
                   name: 'Tipos',
                   link: '#/tipos',
                   icon: './img/ic_playlist_add_black_24px.svg',
                   accesskey: 'T'
              },
              {
                   name: 'Veículos',
                   link: '#/veiculos',
                   icon: './img/ic_directions_car_black_24px.svg',
                   accesskey: 'V'
              }];
        } else {
          $scope.MenuItems = [{
                   name: 'Início',
                   link: '#/',
                   icon: './img/ic_home_black_24px.svg',
                   accesskey: 'I'
              },
              {
                   name: 'Caixa Diário',
                   link: '#/caixa-diario',
                   icon: './img/ic_attach_money_black_24px.svg',
                   accesskey: 'A'
              },
              {
                   name: 'Clientes',
                   link: '#/clientes',
                   icon: './img/ic_group_add_black_24px.svg',
                   accesskey: 'C'
              },
              {
                   name: 'Veículos',
                   link: '#/veiculos',
                   icon: './img/ic_directions_car_black_24px.svg',
                   accesskey: 'V'
              }];
        }

         
         $scope.sair = function() {
              localStorage.removeItem('user_session');
              sessionStorage.removeItem('user_session');
              window.location = "/";
         };
         //{name:'Financeiro', link:'#/financeiro', icon:'ic_attach_money_24px'},
         //{name:'Vendas', link:'#/vendas', icon:'vendas'}]
         //{name:'Estoque', link:'#/estoque', icon:'favorite'}]
    });
