<?php  
  class Cliente{

  private $id;
  private $nome;
  private $cpf;
  private $telefone;
  public function __construct($id = 0,$nome= "" ,$cpf= "" ,$telefone= "" ){
  $this->id = $id;
  $this->nome = $nome;
  $this->cpf = $cpf;
  $this->telefone = $telefone;

  }

  public static function construct($array){
  $obj = new Cliente();
  $obj->setId( $array['id']);
  $obj->setNome( $array['nome']);
  $obj->setCpf( $array['cpf']);
  $obj->setTelefone( $array['telefone']);
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

  public function getCpf(){
  return $this->cpf;
  }

  public function setCpf($cpf){
   $this->cpf=$cpf;
  }

  public function getTelefone(){
  return $this->telefone;
  }

  public function setTelefone($telefone){
   $this->telefone=$telefone;
  }
  public function equals($object){
  if($object instanceof Cliente){

  if($this->id!=$object->id){
  return false;

  }

  if($this->nome!=$object->nome){
  return false;

  }

  if($this->cpf!=$object->cpf){
  return false;

  }

  if($this->telefone!=$object->telefone){
  return false;

  }

  return true;

  }
  else{
  return false;
  }

  }
  public function toString(){

   return "  [id:" .$this->id. "]  [nome:" .$this->nome. "]  [cpf:" .$this->cpf. "]  [telefone:" .$this->telefone. "]  " ;
  }

  }
?>
