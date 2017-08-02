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
    
    <title>AHRM CDS - Exames enviados</title>

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
                    <a href="" class="dropdown-toggle" data-toggle="dropdown"> <img class="imagem_perfil_menu_topo" src="ver_imagem_paciente.php?id_paciente= <?php echo $_SESSION['codigo_paciente']; ?>"> <?php echo $_SESSION['nome_paciente']; ?> <b class="caret"></b> </a>
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
                            Aqui você pode ver todos os exames que já enviou 
                        </h1>

                        <div id="examesenviados">

                        <?php 

                        # Verifica todos os exames já enviados pelo paciente 
                        $q1 = "select * from exame where codigo_paciente =" . $_SESSION['codigo_paciente'] . " order by data_do_exame desc;";
                        $resultado1 = mysqli_query($conexao, $q1) or die(mysqli_error($conexao));
                        $total1 = mysqli_num_rows($resultado1);

                        if($total1 > 0) {

                            while($dados1 = mysqli_fetch_array($resultado1)) {

                                # Busca o nome do médico que recebeu o exame
                                $q2 = "select nome_medico from medico where codigo =" . $dados1['codigo_medico'];
                                $resultado2 = mysqli_query($conexao, $q2) or die(mysqli_error($conexao));
                                $total2 = mysqli_num_rows($resultado2);
                                $dados2 = mysqli_fetch_array($resultado2);

                                $date_time_exame = new DateTime($dados1['data_do_exame']);
                                $data_do_exame = $date_time_exame->format('d/m/Y');

                                echo "<p style='text-align: center; font-size: 16pt;'> Data de envio do exame: " . $data_do_exame . "</p>";

                                echo "<p style='text-align: center; font-size: 16pt;'> Enviado para o médico: " . $dados2['nome_medico'] . "</p>";

                                echo "<p style='text-align: center; font-size: 16pt;'> Tipo do exame: " . $dados1['tipo_exame'] . "</p>";

                                echo "<p style='text-align: center; font-size: 16pt;'> Descrição do exame: " . $dados1['descricao_exame'] . "</p>"; 

                                echo "<p style='text-align: center'> <iframe height='500' width='500' src='ver_pdf.php?id_paciente=" . $dados1['codigo_paciente'] . "'></iframe></p>

                                <hr>

                                <br />";

                            }

                        } 
                        else {

                            echo "<h3 style='text-align: center;'>";
                            echo "Você ainda não enviou exames para serem analisados pelo seu médico.";
                            echo "</h3>";

                        }

                        ?>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
