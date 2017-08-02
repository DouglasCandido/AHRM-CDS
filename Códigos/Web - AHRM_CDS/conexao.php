<?php

	# Conexão com o banco de dados
	$conexao = mysqli_connect("localhost", "root", "", "bd_tcc");
	
	if(!$conexao) {
		
		echo "Erro: Nao foi possivel se conectar ao banco de dados."  . PHP_EOL;
		echo "Erro: " . mysqli_connect_error() . PHP_EOL;
		echo "Erro: " . mysqli_connect_errno() . PHP_EOL;
		
	}else {
		
		mysqli_set_charset($conexao,"utf8");
		
	}

?>