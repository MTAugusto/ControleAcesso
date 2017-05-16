<?php 
	
	ini_set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ALL);

	// Connect to database
	$connection=mysqli_connect('localhost','root','root','controleacesso');	

	include '.../persistencias/ClienteDAO.php'; 

	$request_method=$_SERVER["REQUEST_METHOD"];

	switch($request_method)
	{
		case 'GET':
			// Retrive Products
			if(!empty($_GET["id"]))
			{
				$id=intval($_GET["id"]);
				retreave($id);
			}
			else
			{
				retreave();
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
