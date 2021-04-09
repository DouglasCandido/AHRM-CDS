<?php

	# Responsável por retornar o PDF enviado
	require_once("conexao.php");
	
	$id_paciente = $_GET['id_paciente'];
	
	$q = "select * from exame where codigo_paciente = $id_paciente";
	$resultado = mysqli_query($conexao, $q);
	
	if($resultado) {
		
		$arquivo_pdf = mysqli_fetch_object($resultado);
	
		header("Content-type: application/pdf");

		echo $arquivo_pdf->pdf; 
		
	} else {
		
		printf("Erro: %s \n", mysqli_error($conexao));
		
	}

?>

