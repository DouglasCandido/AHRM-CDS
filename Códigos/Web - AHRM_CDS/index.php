<?php 

    require_once("conexao.php");

    # Verifica se há cookies setados, se houver redirecionará para o index do paciente ou o index do médico
    if(isset($_COOKIE["loginP"]) and !empty($_COOKIE["loginP"]) || isset($_COOKIE["senhaP"]) and !empty($_COOKIE["senhaP"])) {

        header("Location: indexpaciente.php");

    } 

    if(isset($_COOKIE["loginM"]) and !empty($_COKIE["loginM"]) || isset($_COOKIE["senhaM"]) and !empty($_COOKIE["senhaM"])) {

        header("Location: indexmedico.php"); 

    } 

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="icon" href="favicon.png" type="image/x-icon"/>
    
    <title>AHRM CDS - O que você é?</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">

    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css">

    <link href="http://fonts.googleapis.com/css?family=Josefin+Slab:100,300,400,600,700,100italic,300italic,400italic,600italic,700italic" rel="stylesheet" type="text/css">

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

</head>

<?php
    
    echo"<body>";
        echo "<div class='brand'> AHRM CDS </div>";
        echo "<div id='wrapper'>
                <nav class='navbar navbar-inverse navbar-fixed-top' role='navigation' id='cor' style='background-color: #cc0000;'>
                    <div class='navbar-header'>
                        <button type='button' class='navbar-toggle' data-toggle='collapse' data-target='.navbar-ex1-collapse'>
                            <span class='sr-only'>Toggle navigation</span>
                            <span class='icon-bar'></span>
                            <span class='icon-bar'></span>
                        </button>
                        <a class='navbar-brand' href='sobre.html' style='color: #fff; font-size: 16pt'>Sobre</a>
                        <a class='navbar-brand' href='contato.html' style='color: #fff; font-size: 16pt'>Contato</a>
                    </div>
                </nav> 
            <div id='page-wrapper'>
                <div class='container-fluid'>
                    <div class='row'>
                        <div class='col-lg-12' style='color: black;'>"; 
                            echo "<div class='col-lg-6' style='float: left; right: 150px;'>
                                <h2 style='padding: 90px 0px 24px; line-height: 36px; text-align: justify;'>
                                    Realize consultas online e receba laudos à distância de médicos.
                                </h2>";
                                echo "<div class='row'>
                                    <div style='display: inline'>
                                        <img src='img/img-exame.png' height='100px' width='100px' style='vertical-align:middle; float: left;'>
                                        <br /> <br />
                                        <span class='span_info'> Faça exames, em qualquer local, através de um sistema online, prático e preciso. </span>
                                    </div>
                                </div>
                                <br />";
                                echo "<div class='row'>
                                    <div style='display: inline'>
                                        <img src='img/img-laudo.png' height='100px' width='100px' style='vertical-align:middle; float: left;'>
                                        <br />
                                        <span class='span_info'> Envie o seu exame para um médico te diagnosticar e emitir um laudo, tudo com poucos cliques. </span>
                                    </div>
                                </div>
                                <br />"; 
                                echo "<div class='row'>
                                    <div style='display: inline'>
                                        <img src='img/img-consulta.png' height='100px' width='100px' style='vertical-align:middle; float: left;'>
                                        <br /> <br />
                                        <span class='span_info'> Consulte todos os seus laudos em qualquer lugar e qualquer computador. </span>
                                    </div>
                                </div>
                                <br /> <br />";
                                echo "<div class='row'>
                                    <div>
                                        <span style='position: absolute; left: 85%; text-align: justify; color: black;'> <h2> Funcionamento </h2> </span>
                                        <br /> <br /> <br /> <br />
                                        <img src='img/img-funcionamento.png' style='vertical-align:middle; position: absolute; left: 48%;'>
                                    </div>
                                </div>
                            </div>";  
                            echo "<div class='col-lg-6' style='float: right;'>
                                <h1 class='page-header' style='text-align: center; color: black;'>
                                    O que você é?
                                </h1>
                                <ol class='breadcrumb'>
                                    <li>
                                        <a href='loginpaciente.php' style='font-size: 14pt;'><i class='fa fa-user' style='font-size: 50px; color: #00008B;'></i> Paciente </a>
                                    </li>
                                </ol>
                                <ol class='breadcrumb'>
                                    <li>
                                        <a href='loginmedico.php' style='font-size: 14pt;'><i class='fa fa-user-md' style='font-size: 50px; color: #00008B;'></i> Médico </a>
                                    </li>
                                </ol>
                            </div>";
                        echo"
                        </div>
                    </div>
                </div>";
                echo"
            </div>
        </div>";

        echo "<footer style='position: absolute; top: 1450px; background-color: #CCC;'>
            <div class='container'>
                <div class='row'>
                    <div class='col-lg-12 text-center'>
                        <p>
                            Copyright &copy; 2016 AHRM CDS Sistema de telemedicina de baixo custo - Todos os direitos reservados

                            <br />

                            Instituto Federal de Educação, Ciência e Tecnologia do Rio Grande do Norte

                            <br />

                            RN 288, s/n, Nova Caicó | Caicó, RN | CEP: 59300-000
                        </p>
                    </div>
                </div>
            </div>
        </footer>";

    echo "</body>";

    echo "<script src='js/bootstrap.min.js'></script>";

?>

