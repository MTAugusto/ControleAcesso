<?php

	function insert()
	{
		global $connection;
		$tipo=$_POST["tipo"];
		$placa=$_POST["placa"];
		$modelo=$_POST["modelo"];
		$cor=$_POST["cor"];
		$ismensal=$_POST["ismensal"];
		$cliente=$_POST["cliente"];
		$query1="INSERT INTO veiculos SET tipo={$tipo}, placa='{$placa}', modelo='{$modelo}', cor='{$cor}', ismensal = {$ismensal}";

		if($result = mysqli_query($connection, $query1))
		{

			//pegando o id do veiculo inserido pela placa - $veiculo[0]->id
			$query2="SELECT * FROM veiculos WHERE placa='".$placa."' LIMIT 1";
			$veiculo=array();
			$result2=mysqli_query($connection, $query2);
			while($row=mysqli_fetch_object($result2))
			{
				$veiculo[]=$row;
			}

			//associando o veiculo a um cliente
			$query3 = "INSERT INTO clientes_veiculos SET veiculo={$veiculo[0]->id}, cliente={$cliente}";
			if($result = mysqli_query($connection, $query3)){
				$response=array(
					'status' => 1,
					'message' =>'Adicionado com sucesso.'
				);
			}else{
					$response=array(
					'status' => 0,
					'message' =>'Houve um erro ao associar o veiculo ao cliente.'
				);
			}

			//verificando se é mensal e criando a mensalidade
			if ($ismensal) {
				$dataAtual = date('Y-m-d');
				$query4 = "INSERT INTO mensalidades SET veiculo={$veiculo[0]->id}, cliente={$cliente}, datavencimento='{$dataAtual}'";

				if($result = mysqli_query($connection, $query4)){
					$response=array(
						'status' => 1,
						'message' =>'Adicionado com sucesso.'
					);
				}else{
						$response=array(
						'status' => 0,
						'message' =>'Houve um erro ao criar a mensalidade.'
					);
				}
			}
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
