<?php

	# Responsável por retornar a imagem do médico logado
	require_once("conexao.php");
	
	$id_medico = $_GET['id_medico'];
	$q = "select imagem_perfil from medico where codigo = $id_medico";
	$resultado = mysqli_query($conexao, $q);
	
	if($resultado) {
		
		$imagem = mysqli_fetch_object($resultado);
	
		header("Content-type: image/gif");

		echo $imagem->imagem_perfil; 
		
	} else {
		
		printf("Erro: %s \n", mysqli_error($conexao));
		
	}

?>