<?php 

    require_once("conexao.php");

    require("integridademedico.php");

    # É ativado quando o paciente decide editar seu perfil

    $codigo_medico = $_GET['codigo_medico'];

    # Dados que serão editados
    $nome_medico = $_POST['editNome'];
    $data_de_nascimento_medico = $_POST['editData'];
    $cpf_medico = $_POST['editCPF'];
    $senha_medico = $_POST['editSenha'];
    $crm_medico = $_POST['editCRM'];
    $email_medico = $_POST['editEmail'];
    $telefone_medico = $_POST['editTelefone'];
    $uf_medico = $_POST['editUF'];
    $cidade_medico = $_POST['editCidade'];
    $bairro_medico = $_POST['editBairro'];
    $rua_medico = $_POST['editRua'];
    $numero_medico = $_POST['editNumero'];

    $q = "update medico set nome_medico='$nome_medico', cpf_medico='$cpf_medico', crm='$crm_medico', email_medico='$email_medico', telefone='$telefone_medico', senha='$senha_medico', uf='$uf_medico', cidade='$cidade_medico', bairro='$bairro_medico', rua='$rua_medico', numero='$numero_medico', data_de_nascimento='$data_de_nascimento_medico' where codigo =" . $codigo_medico;

    $resultado = mysqli_query($conexao, $q) or die(mysqli_error($conexao)); 

    if($resultado) {

        $_SESSION['nome_medico'] = $nome_medico;
        $_SESSION['cpf_medico'] = $cpf_medico;

        echo "<script> alert('O perfil foi editado com sucesso!'); window.location='perfil_medico.php'; </script>";

    }

?> 

