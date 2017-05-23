    angular.module('spa').controller('MenuItemsCtrl', function($scope) {
         //{name:'exemple', link:'http://exemple.com or #/exemple', icon:'assets-cache.js name'},
         $scope.MenuItems = [{
                   name: 'Início',
                   link: '#/',
                   icon: './img/ic_home_black_24px.svg'
              },
              //{name:'Administração', link:'#/administracao', icon:'vendas'},
              {
                   name: 'Usuarios',
                   link: '#/usuarios',
                   icon: './img/ic_person_add_black_24px.svg'

              },
              {
                   name: 'Clientes',
                   link: '#/clientes',
                   icon: './img/ic_group_add_black_24px.svg'
              }


         ];
         $scope.sair = function() {
              localStorage.removeItem('user_session');
              sessionStorage.removeItem('user_session');
              window.location = "/";
         };
         //{name:'Financeiro', link:'#/financeiro', icon:'ic_attach_money_24px'},
         //{name:'Vendas', link:'#/vendas', icon:'vendas'}]
         //{name:'Estoque', link:'#/estoque', icon:'favorite'}]
    });
