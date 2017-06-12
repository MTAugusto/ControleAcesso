<?php

// ini_set('display_errors',1);
// ini_set('display_startup_erros',1);
// error_reporting(E_ALL);

require_once('../vendor/autoload.php');

use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\ValidationData;
use Lcobucci\JWT\Parser;

	$signer = new Sha256();
	$key = base64_encode("#Bolsomito2018");
	$site = "http://www.montanheiro.me";

	function gerarToken($id=0, $admin)
	{
		global $signer;
		global $key;
		global $site;

		if ($id == 0){
			$response=array(
				'status' => 0,
				'message' =>'Usuário não encontrado.'
			);
			header('Content-Type: application/json');
			header("HTTP/2.0 400 Bad Request");
			echo json_encode($response);
			return;
		}

		$token = (new Builder())
			->setIssuer($site)
            ->setExpiration(time() + (8*3600)) //mudar o fator da multiplicação para aumentar as horas de validade do token
            ->set('id', $id)
            ->set('admin', $admin)
            ->sign($signer, $key) 
            ->getToken();

        $response=array(
			'status' => 1,
			'token' => "$token"
		);
		header('Content-Type: application/json');
		echo json_encode($response);

//        echo $token;
	}

	function verificarToken()
	{
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
				'status' => 2,
				'message' =>'O token não foi enviado corretamente.'
			);
			header('Content-Type: application/json');
			header("HTTP/2.0 400 Bad Request");
		}else{
			// Cria um objeto Token para validar e instancia o validador
			try {
    			$token = (new Parser())->parse((string) $token);
			} catch (Exception $e) {
    			$response=array(
					'status' => 2,
					'message' =>'Token invalido.'
				);
				header('Content-Type: application/json');
				header("HTTP/2.0 400 Bad Request");
				echo json_encode($response);
			}

			
			$data = new ValidationData();

			//verifica a validade do token
			if (!$token->validate($data)) {
				$response=array(
					'status' => 2,
					'message' =>'Token expirado, faça um novo login.'
				);
				header('Content-Type: application/json');
				header("HTTP/2.0 400 Bad Request");
				echo json_encode($response);
				return false;
			}

			//verifica a assinatura do token
			if ($token->verify($signer, $key)) {
				
				$response=array(
					'status' => 2,
					'message' =>'Token valido.'
				);
			}
			else
			{
				$response=array(
					'status' => 2,
					'message' =>'Token invalido.'
				);
				header("HTTP/2.0 400 Bad Request");
			}
		}
				
		header('Content-Type: application/json');
		echo json_encode($response);

	}

	function verificarLogin($tipo){
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
				'status' => 2,
				'message' =>'O token não foi enviado corretamente.'
			);
			header('Content-Type: application/json');
			header("HTTP/2.0 400 Bad Request");
			echo json_encode($response);
			return false;
		}else{
			// Cria um objeto Token para validar e instancia o validador
			try {
    			$token = (new Parser())->parse((string) $token);
			} catch (Exception $e) {
    			$response=array(
					'status' => 2,
					'message' =>'O token está no formato errado.'
				);
				header('Content-Type: application/json');
				header("HTTP/2.0 400 Bad Request");
				echo json_encode($response);
				return false;
			}
			$data = new ValidationData();

			//verifica a validade do token
			if (!$token->validate($data)) {
				$response=array(
					'status' => 2,
					'message' =>'Token expirado, faça um novo login.'
				);
				header('Content-Type: application/json');
				header("HTTP/2.0 400 Bad Request");
				echo json_encode($response);
				return false;
			}

			//verifica a assinatura do token
			if ($token->verify($signer, $key)) {
				if ($tipo == "admin") {
					if ($token->getClaim('admin') != 1) {
						$response=array(
							'status' => 0,
							'message' =>'Você não tem as permissões necessárias para acessar esse serviço.'
						);
						header('Content-Type: application/json');
						header("HTTP/2.0 400 Bad Request");
						echo json_encode($response);
						return false;
					}
				}
			}
			else
			{
				$response=array(
					'status' => 2,
					'message' =>'Token invalido.'
				);
				header('Content-Type: application/json');
				header("HTTP/2.0 400 Bad Request");
				echo json_encode($response);
				return false;
			}
		}
		return true;
	}

	function getIdUser(){
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
				'status' => 2,
				'message' =>'O token não foi enviado corretamente.'
			);
			header('Content-Type: application/json');
			header("HTTP/2.0 400 Bad Request");
			echo json_encode($response);
			return 0;
		}else{
			// Cria um objeto Token para validar e instancia o validador
			try {
    			$token = (new Parser())->parse((string) $token);
			} catch (Exception $e) {
    			$response=array(
					'status' => 2,
					'message' =>'O token está no formato errado.'
				);
				header('Content-Type: application/json');
				header("HTTP/2.0 400 Bad Request");
				echo json_encode($response);
				return 0;
			}
			$data = new ValidationData();

			//verifica a validade do token
			if (!$token->validate($data)) {
				$response=array(
					'status' => 2,
					'message' =>'Token expirado, faça um novo login.'
				);
				header('Content-Type: application/json');
				header("HTTP/2.0 400 Bad Request");
				echo json_encode($response);
				return false;
			}

			//verifica a assinatura do token
			if ($token->verify($signer, $key)) {
				return $token->getClaim('id');
			}
			else
			{
				$response=array(
					'status' => 2,
					'message' =>'Token invalido.'
				);
				header('Content-Type: application/json');
				header("HTTP/2.0 400 Bad Request");
				echo json_encode($response);
				return 0;
			}
		}
	}