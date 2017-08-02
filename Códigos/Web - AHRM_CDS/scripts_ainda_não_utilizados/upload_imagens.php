<?php

	require_once("conexao.php"); 

	$imagem = $_FILES['imagem']['tmp_name'];
	$tamanho = $_FILES['imagem']['size'];
	$tipo = $_FILES['imagem']['type'];
	$nome = $_FILES['imagem']['name'];

	if($imagem != null) {

		$arquivo = fopen($imagem, "rb");
		$conteudo = fread($arquivo, $tamanho);
		$conteudo = addslashes($conteudo);
		fclose($arquivo);

		$query = "insert into imagens_ondas_pacientes (nome_imagem, tamanho_imagem, tipo_imagem, imagem_onda) VALUES ('$nome', '$tamanho', '$tipo', '$conteudo')";
		mysqli_query($conexao, $query) or die("Erro ao inserir os dados");

		echo "Inserido com sucesso.";

		# header('Location: index.php');

		if(mysqli_affected_rows($conexao) > 0) {

			print "A imagem foi salva no banco de dados.";

		} /*else {

			print "Nao foi possivel salvar a imagem."

		}
		*/

	}else {

		echo "Nao foi possível carregar a imagem. Erro: " . mysqli_error() . PHP_EOL;

	}

?>