<?php
	# Responsável por retornar a imagem do médico logado
	require_once("conexao.php");
	$id_medico = $_SESSION['codigo_medico'];
	$q = "select * from medico where codigo =$id_medico";
	$resultado = mysqli_query($conexao, $q);
	if($resultado) {
		$imagem = mysqli_fetch_array($resultado);
		echo '<img height="50rem" width="50rem" src="data:image/jpeg;base64,'.base64_encode( $imagem['imagem_perfil'] ).'"/>';
	} else {
		printf("Erro: %s \n", mysqli_error($conexao));
	}
?>

