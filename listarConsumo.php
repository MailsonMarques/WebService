<?php

require_once 'DB.php';



	$sql = "SELECT SUM(consumoCubico) as soma FROM tbconsumo WHERE tbEndereco_idEndereco = ? and MONTH(dataLeituraSensor) = MONTH(NOW())";
	$stmt = DB::prepare($sql);
	$stmt->bindParam(1, $_GET["idEnd"], PDO::PARAM_INT);
	$stmt->execute();
	
	$result_json = array();

	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		$result_json[] = $row;

	}
	

	echo json_encode($result_json);
	

?>