<?php
namespace Estacionamento\construtores;

 use Estacionamento\construtores\Entidade;

  class Usuario extends Entidade{

  private $id;
  private $nome;
  private $usuario;
  private $senha;
  private $status;
  private $admin;
  public function __construct($id = 0,$nome= "" ,$usuario= "" ,$senha= "" ,$status = 0,$admin = 0){
  $this->id = $id;
  $this->nome = $nome;
  $this->usuario = $usuario;
  $this->senha = $senha;
  $this->status = $status;
  $this->admin = $admin;

  }

  public static function construct($array){
  $obj = new Usuario();
  $obj->setId( $array['id']);
  $obj->setNome( $array['nome']);
  $obj->setUsuario( $array['usuario']);
  $obj->setSenha( $array['senha']);
  $obj->setStatus( $array['status']);
  $obj->setAdmin( $array['admin']);
  return $obj;

  }

  public function getId(){
  return $this->id;
  }

  public function setId($id){
   $this->id=$id;
  }

  public function getNome(){
  return $this->nome;
  }

  public function setNome($nome){
   $this->nome=$nome;
  }

  public function getUsuario(){
  return $this->usuario;
  }

  public function setUsuario($usuario){
   $this->usuario=$usuario;
  }

  public function getSenha(){
  return $this->senha;
  }

  public function setSenha($senha){
   $this->senha=$senha;
  }

  public function getStatus(){
  return $this->status;
  }

  public function setStatus($status){
   $this->status=$status;
  }

  public function getAdmin(){
  return $this->admin;
  }

  public function setAdmin($admin){
   $this->admin=$admin;
  }
  public function equals($object){
  if($object instanceof Usuario){

  if($this->id!=$object->id){
  return false;

  }

  if($this->nome!=$object->nome){
  return false;

  }

  if($this->usuario!=$object->usuario){
  return false;

  }

  if($this->senha!=$object->senha){
  return false;

  }

  if($this->status!=$object->status){
  return false;

  }

  if($this->admin!=$object->admin){
  return false;

  }

  return true;

  }
  else{
  return false;
  }

  }
  public function toString(){

   return "  [id:" .$this->id. "]  [nome:" .$this->nome. "]  [usuario:" .$this->usuario. "]  [senha:" .$this->senha. "]  [status:" .$this->status. "]  [admin:" .$this->admin. "]  " ;
  }

  }
?>
