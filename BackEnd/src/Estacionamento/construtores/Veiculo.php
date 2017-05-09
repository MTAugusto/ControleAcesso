<?php
  class Veiculo{

  private $id;
  private $tipo;
  private $placa;
  private $modelo;
  private $ismensal;
  public function __construct($id = 0,$tipo= null,$placa= "" ,$modelo= "" ,$ismensal = 0){
  $this->id = $id;
  $this->tipo = $tipo;
  $this->placa = $placa;
  $this->modelo = $modelo;
  $this->ismensal = $ismensal;

  }

  public static function construct($array){
  $obj = new Veiculo();
  $obj->setId( $array['id']);
  $obj->setTipo( $array['tipo']);
  $obj->setPlaca( $array['placa']);
  $obj->setModelo( $array['modelo']);
  $obj->setIsmensal( $array['ismensal']);
  return $obj;

  }

  public function getId(){
  return $this->id;
  }

  public function setId($id){
   $this->id=$id;
  }

  public function getTipo(){
  return $this->tipo;
  }

  public function setTipo($tipo){
   $this->tipo=$tipo;
  }

  public function getPlaca(){
  return $this->placa;
  }

  public function setPlaca($placa){
   $this->placa=$placa;
  }

  public function getModelo(){
  return $this->modelo;
  }

  public function setModelo($modelo){
   $this->modelo=$modelo;
  }

  public function getIsmensal(){
  return $this->ismensal;
  }

  public function setIsmensal($ismensal){
   $this->ismensal=$ismensal;
  }
  public function equals($object){
  if($object instanceof Veiculo){

  if($this->id!=$object->id){
  return false;

  }

  if($this->tipo!=$object->tipo){
  return false;

  }

  if($this->placa!=$object->placa){
  return false;

  }

  if($this->modelo!=$object->modelo){
  return false;

  }

  if($this->ismensal!=$object->ismensal){
  return false;

  }

  return true;

  }
  else{
  return false;
  }

  }
  public function toString(){

   return "  [id:" .$this->id. "]  [tipo:" .$this->tipo. "]  [placa:" .$this->placa. "]  [modelo:" .$this->modelo. "]  [ismensal:" .$this->ismensal. "]  " ;
  }

  }
?>
