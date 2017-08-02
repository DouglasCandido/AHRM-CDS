<?php 

	require_once("../conexao.php");
	require("../integridadepaciente.php");

    $codigo_paciente = $_SESSION['codigo_paciente'];

	$verificador = "select * from paciente where codigo = $codigo_paciente";
	$resultado = mysqli_query($conexao, $verificador) or die(mysqli_error($conexao));
	$retorno = mysqli_fetch_array($resultado);

	# O paciente só pode enviar exame se já possui um vínculo com um médico
	if($retorno['medico_paciente'] <= 0) {

		echo "<script> alert('Você não está vinculado a um médico. Para poder enviar um exame você precisa estar vinculado a um médico.'); window.location = '../procurarmedico.php'; </script>";

	}

	$codigo_medico = $retorno['medico_paciente'];

	# Pega os dados submetidos pelo form
    $data_exame = $_POST['cadDataExame'];
    $time = strtotime($data_exame);
    $data_exame = date('Y-m-d', $time);
    $tipo_exame = $_POST['cadTipoExame'];
    $descricao_exame = $_POST['cadDescricaoExame'];

    # Dados referentes ao arquivo PDF
    $pdf = $_FILES['cadExame']['tmp_name'];
    $tamanho = $_FILES['cadExame']['size'];
    $tipo = $_FILES['cadExame']['type'];
    $nome_pdf = $_FILES['cadExame']['name'];

    # Insere na tabela
    if($pdf != null) {

        $arquivo = fopen($pdf, "rb");
        $conteudo = fread($arquivo, $tamanho);
        $conteudo = addslashes($conteudo);
        fclose($arquivo);

        $q = "insert into exame(codigo_paciente, codigo_medico, data_do_exame, tipo_exame, descricao_exame, nome_pdf, tamanho_pdf, tipo_pdf, pdf) values($codigo_paciente, $codigo_medico, '$data_exame', '$tipo_exame', '$descricao_exame', '$nome_pdf', '$tamanho', '$tipo', '$conteudo');";

        $resultado = mysqli_query($conexao, $q);

        if($resultado) {

            header("Location: ../examesenviados.php");

        } else {

            echo "Não foi possível realizar o envio. Erro: " . mysqli_error($conexao);

            exit;

        }
        
    }

?>