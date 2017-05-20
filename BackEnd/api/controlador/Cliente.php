<?php
include '../persistencia/ClienteDAO.php';
include '../persistencia/Connect.php';
include '../negocio/Token.php';

	$request_method=$_SERVER["REQUEST_METHOD"];

	switch($request_method)
	{
		case 'GET':
			if(verificarLogin()){

				if(!empty($_GET["id"]))
				{
					$id=intval($_GET["id"]);
					retrieve($id);
				}
				else retrieve();
			}
			break;
		case 'POST':
			if(verificarLogin()) insert();
			break;
		case 'PUT':
			if(verificarLogin()) update();
			break;
		case 'OPTIONS':
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
