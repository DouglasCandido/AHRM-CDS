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
    
    <title>AHRM CDS - Home Médico</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Plugin JQuery que altera o texto do input type file -->
    <script src='js/jquery-input-file-text.js'></script>

    <script type="text/javascript">

        $(document).ready(function() {
            $('#escolher-arquivo').inputFileText( { text: 'Escolha o arquivo PDF do laudo realizado' } );
        });

    </script>

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
                            Olá Dr. <?php echo $_SESSION['nome_medico'];?>! Seja bem vindo ao AHRM CDS! 
                        </h1>

                        <h2 style='text-align: center;'> Aqui você pode enviar um laudo (PDF) sobre um exame de um paciente </h2>

                        <br />

                        <ol class="breadcrumb" style="background-color: rgba(0, 0, 0, 0.8); position: relative; width: 80%; height: 100%; left: 10%;">
                            <li class="active" style="font-size: 16pt; color: white;">
                                <i class="fa fa-edit" style="font-size: 30pt; color: blue;"></i> Envio de laudo
                            </li>

                            <br /> <br />

                        <form name="cadLaudoForm" method="post" role="form" enctype="multipart/form-data" action="cadastro/enviar_laudo.php">

                        <div class="form-group">

                            <label style="font-size: 12pt; color: white;">Data de envio do laudo:</label> &nbsp;

                            <?php

                                $time = strtotime(date('Y-m-d H:i:s'));
                                $data_do_laudo = date('Y-m-d', $time);

                                echo "<input type='date' name='cadDataLaudo' readonly style='color: black;' value=" . $data_do_laudo . ">";

                            ?>

                        </div>

                            <!--
                            <div class="form-group">

                                    <label style="font-size: 12pt; color: white;">Tipo do laudo:</label> &nbsp;

                                    <select name='cadTipoLaudo'>
                                    <option> Eletrocardiograma </option>
                                    <option> Radiológico </option>
                                    <option> Radioscopia </option>
                                    <option> Ressonância magnética </option>
                                    </select>

                            </div>
                            -->

                            <div class="form-group">
                                    <label style="font-size: 12pt; color: white;"> Descrição do laudo </label>
                                    <textarea rows="10" cols="95" name="cadDescricaoLaudo"></textarea>
                            </div>

                            <br />

                            <div class="form-group">

                                <label style="font-size: 12pt; color: white;"> Selecione o paciente que receberá o laudo: </label>

                                <?php

                                    $q = "select * from paciente where medico_paciente=" . $_SESSION['codigo_medico'];
                                    $resultado = mysqli_query($conexao, $q) or die(mysqli_error($conexao)); 

                                    while($dados2 = mysqli_fetch_array($resultado)) {

                                        echo "<select name='cadPaciente'>";

                                            echo "<option value=" . $dados2['codigo'] . ">";

                                            echo $dados2['codigo'] . ", " . $dados2['nome_paciente'];

                                            echo "</option>";

                                        echo "</select>";

                                    }

                                ?>

                            </div>

                            <br /> 

                            <div class="form-group"> 
                                <input name="cadLaudo" id="escolher-arquivo" type="file" required> 
                            </div>

                            <input type="hidden" name="MAX_FILE_SIZE" value="999999999">
                        
                            <br />

                            <div style="text-align: right;">

                                <button type="submit" class="btn btn-success">Enviar</button>
                                <button type="reset" class="btn btn-primary">Limpar</button>

                            </div>

                        </form>

                        </ol>
                        
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>

