<?php
	# Exibe a imagem do paciente pesquisado
	require_once("conexao.php");
	$id_paciente = $dados['codigo'];
	$q = "select * from paciente where codigo =$id_paciente";
	$resultado = mysqli_query($conexao, $q);
	if($resultado) {
		$imagem = mysqli_fetch_array($resultado);
		echo '<img height="300" width="300" src="data:image/jpeg;base64,'.base64_encode( $imagem['imagem_perfil'] ).'"/>';
	} else {
		printf("Erro: %s \n", mysqli_error($conexao));
	}
?>




