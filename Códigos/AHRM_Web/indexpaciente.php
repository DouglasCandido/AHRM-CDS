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
    
    <title>AHRM CDS - Home Paciente</title>

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
            $('#escolher-arquivo').inputFileText( { text: 'Escolha o arquivo PDF do exame realizado' } );
        });

    </script>

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
                            Olá <?php echo $_SESSION['nome_paciente'];?>! Seja bem vindo ao AHRM CDS! 
                        </h1>

                        <h2 style='text-align: center;'> Aqui você pode enviar um exame (PDF) para o seu médico analisar </h2>

                        <br />

                        <ol class="breadcrumb" style="background-color: rgba(0, 0, 0, 0.8); position: relative; width: 80%; height: 100%; left: 10%;">
                            <li class="active" style="font-size: 16pt; color: white;">
                                <i class="fa fa-edit" style="font-size: 30pt; color: blue;"></i> Envio de exame
                            </li>

                            <br /> <br />

                            <form name="cadExameForm" method="post" role="form" enctype="multipart/form-data" action="cadastro/enviar_exame.php">

                            <div class="form-group">

                                    <label style="font-size: 12pt; color: white;">Data de envio do exame:</label> &nbsp;

                                    <input type='date' name='cadDataExame'>

                            </div>

                            <div class="form-group">

                                    <label style="font-size: 12pt; color: white;">Tipo do exame:</label> &nbsp;

                                    <select name='cadTipoExame'>
                                    <option> Eletrocardiograma </option>
                                    <option> Radiológico </option>
                                    <option> Radioscopia </option>
                                    <option> Ressonância magnética </option>
                                    </select>

                            </div>

                            <div class="form-group">
                                    <label style="font-size: 12pt; color: white;"> Descrição do exame </label>
                                    <textarea rows="10" cols="115" name="cadDescricaoExame"></textarea>
                                </div>

                            <div class="form-group"> 
                                <input name="cadExame" id="escolher-arquivo" type="file" required> 
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

