<?php

require_once 'DB.php';

	$sql = "SELECT COUNT(*) as TOTAL FROM tbCadastro WHERE emailCadastro = ? and senhaCadastro = ?";
	$stmt = DB::prepare($sql);
	$stmt->bindParam(1, $_POST['email'], PDO::PARAM_STR);
	$stmt->bindParam(2, $_POST['senha'], PDO::PARAM_STR);
	$stmt->execute();
	$sel_row = $stmt->fetch(PDO::FETCH_ASSOC);
	$obj = (int) $sel_row['TOTAL'];


	$sql = "SELECT idCadastro FROM tbCadastro WHERE emailCadastro = ? and senhaCadastro = ?";
	$stmt = DB::prepare($sql);
	$stmt->bindParam(1, $_POST['email'], PDO::PARAM_STR);
	$stmt->bindParam(2, $_POST['senha'], PDO::PARAM_STR);
	$stmt->execute();
	

	$result_json = array();

	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		$result_json[] = $row;

	}

	if($obj == 1){
		$retorno = array("retorno" => "YES" ) + $result_json[0];
		echo json_encode($retorno);
	}else{ 
		$retorno = array("retorno" => "NO");
		echo json_encode($retorno);
	}


?>