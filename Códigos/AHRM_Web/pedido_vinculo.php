<?php

	require_once("conexao.php");

	# Responsável por solicitar um pedido de vínculo entre o paciente logado e o médico pesquisado
	session_start();

	$codigo_medico = addslashes(trim($_GET['codigo_medico']));
	$codigo_paciente = $_SESSION['codigo_paciente'];

	$verificador1 = "select * from paciente where codigo = $codigo_paciente";
	$resultado1 = mysqli_query($conexao, $verificador1) or die(mysqli_error($conexao));
	$retorno1 = mysqli_fetch_array($resultado1);

	if($retorno1['medico_paciente'] > 0) {

		echo "<script> alert('Você já está vinculado a um médico.'); window.location = 'procurarmedico.php'; </script>";

	} else {

		$verificador2 = "select * from pedido_vinculo where codigo_paciente = $codigo_paciente";
		$resultado2 = mysqli_query($conexao, $verificador2) or die(mysqli_error($conexao));
		$retorno2 = mysqli_num_rows($resultado2);

		if($retorno2 > 0) {

			echo "<script> alert('O seu pedido de vínculo já foi enviado para um médico. Status: Aguardando a resposta de aceitação ou declínio.'); window.location = 'procurarmedico.php'; </script>";

		} else {

				$pedido_vinculo = "insert into pedido_vinculo(codigo_medico, codigo_paciente) values($codigo_medico, $codigo_paciente);";
				$resultado3 = mysqli_query($conexao, $pedido_vinculo) or die(mysqli_error($conexao));

				echo "<script> alert('O seu pedido de vínculo foi enviado para esse médico. Espere a resposta de aceitação ou declínio.'); window.location = 'indexpaciente.php'; </script>";

		}

	}

?>