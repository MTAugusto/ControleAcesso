<?php 
  class SaidaCaixaDiario{

  private $saidaveiculo;
  private $caixadiario;
  public function __construct($saidaveiculo = 0,$caixadiario = 0){
  $this->saidaveiculo = $saidaveiculo;
  $this->caixadiario = $caixadiario;

  }

  public static function construct($array){
  $obj = new SaidaCaixaDiario();
  $obj->setSaidaveiculo( $array['saidaveiculo']);
  $obj->setCaixadiario( $array['caixadiario']);
  return $obj;

  }

  public function getSaidaveiculo(){
  return $this->saidaveiculo;
  }

  public function setSaidaveiculo($saidaveiculo){
   $this->saidaveiculo=$saidaveiculo;
  }

  public function getCaixadiario(){
  return $this->caixadiario;
  }

  public function setCaixadiario($caixadiario){
   $this->caixadiario=$caixadiario;
  }
  public function equals($object){
  if($object instanceof SaidaCaixaDiario){

  if($this->saidaveiculo!=$object->saidaveiculo){
  return false;

  }

  if($this->caixadiario!=$object->caixadiario){
  return false;

  }

  return true;

  }
  else{
  return false;
  }

  }
  public function toString(){

   return "  [saidaveiculo:" .$this->saidaveiculo. "]  [caixadiario:" .$this->caixadiario. "]  " ;
  }

  }
?>
