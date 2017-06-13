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
			$nome=$post_vars['nome'];
			$cpf=$post_vars["cpf"];
			$telefone=$post_vars["telefone"];
			$query="UPDATE clientes SET nome='{$nome}', cpf='{$cpf}', telefone='{$telefone}' WHERE id=".$id;
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
