<?php
	$endereco = $_POST["enderecoCadastro"];
	$endNumero = $_POST["enderecoNumero"];
	$endBairro = $_POST["enderecoBairro"];
	$endCidade = $_POST["enderecoCidade"];
	$endTipo = $_POST["enderecoTipo"];

	$mysqli = new mysqli('localhost', 'root', '', 'sgrh');

	/* check connection */
	if (mysqli_connect_errno()) {
	    printf("Connect failed: %s\n", mysqli_connect_error());
	    exit();
	}

	$sql = "SELECT * FROM tbcadastro WHERE idCadastro = (SELECT max(idCadastro) FROM tbcadastro)";
	$sel = $mysqli->query($sql);
	$sel_row = $sel->fetch_object();
	$id = (int) $sel_row->idCadastro;

	$stmt = $mysqli->prepare("INSERT INTO tbendereco(enderecoCadastro, enderecoNumero, enderecoBairro, tbCadastro_idCadastro, enderecoTipo, enderecoCidade) VALUES (?,?,?,?,?,?)");
	$stmt->bind_param("sssiss", $endereco, $endNumero, $endBairro, $id, $endTipo, $endCidade);
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