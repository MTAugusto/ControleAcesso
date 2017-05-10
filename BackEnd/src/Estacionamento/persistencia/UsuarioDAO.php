<?php
namespace Estacionamento\persistencia;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;
use Estacionamento\persistencia\AbstractDAO;
use Estacionamento\construtores\Usuario;

class UsuarioDAO extends AbstractDAO{
public function __construct() {
    //Chama o construtor pai de AbstractDAO e passa o Usuario como argumento
		parent::__construct('Estacionamento\construtores\Usuario');
	}
}
