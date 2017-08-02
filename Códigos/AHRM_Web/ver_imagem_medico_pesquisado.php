<?php

	require_once("conexao.php");
	
	# Exibe a imagem do médico pesquisado
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