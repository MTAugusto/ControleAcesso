<?php

	function insert()
	{
		date_default_timezone_set('America/Sao_Paulo');
		global $connection;
		$veiculo=$_POST["veiculo"];
		$dataAtual=date("Y-m-d H:i:s", time());
		
		// VERIFICAR SE JÁ NÃO EXISTE UMA ENTRADA EM ABERTO PARA ESSE VEICULO

		// VERIFICAR SE JÁ NÃO EXISTE UMA ENTRADA EM ABERTO PARA ESSE VEICULO

		// VERIFICAR SE JÁ NÃO EXISTE UMA ENTRADA EM ABERTO PARA ESSE VEICULO

		$query="INSERT INTO entradas_veiculos SET veiculo='{$veiculo}', data='{$dataAtual}'";
		if(mysqli_query($connection, $query))
		{
			$response=array(
				'status' => 1,
				'message' =>'Adicionado com sucesso.'
			);
		}
		else
		{
			$response=array(
				'status' => 0,
				'message' =>'Houve um erro ao adicionar.'
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
	function update()
	{
		global $connection;
		parse_str(file_get_contents("php://input"),$post_vars);
		$idMovimentacao=$post_vars['id'];
		$veiculo=$post_vars['veiculo'];
		$data=$post_vars["data"];
		$valorpormes=$post_vars["valorpormes"];
		$query="UPDATE entradas_veiculos SET veiculo='{$veiculo}', data='{$data}', valorpormes='{$valorpormes}' WHERE id=".$idMovimentacao;
		if(mysqli_query($connection, $query))
		{
			$response=array(
				'status' => 1,
				'message' =>'Atualizado com sucesso.'
			);
		}
		else
		{
			$response=array(
				'status' => 0,
				'message' =>'Houve um erro ao atualizar.'
			);
		}
		header('Content-Type: application/json');
		echo json_encode($response);

		//retornar dados da saida com veiculo
	}

	// Close database connection
	mysqli_close($connection);
