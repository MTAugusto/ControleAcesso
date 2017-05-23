<?php

	function insert()
	{
		date_default_timezone_set('America/Sao_Paulo');
		global $connection;
		$placaVeiculo=$_POST["placa"];
		$cortesia=$_POST["cortesia"];
		$dataAtual=date("Y-m-d H:i:s", time());
		$usuarioAtual = getIdUser();
		$dataMensal = date('Y-m-d');

		//buscar veiculo com base em uma placa -- $veiculo[0]->id;
		$query1="SELECT * FROM veiculos WHERE placa='".$placaVeiculo."' LIMIT 1";
		$veiculo=array();
		$result=mysqli_query($connection, $query1);
		while($row=mysqli_fetch_object($result))
		{
			$veiculo[]=$row;
		}

		//buscar entrada veiculo -- $entrada[0]->id;
		$query2="SELECT * FROM entradas_veiculos WHERE veiculo='".$veiculo[0]->id."' AND jasaiu=0 LIMIT 1";
		$entrada=array();
		$result=mysqli_query($connection, $query2);
		while($row=mysqli_fetch_object($result))
		{
			$entrada[]=$row;
		}

		//buscar tipo do veiculo -- $tipo[0]->id;
		$query3="SELECT * FROM tipos WHERE id='".$veiculo[0]->tipo."' LIMIT 1";
		$tipo=array();
		$result=mysqli_query($connection, $query3);
		while($row=mysqli_fetch_object($result))
		{
			$tipo[]=$row;
		}

		//buscar mensalidade do veiculo -- $mensalidade[0]->id;
		$query3="SELECT * FROM mensalidades WHERE veiculo='".$veiculo[0]->id."' LIMIT 1";
		$mensalidade=array();
		$result=mysqli_query($connection, $query3);
		while($row=mysqli_fetch_object($result))
		{
			$mensalidade[]=$row;
		}

		//validando veiculo e entrada
		$error = false;
		if ($entrada[0]->id == 0) {
			$erro = "a entrada";
			$error = true;
		}elseif ($veiculo[0]->id == 0) {
			$erro = "o veículo";
			$error = true;
		}elseif ($tipo[0]->id == 0) {
			$erro = "o tipo do veículo";
			$error = true;
		}elseif ($mensalidade[0]->id == 0) {
			$erro = "a mensalidade do veículo";
			$error = true;
		}

		if ($error) {
			$response=array(
					'status' => 0,
					'message' =>"Não foi encontrado $erro."
				);
			header("HTTP/2.0 400 Bad Request");
			header('Content-Type: application/json');
			echo json_encode($response);
			return;
		}

		//inserindo a saida bonificada
		if ($cortesia) {
			$query4="INSERT INTO saidas_veiculos SET usuario={$usuarioAtual}, entrada_veiculo={$entrada[0]->id}, data='{$dataAtual}', valor=0, iscortesia=1";
			$query5="UPDATE entradas_veiculos SET jasaiu=1 WHERE id=".$entrada[0]->id;
			if(mysqli_query($connection, $query4) && mysqli_query($connection, $query5))
			{
				$response=array(
					'status' => 1,
					'message' =>'Saída com cortesia efetuada com sucesso!'
				);
			}
			else
			{
				$response=array(
					'status' => 0,
					'message' =>'Houve um erro na saída.'
				);
				header("HTTP/2.0 400 Bad Request");
			}


		}elseif ($veiculo[0]->ismensal) { // se é mensal
			if ($dataMensal == $mensalidade[0]->datavencimento) {//se for o dia de pagar a mensalidade 
				$valorPagar = $tipo[0]->valorpormes;
				$query6="INSERT INTO saidas_veiculos SET usuario={$usuarioAtual}, entrada_veiculo={$entrada[0]->id}, data='{$dataAtual}', valor={$valorPagar}, iscortesia=0";
			}else{ //se não for o dia de cobrar a mensalidade
				$valorPagar = 0;
				$query6="INSERT INTO saidas_veiculos SET usuario={$usuarioAtual}, entrada_veiculo={$entrada[0]->id}, data='{$dataAtual}', valor={$valorPagar}, iscortesia=0";
				
			}
		}else{ //se não for mensal cobra o valor das horas que ficou
			$dataEntrada = new DateTime($entrada[0]->data);
			$dataAgora = new DateTime();
			$tempoGasto = ($dataAgora->diff($dataEntrada)->format('%H'))*60+$dataAgora->diff($dataEntrada)->format('%I');
			$valorPagar = ($tipo[0]->valorporhora/60)*$tempoGasto;
			$query6="INSERT INTO saidas_veiculos SET usuario={$usuarioAtual}, entrada_veiculo={$entrada[0]->id}, data='{$dataAtual}', valor={$valorPagar}, iscortesia=0";
		}

		if(!mysqli_query($connection, $query6))
		{
			$response=array(
				'status' => 0,
				'message' =>'Houve um erro ao gravar a saída.'
			);
			header("HTTP/2.0 400 Bad Request");
		}	
		//retornando o id da saida criada
		$saidaId = mysqli_insert_id($connection);

		//retornando caixa aberto do usuário -- usuario, data, fechamento ==null
		$query7="SELECT * FROM caixadiarios WHERE usuario={$usuarioAtual} AND data='{$dataMensal}' AND isfechado=0 LIMIT 1";
		$caixa=array();
		$result=mysqli_query($connection, $query7);
		while($row=mysqli_fetch_object($result))
		{
			$caixa[]=$row;
		}

		//vincula a saida ao caixa
		$query8="INSERT INTO movimentacao_caixadiario SET saida_veiculo={$saidaId}, caixadiario={$caixa[0]->id}";
		$query9="UPDATE entradas_veiculos SET jasaiu=1 WHERE id=".$entrada[0]->id;
		if(mysqli_query($connection, $query8) && mysqli_query($connection, $query9))
		{
			$response=array(
				'status' => 1,
				'message' => 'Saída efetuada com sucesso!',
				'valortotal' => "$valorPagar"
			);
		}
		else
		{
			$response=array(
				'status' => 0,
				'message' =>'Houve um erro ao registrar a saída.'
			);
			header("HTTP/2.0 400 Bad Request");
		}

		header('Content-Type: application/json');
		echo json_encode($response);
	}
	function retrieve($id=0)
	{

		//mudar reatrieve para admin retornar todos


		global $connection;
		$query="SELECT * FROM entradas_veiculos";
		if($id != 0)
		{
			$query.=" WHERE id=".$id." LIMIT 1";
		}
		$response=array();
		$result=mysqli_query($connection, $query);
		while($row=mysqli_fetch_object($result))
		{
			$response[]=$row;
		}
		header('Content-Type: application/json');
		echo json_encode($response);
	}
	// function delete($id)
	// {
	// 	global $connection;
	// 	$query="DELETE FROM entradas_veiculos WHERE id=".$id;
	// 	if(mysqli_query($connection, $query))
	// 	{
	// 		$response=array(
	// 			'status' => 1,
	// 			'message' =>'Deletado com sucesso.'
	// 		);
	// 	}
	// 	else
	// 	{
	// 		$response=array(
	// 			'status' => 0,
	// 			'message' =>'Houve um erro ao deletar.'
	// 		);
	// 	}
	// 	header('Content-Type: application/json');
	// 	echo json_encode($response);
	// }



	//===========> upidate pode ser usado para desconto


	//===========> pode ser usado para desconto


	//===========> pode ser usado para desconto


	//===========> pode ser usado para desconto



	// function update()              
	// {
	// 	global $connection;
	// 	parse_str(file_get_contents("php://input"),$post_vars);
	// 	$idMovimentacao=$post_vars['id'];
	// 	$veiculo=$post_vars['veiculo'];
	// 	$data=$post_vars["data"];
	// 	$valorpormes=$post_vars["valorpormes"];
	// 	$query="UPDATE entradas_veiculos SET veiculo='{$veiculo}', data='{$data}', valorpormes='{$valorpormes}' WHERE id=".$idMovimentacao;
	// 	if(mysqli_query($connection, $query))
	// 	{
	// 		$response=array(
	// 			'status' => 1,
	// 			'message' =>'Atualizado com sucesso.'
	// 		);
	// 	}
	// 	else
	// 	{
	// 		$response=array(
	// 			'status' => 0,
	// 			'message' =>'Houve um erro ao atualizar.'
	// 		);
	// 	}
	// 	header('Content-Type: application/json');
	// 	echo json_encode($response);
	//
	// 	//retornar dados da saida com veiculo
	// }

	// Close database connection
	mysqli_close($connection);
