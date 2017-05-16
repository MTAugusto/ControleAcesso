<?php 
	
	function insert()
	{
		global $connection;
		$nome=$_POST["nome"];
		$cpf=$_POST["cpf"];
		$telefone=$_POST["telefone"];
		$query="INSERT INTO clientes SET nome='{$nome}', cpf='{$cpf}', telefone='{$telefone}'";
		if(mysqli_query($connection, $query))
		{
			$response=array(
				'status' => 1,
				'status_message' =>'Product Added Successfully.'
			);
		}
		else
		{
			$response=array(
				'status' => 0,
				'status_message' =>'Product Addition Failed.'
			);
		}
		header('Content-Type: application/json');
		echo json_encode($response);
	}
	function retreave($id=0)
	{
		$connection=mysqli_connect('localhost','root','root','controleacesso');	
		//global $connection;
		$query="SELECT * FROM clientes";
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
		$query="DELETE FROM clientes WHERE id=".$id;
		if(mysqli_query($connection, $query))
		{
			$response=array(
				'status' => 1,
				'status_message' =>'Product Deleted Successfully.'
			);
		}
		else
		{
			$response=array(
				'status' => 0,
				'status_message' =>'Product Deletion Failed.'
			);
		}
		header('Content-Type: application/json');
		echo json_encode($response);
	}
	function update($id)
	{
		global $connection;
		parse_str(file_get_contents("php://input"),$post_vars);
		$nome=$post_vars["nome"];
		$cpf=$post_vars["cpf"];
		$telefone=$post_vars["telefone"];
		$query="UPDATE clientes SET nome='{$nome}', cpf={$cpf}, telefone={$telefone}' WHERE id=".$id;
		if(mysqli_query($connection, $query))
		{
			$response=array(
				'status' => 1,
				'status_message' =>'Product Updated Successfully.'
			);
		}
		else
		{
			$response=array(
				'status' => 0,
				'status_message' =>'Product Updation Failed.'
			);
		}
		header('Content-Type: application/json');
		echo json_encode($response);
	}

	// Close database connection
	mysqli_close($connection);
