<?php

include '../persistencias/UsuarioDAO.php';
include '../persistencias/Connect.php';
include '../controladores/Token.php';

require_once('../vendor/autoload.php');

use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\ValidationData;
use Lcobucci\JWT\Parser;

	$request_method=$_SERVER["REQUEST_METHOD"];

	switch($request_method)
	{
		case 'GET':
			
			//Gambiarra para resolver problema especifico dessa classe
			//problema de duas permissões para acesso

			global $signer;
			global $key;
			global $site;

			//Captura o token do cabeçalho
			$headers = apache_request_headers();
			foreach ($headers as $header => $value) {
			    if ($header == "Authorization") $token = $value;
			}

			//Verifica se tem token no cabeçalho
			if (!$token){
				$response=array(
					'status' => 0,
					'message' =>'O token não foi enviado corretamente.'
				);
				header('Content-Type: application/json');
				echo json_encode($response);
				break;
			}else{
				// Cria um objeto Token para validar e instancia o validador
				try {
	    			$token = (new Parser())->parse((string) $token);
				} catch (Exception $e) {
	    			$response=array(
						'status' => 0,
						'message' =>'O token está no formato errado.'
					);
					header('Content-Type: application/json');
					echo json_encode($response);
					break;
				}
				$data = new ValidationData();

				//verifica a assinatura e a validade
				if (!$token->verify($signer, $key) || !$token->validate($data)) {
					$response=array(
						'status' => 0,
						'message' =>'Token invalido.'
					);
					header('Content-Type: application/json');
					echo json_encode($response);
					break;
				}
			}

			// agora sim parte normal da classe

			if ($token->getClaim('admin') == 1) {
				if(!empty($_GET["id"])){
					$id=intval($_GET["id"]);
					retreave($id);
				} else {
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
			
			//Gambiarra para resolver problema especifico dessa classe
			//problema de duas permissões para acesso

			global $signer;
			global $key;
			global $site;

			//Captura o token do cabeçalho
			$headers = apache_request_headers();
			foreach ($headers as $header => $value) {
			    if ($header == "Authorization") $token = $value;
			}

			//Verifica se tem token no cabeçalho
			if (!$token){
				$response=array(
					'status' => 0,
					'message' =>'O token não foi enviado corretamente.'
				);
				header('Content-Type: application/json');
				echo json_encode($response);
				break;
			}else{
				// Cria um objeto Token para validar e instancia o validador
				try {
	    			$token = (new Parser())->parse((string) $token);
				} catch (Exception $e) {
	    			$response=array(
						'status' => 0,
						'message' =>'O token está no formato errado.'
					);
					header('Content-Type: application/json');
					echo json_encode($response);
					break;
				}
				$data = new ValidationData();

				//verifica a assinatura e a validade
				if (!$token->verify($signer, $key) || !$token->validate($data)) {
					$response=array(
						'status' => 0,
						'message' =>'Token invalido.'
					);
					header('Content-Type: application/json');
					echo json_encode($response);
					break;
				}
			}

			// agora sim parte normal da classe

			if ($token->getClaim('admin') == 1) {
				if(!empty($_GET["id"])){
					$id=intval($_GET["id"]);
					update($id);
				}
			}else{
				update(getIdUser());
			}
			
			break;
		// case 'DELETE':
		// 	// Delete Product
		// 	if(verificarLogin("admin")){
		// 		$id=intval($_GET["id"]);
		// 		delete($id);
		// 	}			
		// 	break;
		default:
			// Invalid Request Method
			header("HTTP/2.0 405 Method Not Allowed");
			break;
	}

?>
