<?php 

    require_once("conexao.php");

    require("integridademedico.php");

    # É ativado quando o médico decide excluir um paciente

    $codigo_paciente = $_GET['codigo_paciente'];

    $q1 = "delete from vinculo where codigo_medico=" . $_SESSION['codigo_medico'] . " and codigo_paciente=" . $codigo_paciente;

    $resultado1 = mysqli_query($conexao, $q1) or die(mysqli_error($conexao)); 

    if($resultado1) {

        $q2 = "update paciente set medico_paciente = NULL where codigo=" . $codigo_paciente;

        $resultado2 = mysqli_query($conexao, $q2) or die(mysqli_error($conexao)); 

        if($resultado2) {

            echo "<script> alert('O paciente foi excluido com sucesso.'); window.location='meuspacientes.php'; </script>";
    
        }

    }

?> 
