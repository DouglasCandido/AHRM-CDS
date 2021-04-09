<?php

  require_once("conexao.php");

  # Responsável por encerrar qualquer sessão
  session_start();


  # Responsável por encerrar os cookies
  if(isset($_COOKIE['loginP']) and isset($_COOKIE['senhaP'])) {

  	unset($_COOKIE['loginP']);
    unset($_COOKIE['senhaP']);
    setcookie('loginP', null, -1, '/');
    setcookie('senhaP', null, -1, '/');

    return true;

  }

  # Responsável por encerrar os cookies
  if(isset($_COOKIE['loginM']) and isset($_COOKIE['senhaM'])) {

    unset($_COOKIE['loginM']);
    unset($_COOKIE['senhaM']);
    setcookie('loginM', null, -1, '/');
    setcookie('senhaM', null, -1, '/');

    return true;

  }


  session_destroy();

  header("Location: index.php");

  exit();
  
?>

