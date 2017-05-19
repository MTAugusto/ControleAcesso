<?php

	function insert()
	{
		global $connection;
		$tipo=$_POST["tipo"];
		$placa=$_POST["placa"];
		$modelo=$_POST["modelo"];
		$cor=$_POST["cor"];
		$ismensal=$_POST["ismensal"];
		$query1="INSERT INTO veiculos SET tipo={$tipo}, placa='{$placa}', modelo='{$modelo}', cor='{$cor}', ismensal = {$ismensal}";
		$query2="SELECT * FROM veiculos WHERE placa='".$placa."' LIMIT 1";

		if($result = mysqli_query($connection, $query1))
		{

			$veiculo=array();
			$result2=mysqli_query($connection, $query);
			while($row=mysqli_fetch_object($result2))
			{
				$veiculo[]=$row;
			}
			$idTest = $veiculo[0]->id;

			var_dump($veiculo);

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
		}
		header('Content-Type: application/json');
		//echo json_encode($response);
	}
	function retrieve($id=0)
	{
		global $connection;
		$query="SELECT * FROM veiculos";
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
	function retrievePlaca($placa)
	{
		global $connection;
		$query="SELECT * FROM veiculos WHERE placa='".$placa."' LIMIT 1";

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
		$query="DELETE FROM veiculos WHERE id=".$id;
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
		}
		header('Content-Type: application/json');
		echo json_encode($response);
	}
	function update()
	{
		global $connection;
		parse_str(file_get_contents("php://input"),$post_vars);
		$id=$post_vars['id'];
		$tipo=$post_vars['tipo'];
		$placa=$post_vars["placa"];
		$modelo=$post_vars["modelo"];
		$cor=$post_vars["cor"];
		$ismensal=$post_vars["ismensal"];
		$query="UPDATE veiculos SET tipo={$tipo}, placa='{$placa}', modelo='{$modelo}', cor='{$cor}', ismensal = {$ismensal} WHERE id=".$id;
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
	}

	// Close database connection
	mysqli_close($connection);
