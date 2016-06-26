<?php
	$nome = $_POST["nome"];

	$conn = new mysqli("localhost", "root", "", "sgrh");
	$sql = "SELECT idCadastro FROM tbCadastro WHERE nomeCadastro = nome";
	$result = $conn->query($sql);

	$result_json = array();

	while ($row = $result->fetch_assoc()) {
		$result_json[] = $row;
	}

	echo json_encode($result_json);

	$conn->close();

?>