<?php

	require_once("conexao.php");

	session_start();

	$codigo_medico = $_SESSION['codigo_medico'];
	$codigo_paciente = addslashes(trim($_GET['codigo_paciente']));

	$decisao = $_POST['btnDecisao'];

	$verificador1 = "select * from vinculo where codigo_medico = $codigo_medico and codigo_paciente = $codigo_paciente ";
	$resultado1 = mysqli_query($conexao, $verificador1) or die(mysqli_error($conexao));
	$retorno1 = mysqli_num_rows($resultado1);

	if($retorno1 > 0) {

		echo "<script> alert('Você já tem um vínculo com esse paciente.'); window.location = 'aceitar_novo_paciente.php'; </script>";

	} else {

		if($decisao == 's') {

			$aceitar_vinculo = "insert into vinculo(codigo_medico, codigo_paciente) values($codigo_medico, $codigo_paciente);";
			$resultado2 = mysqli_query($conexao, $aceitar_vinculo) or die(mysqli_error($conexao));
			$retorno2 = mysqli_affected_rows($conexao);

			if($retorno2 > 0) {

				$remover_pedido_vinculo = "delete from pedido_vinculo where codigo_medico = $codigo_medico and codigo_paciente = $codigo_paciente";
				$resultado3 = mysqli_query($conexao, $remover_pedido_vinculo) or die(mysqli_error($conexao));

				$atualizar_medico_paciente = "update paciente set medico_paciente = $codigo_medico where codigo = $codigo_paciente";
				$resultado3 = mysqli_query($conexao, $atualizar_medico_paciente) or die(mysqli_error($conexao));

				echo "<script> alert('Agora você tem um vínculo com esse paciente! Você pode trocar mensagens, receber exames para analisar e dar laudos.'); window.location = 'aceitar_novo_paciente.php'; </script>";

			} 
			else {

				echo("Falha ao executar a operação. Erro: " . mysqli_error($conexao));

			}

		} else {

			$remover_pedido_vinculo = "delete from pedido_vinculo where codigo_medico = $codigo_medico and codigo_paciente = $codigo_paciente";
			$resultado3 = mysqli_query($conexao, $remover_pedido_vinculo) or die(mysqli_error($conexao));

			echo "<script> alert('Você negou o pedido de vínculo desse paciente!'); window.location = 'aceitar_novo_paciente.php'; </script>";

		}

	}

?>