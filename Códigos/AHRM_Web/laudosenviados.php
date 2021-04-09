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
    
    <title>AHRM CDS - Laudos enviados</title>

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
                </ul>
            </div>
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">

                        <h1 class="page-header">
                            Aqui você pode ver todos os laudos que já enviou 
                        </h1>

                        <div id="examesenviados">

                        <?php 

                        # Verifica todos os laudos já enviados pelo médico
                        $q1 = "select * from laudo where codigo_medico =" . $_SESSION['codigo_medico'] . " order by data_do_laudo desc;";
                        $resultado1 = mysqli_query($conexao, $q1) or die(mysqli_error($conexao));
                        $total1 = mysqli_num_rows($resultado1);

                        if($total1 > 0) {

                            while($dados1 = mysqli_fetch_array($resultado1)) {

                                # Busca o nome do paciente que recebeu o laudo
                                $q2 = "select nome_paciente from paciente where codigo =" . $dados1['codigo_paciente'];
                                $resultado2 = mysqli_query($conexao, $q2) or die(mysqli_error($conexao));
                                $total2 = mysqli_num_rows($resultado2);
                                $dados2 = mysqli_fetch_array($resultado2);

                                $date_time_laudo = new DateTime($dados1['data_do_laudo']);
                                $data_do_laudo = $date_time_laudo->format('d/m/Y');

                                echo "<p style='text-align: center; font-size: 16pt;'> Data de envio do laudo: " . $data_do_laudo . "</p>";

                                echo "<p style='text-align: center; font-size: 16pt;'> Enviado para o paciente: " . $dados2['nome_paciente'] . "</p>";

                                echo "<p style='text-align: center; font-size: 16pt;'> Descrição do laudo: " . $dados1['descricao_laudo'] . "</p>"; 

                                echo "<p style='text-align: center'> <iframe height='500' width='500' src='ver_pdf_laudo.php?id_medico=" . $dados1['codigo_medico'] . "'></iframe></p>

                                <hr>

                                <br />";

                            }

                        } 
                        else {

                            echo "<h3 style='text-align: center;'>";
                            echo "Você ainda não enviou laudos para os seus pacientes.";
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

