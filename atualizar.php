<?php

require_once 'DB.php';


	$sql = "UPDATE tbendereco SET enderecoCadastro = ?, enderecoNumero = ?, enderecoBairro = ?, enderecoTipo = ?, enderecoCidade = ? WHERE idEndereco = ?";
	$stmt = DB::prepare($sql);
	$stmt->bindParam(1, $_POST["endCad"], PDO::PARAM_STR);
	$stmt->bindParam(2, $_POST["endNum"], PDO::PARAM_STR);
	$stmt->bindParam(3, $_POST["endBai"], PDO::PARAM_STR);
	$stmt->bindParam(4, $_POST["endTip"], PDO::PARAM_STR);
	$stmt->bindParam(5, $_POST["endCid"], PDO::PARAM_STR);
	$stmt->bindParam(6, $_POST["codigo"], PDO::PARAM_INT);

	if($stmt->execute())
		$retorno = array("retorno" => "YES");
	 else 
		$retorno = array("retorno" => "NO");
	
	echo json_encode($retorno);


?>