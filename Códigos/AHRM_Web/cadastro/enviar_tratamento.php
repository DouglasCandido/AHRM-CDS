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

        echo "<script> alert('Você não está vinculado a um paciente. Para poder enviar um tratamento você precisa estar vinculado a um paciente.'); window.location = '../meuspacientes.php'; </script>";

    }

    # $codigo_paciente = $retorno_paciente['codigo'];

    # Pega os dados submetidos pelo form
    $data_do_tratamento = $_POST['cadDataTratamento'];
    $time = strtotime($data_tratamento);
    $data_tratamento = date('Y-m-d', $time);
    // $tipo_tratamento = $_POST['cadTipoTratamento'];
    $descricao_tratamento = $_POST['cadDescricaoTratamento'];

    # Dados referentes ao arquivo PDF
    $pdf = $_FILES['cadTratamento']['tmp_name'];
    $tamanho = $_FILES['cadTratamento']['size'];
    $tipo = $_FILES['cadTratamento']['type'];
    $nome_pdf = $_FILES['cadTratamento']['name'];

    # Insere na tabela
    if($pdf != null) {

        $arquivo = fopen($pdf, "rb");
        $conteudo = fread($arquivo, $tamanho);
        $conteudo = addslashes($conteudo);
        fclose($arquivo);

        $q = "insert into tratamento(codigo_paciente, codigo_medico, data_do_tratamento, descricao_tratamento, nome_pdf, tamanho_pdf, tipo_pdf, pdf) values($codigo_paciente, $codigo_medico, '$data_do_tratamento', '$descricao_tratamento', '$nome_pdf', '$tamanho', '$tipo', '$conteudo');";

        $resultado = mysqli_query($conexao, $q);

        if($resultado) {

            header("Location: ../tratamentosreceitados.php");

        } else {

            echo "Não foi possível realizar o envio. Erro: " . mysqli_error($conexao);

            exit;

        }
        
    }

?>


