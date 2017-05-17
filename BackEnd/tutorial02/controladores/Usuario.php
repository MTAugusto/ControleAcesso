<?php
include '../persistencias/UsuarioDAO.php';
include '../persistencias/Connect.php';
include '../controladores/Token.php';

	$request_method=$_SERVER["REQUEST_METHOD"];

	switch($request_method)
	{
		case 'GET':
			// Retrive Products
			if(!empty($_GET["id"]))
			{
				verificarLogin();
				$id=intval($_GET["id"]);
				retreave($id);
			}
			else
			{
				if(verificarLogin("admin"))	retreave();
			}
			break;
		case 'POST':
			// Insert Product
			insert();
			break;
		case 'PUT':
			// Update Product
			$id=intval($_GET["id"]);
			update($id);
			break;
		case 'DELETE':
			// Delete Product
			$id=intval($_GET["id"]);
			delete($id);
			break;
		default:
			// Invalid Request Method
			header("HTTP/2.0 405 Method Not Allowed");
			break;
	}

?>
