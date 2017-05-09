<<?php 
  class Mensalidade{

  private $id;
  private $cliente;
  private $veiculo;
  private $datavencimento;
  public function __construct($id = 0,$cliente = 0,$veiculo = 0,$datavencimento = "0000-00-00 00:00:00"){
  $this->id = $id;
  $this->cliente = $cliente;
  $this->veiculo = $veiculo;
  $this->datavencimento = $datavencimento;

  }

  public static function construct($array){
  $obj = new Mensalidade();
  $obj->setId( $array['id']);
  $obj->setCliente( $array['cliente']);
  $obj->setVeiculo( $array['veiculo']);
  $obj->setDatavencimento( $array['datavencimento']);
  return $obj;

  }

  public function getId(){
  return $this->id;
  }

  public function setId($id){
   $this->id=$id;
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

  public function getDatavencimento(){
  return $this->datavencimento;
  }

  public function setDatavencimento($datavencimento){
   $this->datavencimento=$datavencimento;
  }
  public function equals($object){
  if($object instanceof Mensalidade){

  if($this->id!=$object->id){
  return false;

  }

  if($this->cliente!=$object->cliente){
  return false;

  }

  if($this->veiculo!=$object->veiculo){
  return false;

  }

  if($this->datavencimento!=$object->datavencimento){
  return false;

  }

  return true;

  }
  else{
  return false;
  }

  }
  public function toString(){

   return "  [id:" .$this->id. "]  [cliente:" .$this->cliente. "]  [veiculo:" .$this->veiculo. "]  [datavencimento:" .$this->datavencimento. "]  " ;
  }

  }
?>
