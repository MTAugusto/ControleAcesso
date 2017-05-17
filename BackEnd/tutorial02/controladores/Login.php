<?php
include '../persistencias/ClienteDAO.php';
include '../persistencias/Connect.php';

use \ControleAcesso\BackEnd\tutorial02\jwt\ValidationData;
use \ControleAcesso\BackEnd\tutorial02\jwt\Builder;

	$request_method=$_SERVER["REQUEST_METHOD"];
	$token = $_SERVER['REDIRECT_HTTP_AUTHORIZATION'];

	switch($request_method)
	{
		case 'GET':
			echo "teste - ";
			echo $token;
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
