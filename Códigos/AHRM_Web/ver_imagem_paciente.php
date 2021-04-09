<?php
	# Responsável por retornar a imagem do paciente logado
	require_once("conexao.php");
	$id_paciente = $_SESSION['codigo_paciente'];
	$q = "select * from paciente where codigo =$id_paciente";
	$resultado = mysqli_query($conexao, $q);
	if($resultado) {
		$imagem = mysqli_fetch_array($resultado);
		echo '<img height="50rem" width="50rem" src="data:image/jpeg;base64,'.base64_encode( $imagem['imagem_perfil'] ).'"/>';
	} else {
		echo(mysqli_error($conexao));
	}
?>



