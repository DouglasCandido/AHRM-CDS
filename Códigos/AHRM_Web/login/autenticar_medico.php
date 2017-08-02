<?php 

	require_once("../conexao.php");

	# Pega os dados informados submetidos pelo form do login
	$domain = ($_SERVER['HTTP_HOST'] != 'localhost') ? $_SERVER['HTTP_HOST'] : false;
	$login = isset($_POST['fLogin']) ? addslashes(trim($_POST['fLogin'])) : FALSE; 
	$senha = isset($_POST['fSenha']) ? addslashes(trim($_POST['fSenha'])) : FALSE;

	# Se o botão lembrar de mim estiver marcado irá criar cookies
	if(isset($_POST['manter']) and !empty($_POST['manter'])) {

		$manterconectado = $_POST['manter'];

		if($manterconectado == 's') {

			setcookie('loginM', $login, false, '/', $domain, false);
			setcookie('senhaM', $senha, false, '/', $domain, false);

		}
	
	}

	session_start();

	# Se os dados não forem preenchidos
	if(!$login || !$senha) {
		
		echo "Você deve digitar seu login e senha.";

	} else {
		
		# Autentica o usuário e cria a sessão
		$q = "select * from medico where cpf_medico = '$login'";

		$resultado = mysqli_query($conexao, $q) or die(mysqli_error($conexao)); 
		$total = mysqli_num_rows($resultado);

		if($total) {

			$dados = mysqli_fetch_array($resultado);

			if (!strcmp($senha, $dados['senha'])) {

				$_SESSION['codigo_medico'] = $dados['codigo'];
				$_SESSION['nome_medico'] = $dados['nome_medico'];
				$_SESSION['cpf_medico'] = $dados['cpf_medico'];

				header("Location: ../indexmedico.php");

			} else {

				echo "<script> alert('A senha informada não é válida.'); window.location = '../loginmedico.php'; </script>";

			}

		} else {

			echo "<script> alert('O usuário informado não existe.'); window.location = '../loginmedico.php'; </script>";

		}

	}

?>