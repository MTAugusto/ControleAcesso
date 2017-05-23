<?php

	function insert()
	{
		global $connection;


		// VERIFICAR SE JÁ EXISTE UMA CAIXA ABERTO

		// VERIFICAR SE JÁ EXISTE UMA CAIXA ABERTO

		// VERIFICAR SE JÁ EXISTE UMA CAIXA ABERTO

		$date = date("Y-m-d H:i:s");
		$dataAtual = date('Y-m-d');
		$usuario = getIdUser();
		$query="INSERT INTO caixadiarios SET abertura='{$date}', data='{$dataAtual}', usuario={$usuario}, isfechado=0";
		if(mysqli_query($connection, $query))
		{
			$response=array(
				'status' => 1,
				'message' =>'Caixa Diário aberto com sucesso.'
			);
		}
		else
		{
			$response=array(
				'status' => 0,
				'message' =>'Houve um erro ao abrir o caixa diário.'
			);
			header("HTTP/2.0 400 Bad Request");
		}
		header('Content-Type: application/json');
		echo json_encode($response);
	}
	function retrieve($id=0)
	{
		global $connection;
		$query="SELECT * FROM caixadiarios";
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
	function delete($id)
	{
		global $connection;
		$query="DELETE FROM caixadiarios WHERE id=".$id;
		if(mysqli_query($connection, $query))
		{
			$response=array(
				'status' => 1,
				'message' =>'Deletado com sucesso.'
			);
		}
		else
		{
			$response=array(
				'status' => 0,
				'message' =>'Houve um erro ao deletar.'
			);
			header("HTTP/2.0 400 Bad Request");
		}
		header('Content-Type: application/json');
		echo json_encode($response);
	}
	function update()
	{
		global $connection;
		parse_str(file_get_contents("php://input"),$post_vars);
		$id=$post_vars['id'];
		$valortotal=$post_vars["valortotal"];
		$fechamento = date("Y-m-d H:i:s");
		$usuario = getIdUser();
		$query="UPDATE caixadiarios SET fechamento='{$fechamento}', valortotal='{$valortotal}', isfechado=1 WHERE id=$id AND usuario=$usuario";
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
			header("HTTP/2.0 400 Bad Request");
		}
		header('Content-Type: application/json');
		echo json_encode($response);
	}

	// Close database connection
	mysqli_close($connection);
