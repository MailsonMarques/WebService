<?php
	$nome = $_POST["nome"];
	$cpf = $_POST["cpf"];
	$email = $_POST["emailCadastro"];
	$senha = $_POST["senhaCadastro"];

	$mysqli = new mysqli('localhost', 'root', '', 'sgrh');

	/* check connection */
	if (mysqli_connect_errno()) {
	    printf("Connect failed: %s\n", mysqli_connect_error());
	    exit();
	}

	$stmt = $mysqli->prepare("INSERT INTO tbcadastro(nomeCadastro, cpfCadastro, emailCadastro, senhaCadastro) VALUES (?,?,?,?)");
	$stmt->bind_param("ssss", $nome, $cpf, $email, $senha);
	$stmt->execute();

	$resultado = $stmt;

	if($resultado)
		$retorno = array("retorno" => "YES");
	else 
		$retorno = array("retorno" => "NO");
	
	echo json_encode($retorno);

	$stmt->close();
	$mysqli->close();

?>