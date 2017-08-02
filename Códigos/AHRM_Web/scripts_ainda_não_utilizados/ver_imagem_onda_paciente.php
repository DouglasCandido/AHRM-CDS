<?php

	require_once("conexao.php");
	
	$id_imagem = $_GET['codigo'];
	$query = "select codigo, imagem_onda from imagens_ondas_pacientes where codigo = $id_imagem";
	$resultado = mysqli_query($conexao, $query);
	
	if($resultado) {
		
		
	} else {
		
		printf("Erro: %s \n", mysqli_error($conexao));
		
	}
	
	$imagem = mysqli_fetch_object($resultado);
	
	header("content-type: image/gif");
	
	echo $imagem->imagem_onda;

?>