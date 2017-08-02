<?php 

    require_once("conexao.php");

    require("integridadepaciente.php");

    # É ativado quando o paciente decide excluir o médico
    $codigo_medico = $_GET['codigo_medico'];

    $q1 = "delete from vinculo where codigo_paciente=" . $_SESSION['codigo_paciente'] . " and codigo_medico=" . $codigo_medico;

    $resultado1 = mysqli_query($conexao, $q1) or die(mysqli_error($conexao)); 

    if($resultado1) {

        $q2 = "update paciente set medico_paciente = NULL where codigo=" . $_SESSION['codigo_paciente'];

        $resultado2 = mysqli_query($conexao, $q2) or die(mysqli_error($conexao)); 

        if($resultado2) {

            echo "<script> alert('O médico foi excluido com sucesso.'); window.location='meumedico.php'; </script>";
    
        }

    }

?> 
