<?php

require_once('../vendor/autoload.php');

use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\ValidationData;
use Lcobucci\JWT\Parser;

	$signer = new Sha256();
	$key = base64_encode("#Bolsomito2018");
	$site = "http://www.montanheiro.me";

	function gerarToken($id)
	{

		if ($id == 0) echo "Usuario não especificado";

		$token = (new Builder())
			->setIssuer($site)
            ->setExpiration(time() + 3600)
            ->set('id', $id)
            ->sign($signer, $key) 
            ->getToken();

         echo $token;
	}

	function verificarToken()
	{

		Captura o token do cabeçalho
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
		}else{
			// Cria um objeto Token para validar e instancia o validador
			$token = (new Parser())->parse((string) $token);
			$data = new ValidationData();

			//verifica a assinatura e a validade
			if ($token->verify($signer, $key) && $token->validate($data)) {
				
				$response=array(
					'status' => 1,
					'message' =>'Token valido.'
				);
			}
			else
			{
				$response=array(
					'status' => 0,
					'message' =>'Token invalido.'
				);
			}
		}
				
		header('Content-Type: application/json');
		echo json_encode($response);

	}
?>