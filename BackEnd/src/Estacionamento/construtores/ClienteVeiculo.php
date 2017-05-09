<<?php 
  class ClienteVeiculo{

  private $cliente;
  private $veiculo;
  public function __construct($cliente = 0,$veiculo = 0){
  $this->cliente = $cliente;
  $this->veiculo = $veiculo;

  }

  public static function construct($array){
  $obj = new ClienteVeiculo();
  $obj->setCliente( $array['cliente']);
  $obj->setVeiculo( $array['veiculo']);
  return $obj;

  }

  public function getCliente(){
  return $this->cliente;
  }

  public function setCliente($cliente){
   $this->cliente=$cliente;
  }

  public function getVeiculo(){
  return $this->veiculo;
  }

  public function setVeiculo($veiculo){
   $this->veiculo=$veiculo;
  }
  public function equals($object){
  if($object instanceof ClienteVeiculo){

  if($this->cliente!=$object->cliente){
  return false;

  }

  if($this->veiculo!=$object->veiculo){
  return false;

  }

  return true;

  }
  else{
  return false;
  }

  }
  public function toString(){

   return "  [cliente:" .$this->cliente. "]  [veiculo:" .$this->veiculo. "]  " ;
  }

  }
  ?>
