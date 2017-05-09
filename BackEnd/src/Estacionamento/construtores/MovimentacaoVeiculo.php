<<?php
  class MovimentacaoVeiculo{

  private $id;
  private $veiculo;
  private $data;
  private $entradaousaida;
  public function __construct($id = 0,$veiculo= null,$data = "0000-00-00 00:00:00",$entradaousaida = 0){
  $this->id = $id;
  $this->veiculo = $veiculo;
  $this->data = $data;
  $this->entradaousaida = $entradaousaida;

  }

  public static function construct($array){
  $obj = new MovimentacaoVeiculo();
  $obj->setId( $array['id']);
  $obj->setVeiculo( $array['veiculo']);
  $obj->setData( $array['data']);
  $obj->setEntradaousaida( $array['entradaousaida']);
  return $obj;

  }

  public function getId(){
  return $this->id;
  }

  public function setId($id){
   $this->id=$id;
  }

  public function getVeiculo(){
  return $this->veiculo;
  }

  public function setVeiculo($veiculo){
   $this->veiculo=$veiculo;
  }

  public function getData(){
  return $this->data;
  }

  public function setData($data){
   $this->data=$data;
  }

  public function getEntradaousaida(){
  return $this->entradaousaida;
  }

  public function setEntradaousaida($entradaousaida){
   $this->entradaousaida=$entradaousaida;
  }
  public function equals($object){
  if($object instanceof MovimentacaoVeiculo){

  if($this->id!=$object->id){
  return false;

  }

  if($this->veiculo!=$object->veiculo){
  return false;

  }

  if($this->data!=$object->data){
  return false;

  }

  if($this->entradaousaida!=$object->entradaousaida){
  return false;

  }

  return true;

  }
  else{
  return false;
  }

  }
  public function toString(){

   return "  [id:" .$this->id. "]  [veiculo:" .$this->veiculo. "]  [data:" .$this->data. "]  [entradaousaida:" .$this->entradaousaida. "]  " ;
  }

  }
?>
