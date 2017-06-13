	<?php
	include '../persistencia/UsuarioDAO.php';
	include '../persistencia/Connect.php';
	include '../negocio/Token.php';

	// ini_set('display_errors',1);
	// ini_set('display_startup_erros',1);
	// error_reporting(E_ALL);

		$request_method=$_SERVER["REQUEST_METHOD"];



		switch($request_method)
		{
			case 'GET':
				verificarToken();
				break;
			case 'POST':
				login();
				break;
			case 'OPTIONS':
				break;
			default:
				// Invalid Request Method
				header("HTTP/2.0 405 Method Not Allowed");
				break;
		}

	?>
