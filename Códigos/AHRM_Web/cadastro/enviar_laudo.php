<?php 

    require_once("../conexao.php");
    require("../integridademedico.php");

    $codigo_medico = $_SESSION['codigo_medico'];

    $verificador = "select * from medico where codigo =" . $codigo_medico;
    $resultado = mysqli_query($conexao, $verificador) or die(mysqli_error($conexao));
    $retorno = mysqli_fetch_array($resultado);

    $codigo_paciente = $_POST['cadPaciente'];

    $qpaciente = "select * from paciente where codigo=" . $codigo_paciente;
    $resultado_paciente = mysqli_query($conexao, $qpaciente) or die(mysqli_error($conexao));
    $retorno_paciente = mysqli_fetch_array($resultado_paciente);

    # O médico só pode enviar laudo se já possui um vínculo com um paciente
    if($retorno_paciente['medico_paciente'] <= 0) {

        echo "<script> alert('Você não está vinculado a um paciente. Para poder enviar um laudo você precisa estar vinculado a um paciente.'); window.location = '../meuspacientes.php'; </script>";

    }

    # $codigo_paciente = $retorno_paciente['codigo'];

    # Pega os dados submetidos pelo form
    $data_do_laudo = $_POST['cadDataLaudo'];
    $time = strtotime($data_laudo);
    $data_laudo = date('Y-m-d', $time);
    # $tipo_laudo = $_POST['cadTipoLaudo'];
    $descricao_laudo = $_POST['cadDescricaoLaudo'];

    # Dados referentes ao arquivo PDF
    $pdf = $_FILES['cadLaudo']['tmp_name'];
    $tamanho = $_FILES['cadLaudo']['size'];
    $tipo = $_FILES['cadLaudo']['type'];
    $nome_pdf = $_FILES['cadLaudo']['name'];

    # Insere na tabela
    if($pdf != null) {

        $arquivo = fopen($pdf, "rb");
        $conteudo = fread($arquivo, $tamanho);
        $conteudo = addslashes($conteudo);
        fclose($arquivo);

        $q = "insert into laudo(codigo_paciente, codigo_medico, data_do_laudo, descricao_laudo, nome_pdf, tamanho_pdf, tipo_pdf, pdf) values($codigo_paciente, $codigo_medico, '$data_do_laudo', '$descricao_laudo', '$nome_pdf', '$tamanho', '$tipo', '$conteudo');";

        $resultado = mysqli_query($conexao, $q);

        if($resultado) {

            header("Location: ../laudosenviados.php");

        } else {

            echo "Não foi possível realizar o envio. Erro: " . mysqli_error($conexao);

            exit;

        }
        
    }

?>


