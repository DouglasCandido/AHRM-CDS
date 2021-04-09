<?php

	# Responsável por retornar o PDF enviado
	require_once("conexao.php");
	
	$id_medico = $_GET['id_medico'];
	
	$q = "select * from laudo where codigo_medico = $id_medico";
	$resultado = mysqli_query($conexao, $q);
	
	if($resultado) {
		
		$arquivo_pdf = mysqli_fetch_object($resultado);
	
		header("Content-type: application/pdf");

		echo $arquivo_pdf->pdf; 

		exit();
		
	} else {
		
		printf("Erro: %s \n", mysqli_error($conexao));
		
	}

?>

