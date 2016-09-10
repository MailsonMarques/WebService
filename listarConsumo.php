<?php

require_once 'DB.php';



	$sql = "SELECT SUM(consumoCubico) as soma FROM tbconsumo WHERE tbEndereco_idEndereco = ? and MONTH(dataLeituraSensor) = MONTH(NOW())";
	$stmt = DB::prepare($sql);
	$stmt->bindParam(1, $_GET["idEnd"], PDO::PARAM_INT);
	$stmt->execute();
	$sel_row = $stmt->fetch(PDO::FETCH_ASSOC);
	$volume_consumido = (double) $sel_row['soma'];

	$volume_cubico_consumido = $volume_consumido * 0.001;

	$sql = "SELECT 
				cast(sum(
					if (idfaixa = 1, valor_agua, 
						if ($volume_cubico_consumido>faixa_final, ((faixa_final-faixa_inicial+1)*valor_agua), (($volume_cubico_consumido-faixa_inicial+1)*valor_agua))
					)
				) as decimal(10,2)) as valor_total_agua,
				cast(sum(
					if (idfaixa = 1, valor_esgoto,
						if ($volume_cubico_consumido>faixa_final, ((faixa_final-faixa_inicial+1)*valor_esgoto), (($volume_cubico_consumido-faixa_inicial+1)*valor_esgoto))
					) 
				) as decimal(10,2)) as valor_total_esgoto 
				FROM tbfaixaaguaesgoto

				where faixa_inicial <= $volume_cubico_consumido";

				
	$stmt = DB::prepare($sql);
	$stmt->execute();

	$sel_row = $stmt->fetch(PDO::FETCH_ASSOC);
	$total_agua = (double) $sel_row['valor_total_agua'];
	$total_esgoto = (double) $sel_row['valor_total_esgoto'];

	$obj = array("consumo" => $volume_cubico_consumido, "agua" => $total_agua, "esgoto" => $total_esgoto);

	echo json_encode($obj);
	

?>