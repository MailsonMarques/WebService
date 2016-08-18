<?php

require_once 'DB.php';


	$sql = "UPDATE clientes SET nome = ?, email = ? WHERE id = ?";
	$stm = $conn->prepare($sql);
	$stm->bind_param("ssi", $nome, $email, $codigo);
	
	$resultado = $stm->execute();

	if($resultado)
		$retorno = array("retorno" => "YES");
	 else 
		$retorno = array("retorno" => "NO");
	
	echo json_encode($retorno);


?>