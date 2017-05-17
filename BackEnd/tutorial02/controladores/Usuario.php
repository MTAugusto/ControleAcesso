<?php
include '../persistencias/UsuarioDAO.php';
include '../persistencias/Connect.php';
include '../controladores/Token.php';

	$request_method=$_SERVER["REQUEST_METHOD"];

	switch($request_method)
	{
		case 'GET':
			//buscando um ou vários usuários
			if(verificarLogin("admin")){
				if(!empty($_GET["id"]))
				{
					$id=intval($_GET["id"]);
					retreave($id);
				}
				else
				{
					retreave();
				}
			}else{
				retreave(getIdUser());
			}

			break;
		case 'POST':
			// Insert Product
			if(verificarLogin("admin")) insert();
			break;
		case 'PUT':
			// Update Product
			if(verificarLogin("admin")){
				$id=intval($_GET["id"]);
				update($id);
			}else update(getIdUser());
			break;
		case 'DELETE':
			// Delete Product
			if(verificarLogin("admin")){
				$id=intval($_GET["id"]);
				delete($id);
			}			
			break;
		default:
			// Invalid Request Method
			header("HTTP/2.0 405 Method Not Allowed");
			break;
	}

?>
