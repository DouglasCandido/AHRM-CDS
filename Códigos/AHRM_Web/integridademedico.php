<?php

	require_once("conexao.php");

	# Verifica se o médico está logado
    session_start();

    if(!isset($_SESSION["codigo_medico"]) and empty($_SESSION["codigo_medico"]) || !isset($_SESSION["nome_medico"]) and empty($_SESSION["nome_medico"])) {

        header("Location: index.php");

    }

?>