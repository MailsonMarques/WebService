<?php
	$codigo = $_POST["codigo"];

	$conn = new mysqli("localhost", "root", "", "android");
	$sql = "DELETE FROM clientes WHERE id = ?";
	$stm = $conn->prepare($sql);
	$stm->bind_param("i", $codigo);
	
	$resultado = $stm->execute();

	if($resultado)
		$retorno = array("retorno" => "YES");
	 else 
		$retorno = array("retorno" => "NO");
	
	echo json_encode($retorno);

	$stm->close();
	$conn->close();
?>