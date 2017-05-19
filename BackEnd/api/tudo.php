<?php

	// Connect to database
	$connection=mysqli_connect('localhost','root','root','controleacesso');

	$request_method=$_SERVER["REQUEST_METHOD"];

	switch($request_method)
	{
		case 'GET':
			// Retrive Products
			if(!empty($_GET["id"]))
			{
				$id=intval($_GET["id"]);
				retrieve($id);
			}
			else
			{
				retrieve();
			}
			break;
		case 'POST':
			// Insert Product
			insert();
			break;
		case 'PUT':
			// Update Product
			$id=intval($_GET["id"]);
			update($id);
			break;
		case 'DELETE':
			// Delete Product
			$id=intval($_GET["id"]);
			delete($id);
			break;
		default:
			// Invalid Request Method
			header("HTTP/2.0 405 Method Not Allowed");
			break;
	}


	// CLASSES DAO



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
	function retrieve($id=0)
	{
		global $connection;
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

?>
