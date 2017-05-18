<?php
include '../persistencias/ClienteDAO.php';
include '../persistencias/Connect.php';
include '../controladores/Token.php';

	$request_method=$_SERVER["REQUEST_METHOD"];

	switch($request_method)
	{
		case 'GET':
			if(verificarLogin()){
				if(!empty($_GET["id"]))
				{
					$id=intval($_GET["id"]);
					retreave($id);
				}
				else retreave();
			}
			break;
		case 'POST':
			insert();
			break;
		case 'PUT':
			$id=intval($_GET["id"]);
			update($id);
			break;
		// case 'DELETE':
		// 	// Delete Product
		// 	$id=intval($_GET["id"]);
		// 	delete($id);
		// 	break;
		default:
			// Invalid Request Method
			header("HTTP/2.0 405 Method Not Allowed");
			break;
	}

?>
