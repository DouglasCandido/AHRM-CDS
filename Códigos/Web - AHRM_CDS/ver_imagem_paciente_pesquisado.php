<?php

	require_once("conexao.php");
	
	# Exibe a imagem do paciente pesquisado
	$id_paciente = $_GET['id_paciente'];
	$q = "select imagem_perfil from paciente where codigo = $id_paciente";
	$resultado = mysqli_query($conexao, $q);
	
	if($resultado) {
		
		$imagem = mysqli_fetch_object($resultado);
	
		header("Content-type: image/gif");

		echo $imagem->imagem_perfil; 
		
	} else {
		
		printf("Erro: %s \n", mysqli_error($conexao));
		
	}

?>