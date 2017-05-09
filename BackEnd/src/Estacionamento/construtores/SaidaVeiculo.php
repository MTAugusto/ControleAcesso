class SaidaVeiculo{

private $id;
private $usuario;
private $movimentacaoVeiculo;
private $valor;
private $iscortesia;
public function __construct($id = 0,$usuario= null,$movimentacaoVeiculo= null,$valor = 0,$iscortesia = 0){
$this->id = $id;
$this->usuario = $usuario;
$this->movimentacaoVeiculo = $movimentacaoVeiculo;
$this->valor = $valor;
$this->iscortesia = $iscortesia;

}

public static function construct($array){
$obj = new SaidaVeiculo();
$obj->setId( $array['id']);
$obj->setUsuario( $array['usuario']);
$obj->setMovimentacaoVeiculo( $array['movimentacaoVeiculo']);
$obj->setValor( $array['valor']);
$obj->setIscortesia( $array['iscortesia']);
return $obj;

}

public function getId(){
return $this->id;
}

public function setId($id){
 $this->id=$id;
}

public function getUsuario(){
return $this->usuario;
}

public function setUsuario($usuario){
 $this->usuario=$usuario;
}

public function getMovimentacaoVeiculo(){
return $this->movimentacaoVeiculo;
}

public function setMovimentacaoVeiculo($movimentacaoVeiculo){
 $this->movimentacaoVeiculo=$movimentacaoVeiculo;
}

public function getValor(){
return $this->valor;
}

public function setValor($valor){
 $this->valor=$valor;
}

public function getIscortesia(){
return $this->iscortesia;
}

public function setIscortesia($iscortesia){
 $this->iscortesia=$iscortesia;
}
public function equals($object){
if($object instanceof SaidaVeiculo){

if($this->id!=$object->id){
return false;

}

if($this->usuario!=$object->usuario){
return false;

}

if($this->movimentacaoVeiculo!=$object->movimentacaoVeiculo){
return false;

}

if($this->valor!=$object->valor){
return false;

}

if($this->iscortesia!=$object->iscortesia){
return false;

}

return true;

}
else{
return false;
}

}
public function toString(){

 return "  [id:" .$this->id. "]  [usuario:" .$this->usuario. "]  [movimentacaoVeiculo:" .$this->movimentacaoVeiculo. "]  [valor:" .$this->valor. "]  [iscortesia:" .$this->iscortesia. "]  " ;
}

}