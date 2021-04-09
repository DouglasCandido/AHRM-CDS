<?php 

    require_once("conexao.php");
    
    require("integridadepaciente.php");
    
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
    
    <title>AHRM CDS - Perfil do paciente</title>

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
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation" id="cor">

            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class='navbar-brand' href='indexpaciente.php' style='color: #fff; font-size: 16pt; position: absolute; top: 10px;'>AHRM CDS</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                <li class="dropdown">

                    <a href="" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell" style="font-size: 20px; padding: 0px; margin: 0px; line-height: 50px;"></i> <b class="caret"></b></a>

                    <!-- Notificações
                    <ul class="dropdown-menu alert-dropdown">
                        <li>
                            <a href="">Exames <span class="label label-default"> Novo</span></a>
                        </li>

                    </ul>
                    -->

                </li>
                <li class="dropdown">
                <a href="" class="dropdown-toggle" data-toggle="dropdown"><?php include('ver_imagem_paciente.php'); echo $_SESSION['nome_paciente']; ?> <b class="caret"></b> </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="perfil_paciente.php"><i class="fa fa-fw fa-user"></i> Perfil </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="sair.php"><i class="fa fa-fw fa-power-off"></i> Sair </a>
                        </li>
                    </ul>
                </li>
            </ul>

            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav" id="cormenulateral">

                    <li>
                        <a href="javascript: ;" data-toggle="collapse" data-target="#medico"><i class="fa fa-user-md"></i> Médico <i class="fa fa-fw fa-caret-down">
                        </i></a>
                        <ul id="medico" class="collapse">
                            <li>
                                <a href="meumedico.php"><i class="fa fa-user-md"></i> Meu médico </a>
                            </li>
                            <li>
                                <a href="procurarmedico.php"><i class="fa fa-search"></i> Procurar médico </a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a href="javascript: ;" data-toggle="collapse" data-target="#exames"><i class="fa fa-file"></i> Exames <i class="fa fa-fw fa-caret-down">
                        </i></a>
                        <ul id="exames" class="collapse">
                            <li>
                                <a href="laudosrecebidos.php"><i class="fa fa-check-circle"></i> Laudos recebidos </a>
                            </li>
                            <li>
                                <a href="examesenviados.php"><i class="fa fa-arrow-up"></i> Exames enviados</a>
                            </li>
                            <li>
                                <a href="novoexame.php"><i class="fa fa-plus"></i> Novo exame </a>
                            </li>
                        </ul>
                    </li>

   		    </div>
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">

                        <h1 class="page-header">
                            Aqui você pode editar suas informações pessoais
                        </h1>

                        <?php 

                            $codigo_paciente = $_SESSION['codigo_paciente'];

                            $q = "select * from paciente where codigo = $codigo_paciente";
                            $resultado = mysqli_query($conexao, $q) or die(mysqli_error($conexao));
                            $dados = mysqli_fetch_array($resultado);

                            echo "<div class='col-lg-12'>";

                                echo "<form name='editarForm' method='post' role='form'  action='editar_paciente.php?codigo_paciente=" . $dados['codigo'] . "'>";

                                    echo "<div class='panel panel-success' style='width: 70%; position: relative; left: 180px;'>
                                        <div class='panel-heading'>
                                            <center> Informações pessoais </center>
                                        </div>
                                        <div class='panel-body' style='background-color: rgba(0, 0, 0, 0);'>";

                                            echo "<center>";

                                                include("ver_imagem_paciente_pesquisado.php");

                                            echo "</center>";

                                            echo "<br />";

                                            echo "<div class='div_panel_body_info' style='font-size: 14pt; text-align: justify;'>";

                                                echo "<ol class='breadcrumb' style='background-color: rgba(0, 0, 0, 0.8);'>";

                                                    echo "<div class='form-group'><label style='font-size: 12pt; color: white;'>Nome:</label> &nbsp;";
                                                    echo "<input type='text' style='width: 100%;' style='width: 100%;' name='editNome' value=" . $dados['nome_paciente'] . " class='inputs'> <br />";
                                                    echo "</div>";

                                                    echo "<div class='form-group'><label style='font-size: 12pt; color: white;'>Data de nascimento:</label> &nbsp;";
                                                    echo "<input type='text' style='width: 100%;' name='editData' value=" . $dados['data_de_nascimento'] . " class='inputs'> <br />";
                                                    echo "</div>";

                                                    echo "<div class='form-group'><label style='font-size: 12pt; color: white;'>CPF:</label> &nbsp;";
                                                    echo "<input type='text' style='width: 100%;' name='editCPF' value=" . $dados['cpf_paciente'] . " class='inputs'> <br />";
                                                    echo "</div>";

                                                    echo "<div class='form-group'><label style='font-size: 12pt; color: white;'>Senha:</label> &nbsp;";
                                                    echo "<input type='text' style='width: 100%;' name='editSenha' value=" . $dados['senha'] . " class='inputs'> <br />";
                                                    echo "</div>";

                                                    echo "<div class='form-group'><label style='font-size: 12pt; color: white;'>Email:</label> &nbsp;";
                                                    echo "<input type='text' style='width: 100%;' name='editEmail' value=" . $dados['email_paciente'] . " class='inputs'> <br />";
                                                    echo "</div>";

                                                    echo "<div class='form-group'><label style='font-size: 12pt; color: white;'>Telefone:</label> &nbsp;";
                                                    echo "<input type='text' style='width: 100%;' name='editTelefone' value=" . $dados['telefone'] . " class='inputs'> <br />";
                                                    echo "</div>";

                                                    echo "<div class='form-group'><label style='font-size: 12pt; color: white;'>Estado:</label> &nbsp;";
                                                    echo "<input type='text' style='width: 100%;' name='editUF' value=" . $dados['uf'] . " class='inputs'> <br />";
                                                    echo "</div>";

                                                    echo "<div class='form-group'><label style='font-size: 12pt; color: white;'>Cidade:</label> &nbsp;";
                                                    echo "<input type='text' style='width: 100%;' name='editCidade' value=" . $dados['cidade'] . " class='inputs'> <br />";
                                                    echo "</div>";

                                                    echo "<div class='form-group'><label style='font-size: 12pt; color: white;'>Bairro:</label> &nbsp;";
                                                    echo "<input type='text' style='width: 100%;' name='editBairro' value=" . $dados['bairro'] . "  class='inputs'> <br />";
                                                    echo "</div>";

                                                    echo "<div class='form-group'><label style='font-size: 12pt; color: white;'>Rua:</label> &nbsp;";
                                                    echo "<input type='text' style='width: 100%;' name='editRua' value=" . $dados['rua'] . " class='inputs'> <br />";
                                                    echo "</div>";

                                                    echo "<div class='form-group'><label style='font-size: 12pt; color: white;'>Numero:</label> &nbsp;";
                                                    echo "<input type='text' style='width: 100%;' name='editNumero' value=" . $dados['numero'] . " class='inputs'> <br />";
                                                    echo "</div>";

                                                echo "</ol>";

                                            echo"
                                            </div>
                                        </div>";

                                        echo "<div class='panel-footer' style='text-align: right;'>";

                                            echo "<span class='input-group-btn'>
                                                <button class='btn btn-info' type='submit' name='btnEditar' data-toggle='modal' data-target='#myModal'><i class='fa fa-pencil'></i> Editar perfil </button>
                                            </span>";

                                        echo "</div> 
                                        </div>
                                    </div>
                                </form>
                            </div>";                                                

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

