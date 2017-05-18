<?php 

	function insert()
	{
		global $connection;
		$nome=$_POST["nome"];
		$usuario=$_POST["usuario"];
		$senha=$_POST["senha"];
		$status=$_POST["status"];
		$admin=$_POST["admin"];
		$query="INSERT INTO usuarios SET nome='{$nome}', usuario='{$usuario}', senha='{$senha}', status='{$status}', admin='{$admin}'";
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
	function login(){
		global $connection;
		//global $connection;
		$usuario=$_POST["usuario"];
		$senha=$_POST["senha"];
		$query="SELECT id, nome, usuario, status, admin FROM usuarios";
		if($usuario != null && $senha != null)
		{
			$query.=" WHERE usuario='".$usuario."' AND senha ='".$senha."' AND status = 1 LIMIT 1";
		}

		$response=array();
		$result=mysqli_query($connection, $query);
		while($row=mysqli_fetch_object($result))
		{
			$response[]=$row;
		}

		echo gerarToken($response[0]->id,$response[0]->admin);
	}
	function retreave($id=0)
	{
		global $connection;
		//global $connection;
		$query="SELECT * FROM usuarios";
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
		$query="DELETE FROM usuarios WHERE id=".$id;
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
	function update($id)
	{
		global $connection;
		parse_str(file_get_contents("php://input"),$post_vars);
		$nome=$_POST["nome"];
		$usuario=$_POST["usuario"];
		$senha=$_POST["senha"];
		$status=$_POST["status"];
		$admin=$_POST["admin"];
		$query="INSERT INTO usuarios SET nome='{$nome}', usuario='{$usuario}', senha='{$senha}', status={$status}, admin={$admin} WHERE id=".$id;
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
	
