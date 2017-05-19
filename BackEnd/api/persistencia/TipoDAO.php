<?php

	function insert()
	{
		global $connection;
		$nome=$_POST["nome"];
		$valorporhora=$_POST["valorporhora"];
		$valorpormes=$_POST["valorpormes"];
		$query="INSERT INTO tipos SET nome='{$nome}', valorporhora='{$valorporhora}', valorpormes='{$valorpormes}'";
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
		}
		header('Content-Type: application/json');
		echo json_encode($response);
	}
	function retrieve($id=0)
	{
		global $connection;
		$query="SELECT * FROM tipos";
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
		$query="DELETE FROM tipos WHERE id=".$id;
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
		$nome=$post_vars['nome'];
		$valorporhora=$post_vars["valorporhora"];
		$valorpormes=$post_vars["valorpormes"];
		$query="UPDATE tipos SET nome='{$nome}', valorporhora='{$valorporhora}', valorpormes='{$valorpormes}' WHERE id=".$id;
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
