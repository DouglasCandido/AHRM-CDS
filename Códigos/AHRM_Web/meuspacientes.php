<?php 

    require_once("conexao.php");
    
    require("integridademedico.php");
    
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">

	<link rel="icon" href="favicon.png" type="image/x-icon"/>
    
    <title>AHRM CDS - Meus pacientes</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    
	<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation" id="cor" style="background-color: #cc0000;">

            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class='navbar-brand' href='indexmedico.php' style='color: #fff; font-size: 16pt; position: absolute; top: 10px;'>AHRM CDS</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                <li class="dropdown">
                    
                    <a href="" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell" style="font-size: 20px; padding: 0px; margin: 0px; line-height: 50px;"></i> <b class="caret"></b></a>

                    <!-- Notificações
                    <ul class="dropdown-menu alert-dropdown">
                        <li>
                            <a href="">Pacientes <span class="label label-primary"> Novo</span></a>
                        </li>
                        <li>
                            <a href="">Exames <span class="label label-default"> Novo</span></a>
                        </li>
                    </ul>
                    -->

                </li>
                <li class="dropdown">
                <a href="" class="dropdown-toggle" data-toggle="dropdown"><?php include('ver_imagem_medico.php'); echo $_SESSION['nome_medico']; ?> <b class="caret"></b> </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="perfil_medico.php"><i class="fa fa-fw fa-user"></i> Perfil </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="sair.php"><i class="fa fa-fw fa-power-off"></i> Sair </a>
                        </li>
                    </ul>
                </li>
            </ul>

            <div class="collapse navbar-collapse navbar-ex1-collapse" style="position: absolute;">
                <ul class="nav navbar-nav side-nav" id="cormenulateral">
                    <li>
                        <a href="javascript: ;" data-toggle="collapse" data-target="#pacientes"><i class="fa fa-user"></i> Pacientes <i class="fa fa-fw fa-caret-down">
                        </i></a>
                        <ul id="pacientes" class="collapse">
                            <li>
                                <a href="meuspacientes.php"><i class="fa fa-group"></i> Meus pacientes </a>
                            </li>
                            <li>
                                <a href="aceitar_novo_paciente.php"><i class="fa fa-plus"></i> Aceitar novo paciente </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript: ;" data-toggle="collapse" data-target="#exames"><i class="fa fa-file"></i> Laudos <i class="fa fa-fw fa-caret-down">
                        </i></a>
                        <ul id="exames" class="collapse">
                            <li>
                                <a href="examesrecebidos.php"><i class="fa fa-exclamation-circle"></i> Exames recebidos </a>
                            </li>
                            <li>
                                <a href="laudosenviados.php"><i class="fa fa-arrow-up"></i> Laudos enviados </a>
                            </li>
                            <li>
                                <a href="novolaudo.php"><i class="fa fa-arrow-up"></i> Novo laudo </a>
                            </li>
                            </ul>
                        </li>   
                    <li>
                        
                        <a href="javascript: ;" data-toggle="collapse" data-target="#tratamentos"><i class="fa fa-file"></i> Tratamentos <i class="fa fa-fw fa-caret-down">
                        </i></a>
                        <ul id="tratamentos" class="collapse">
			                <li>
				                <a href="tratamentosreceitados.php"><i class="fa fa-arrow-up"></i> Tratamentos Receitados </a>
			                </li>
			                <li>
                                <a href="novotratamento.php"><i class="fa fa-plus"></i> Novo Tratamento </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">

                        <h1 class="page-header">
                            Aqui você pode ver as informações de contato do seu paciente
                        </h1>

                        <?php 

                            $codigo_medico = $_SESSION['codigo_medico'];

                            # Verifica com quantos pacientes o médico possui um vínculo
                            $verificador = "select * from vinculo where codigo_medico = $codigo_medico";
                            $resultado = mysqli_query($conexao, $verificador) or die(mysqli_error($conexao));

                            $retorno = mysqli_num_rows($resultado);

                            if($retorno <= 0) {

                                echo "<script> alert('Você ainda não está vinculado a um paciente.'); </script>";

                                echo "<h2 style='position: absolute; top: 100px; left: 330px; text-align: center;'> <center> Você ainda não está vinculado a um paciente. </center> </h2 <br />";

                            } 

                            $i = 0;

                            while($dados = mysqli_fetch_array($resultado)) {

                                $i += 1;

                                $codigo_paciente = $dados['codigo_paciente'];

                                # Pega os dados de todos os pacientes
                                $q2 = "select * from paciente where codigo = $codigo_paciente";
                                $resultado2 = mysqli_query($conexao, $q2) or die(mysqli_error($conexao)); 
                                $dados2 = mysqli_fetch_array($resultado2);

                                echo "<div class='col-lg-12'>

                                    <div class='panel panel-success' style='width: 70%; position: relative; left: 180px;'>
                                        <div class='panel-heading'>
                                            <center> Seu paciente " . $i . "</center>
                                        </div>
                                        <div class='panel-body' style='background-color: rgba(0, 0, 0, 0);'>";

                                        echo "<center>";

                                            include("ver_imagem_paciente_pesquisado.php");

                                        echo "</center>";

                                            echo "<div class='div_panel_body_info' style='font-size: 12pt;'>";
                                                echo "<p> Nome: " . $dados2['nome_paciente'] . "</p>";
                                                echo "<p> Email: " . $dados2['email_paciente'] . "</p>";
                                                echo "<p> Telefone: " . $dados2['telefone'] . "</p>";
                                                echo "<p> Estado: " . $dados2['uf'] . "</p>";
                                                echo "<p> Cidade: " . $dados2['cidade'] . "</p>";
                                                echo "<p> Bairro: " . $dados2['bairro'] . "</p>";
                                                echo "<p> Rua: " . $dados2['rua'] . "</p>";
                                                echo "<p> Número: " . $dados2['numero'] . "</p>";

                                            echo"
                                            </div>
                                        </div>";

                                        echo "<div class='panel-footer' style='text-align: right;'>";

                                            echo "<form name='excluirForm' method='post' role='form'  action='excluir_paciente.php?codigo_paciente=" . $dados2['codigo'] . "'>";

                                                    echo "<span class='input-group-btn'>
                                                        <button class='btn btn-danger' type='submit' name='btnExcluir' data-toggle='modal' data-target='#myModal'><i class='fa fa-trash-o'></i> Excluir paciente </button>
                                                    </span>

                                            </form>";

                                        echo "</div> 
                                    </div>
                                </div>"; 

                            }                

                        ?>

                    </div>
                </div>
            </div>
        </div>       
    </div>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>

