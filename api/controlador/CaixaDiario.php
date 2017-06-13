	<?php
	include '../persistencia/CaixaDiarioDAO.php';
	include '../persistencia/Connect.php';
	include '../negocio/Token.php';

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
					header("HTTP/2.0 400 Bad Request");
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
						header("HTTP/2.0 400 Bad Request");
						echo json_encode($response);
						break;
					}
					$data = new ValidationData();

					//verifica a validade do token
					if (!$token->validate($data)) {
						$response=array(
							'status' => 0,
							'message' =>'Token expirado, faça um novo login.'
						);
						header('Content-Type: application/json');
						header("HTTP/2.0 400 Bad Request");
						echo json_encode($response);
						return false;
					}

					//verifica a assinatura do token
					if (!$token->verify($signer, $key)) {
						$response=array(
							'status' => 0,
							'message' =>'Token invalido.'
						);
						header('Content-Type: application/json');
						header("HTTP/2.0 400 Bad Request");
						echo json_encode($response);
						break;
					}
				}

				// agora sim parte normal da classe

				if ($token->getClaim('admin') == 1) {
					if(!empty($_GET["id"])){
						$id=intval($_GET["id"]);
						retrieve($id);
					} elseif (!empty($_GET["usuario"])) {
						$usuario=intval($_GET["usuario"]);
						retrieveByUser($usuario);
					}
					 else {
						retrieve();
					}
				}else{
					retrieveByUser(getIdUser());
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
