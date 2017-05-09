class Tipo{

private $id;
private $nome;
private $valorporhora;
private $valorpormes;
public function __construct($id = 0,$nome= "" ,$valorporhora = 0,$valorpormes = 0){
$this->id = $id;
$this->nome = $nome;
$this->valorporhora = $valorporhora;
$this->valorpormes = $valorpormes;

}

public static function construct($array){
$obj = new Tipo();
$obj->setId( $array['id']);
$obj->setNome( $array['nome']);
$obj->setValorporhora( $array['valorporhora']);
$obj->setValorpormes( $array['valorpormes']);
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

public function getValorporhora(){
return $this->valorporhora;
}

public function setValorporhora($valorporhora){
 $this->valorporhora=$valorporhora;
}

public function getValorpormes(){
return $this->valorpormes;
}

public function setValorpormes($valorpormes){
 $this->valorpormes=$valorpormes;
}
public function equals($object){
if($object instanceof Tipo){

if($this->id!=$object->id){
return false;

}

if($this->nome!=$object->nome){
return false;

}

if($this->valorporhora!=$object->valorporhora){
return false;

}

if($this->valorpormes!=$object->valorpormes){
return false;

}

return true;

}
else{
return false;
}

}
public function toString(){

 return "  [id:" .$this->id. "]  [nome:" .$this->nome. "]  [valorporhora:" .$this->valorporhora. "]  [valorpormes:" .$this->valorpormes. "]  " ;
}

}