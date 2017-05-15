<?php
$loader = require __DIR__ . '/vendor/autoload.php';
  use \BackEnd\src\Estacionamento\construtores\Usuario;
  use \BackEnd\src\Estacionamento\persistencia\UsuarioDAO;

  //($id = 0,$nome= "" ,$usuario= "" ,$senha= "" ,$status = 0,$admin = 0)
  //echo alert("merda");

  $user = new Usuario("1","lucas","123","1","1");
  $dao = new UsuarioDAO();
  $dao ->insert($user);
?>
