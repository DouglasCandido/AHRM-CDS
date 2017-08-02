<?php

	require_once("conexao.php");
	
	# Verifica se o paciente está logado
	session_start();

    if(!isset($_SESSION["cpf_paciente"]) and empty($_SESSION["cpf_paciente"]) || !isset($_SESSION["senha_paciente"]) and empty($_SESSION["senha_paciente"])) {

        header("Location: loginpaciente.php");

    }

?>