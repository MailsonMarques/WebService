<?php

require_once 'DB.php';

	$sql = "DELETE FROM tbendereco WHERE idEndereco = ?";
	$stmt = DB::prepare($sql);
	$stmt->bindParam(1, $_POST["codigo"], PDO::PARAM_INT);

	if($stmt->execute())
		$retorno = array("retorno" => "YES");
	 else 
		$retorno = array("retorno" => "NO");
	
	echo json_encode($retorno);
?>