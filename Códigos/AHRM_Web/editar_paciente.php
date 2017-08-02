<?php 

    require_once("conexao.php");

    require("integridadepaciente.php");

    # É ativado quando o paciente decide editar seu perfil

    $codigo_paciente = $_GET['codigo_paciente'];

    # Dados que serão editados
    $nome_paciente = $_POST['editNome'];
    $data_de_nascimento_paciente = $_POST['editData'];
    $cpf_paciente = $_POST['editCPF'];
    $senha_paciente = $_POST['editSenha'];
    $email_paciente = $_POST['editEmail'];
    $telefone_paciente = $_POST['editTelefone'];
    $uf_paciente = $_POST['editUF'];
    $cidade_paciente = $_POST['editCidade'];
    $bairro_paciente = $_POST['editBairro'];
    $rua_paciente = $_POST['editRua'];
    $numero_paciente = $_POST['editNumero'];

    $q = "update paciente set nome_paciente='$nome_paciente', cpf_paciente='$cpf_paciente', email_paciente='$email_paciente', telefone='$telefone_paciente', senha='$senha_paciente', uf='$uf_paciente', cidade='$cidade_paciente', bairro='$bairro_paciente', rua='$rua_paciente', numero='$numero_paciente', data_de_nascimento='$data_de_nascimento_paciente' where codigo =" . $codigo_paciente;

    $resultado = mysqli_query($conexao, $q) or die(mysqli_error($conexao)); 

    if($resultado) {

        $_SESSION['nome_paciente'] = $nome_paciente;
        $_SESSION['cpf_paciente'] = $cpf_paciente;

        echo "<script> alert('O perfil foi editado com sucesso!'); window.location='perfil_paciente.php'; </script>";

    }

?> 
