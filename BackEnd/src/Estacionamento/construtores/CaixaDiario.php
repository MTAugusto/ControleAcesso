class CaixaDiario{

private $id;
private $abertura;
private $fechamento;
private $valortotal;
public function __construct($id = 0,$abertura = "0000-00-00 00:00:00",$fechamento = "0000-00-00 00:00:00",$valortotal = 0){
$this->id = $id;
$this->abertura = $abertura;
$this->fechamento = $fechamento;
$this->valortotal = $valortotal;

}

public static function construct($array){
$obj = new CaixaDiario();
$obj->setId( $array['id']);
$obj->setAbertura( $array['abertura']);
$obj->setFechamento( $array['fechamento']);
$obj->setValortotal( $array['valortotal']);
return $obj;

}

public function getId(){
return $this->id;
}

public function setId($id){
 $this->id=$id;
}

public function getAbertura(){
return $this->abertura;
}

public function setAbertura($abertura){
 $this->abertura=$abertura;
}

public function getFechamento(){
return $this->fechamento;
}

public function setFechamento($fechamento){
 $this->fechamento=$fechamento;
}

public function getValortotal(){
return $this->valortotal;
}

public function setValortotal($valortotal){
 $this->valortotal=$valortotal;
}
public function equals($object){
if($object instanceof CaixaDiario){

if($this->id!=$object->id){
return false;

}

if($this->abertura!=$object->abertura){
return false;

}

if($this->fechamento!=$object->fechamento){
return false;

}

if($this->valortotal!=$object->valortotal){
return false;

}

return true;

}
else{
return false;
}

}
public function toString(){

 return "  [id:" .$this->id. "]  [abertura:" .$this->abertura. "]  [fechamento:" .$this->fechamento. "]  [valortotal:" .$this->valortotal. "]  " ;
}

}