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
    
    <title>AHRM CDS - Perfil do médico</title>

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
                    <a href="" class="dropdown-toggle" data-toggle="dropdown"> <img class="imagem_perfil_menu_topo" src="ver_imagem_medico.php?id_medico=<?php echo $_SESSION['codigo_medico'];?>"> <?php echo $_SESSION['nome_medico']; ?> <b class="caret"></b> </a>
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
                        <a href="javascript: ;" data-toggle="collapse" data-target="#exames"><i class="fa fa-file"></i> Exames <i class="fa fa-fw fa-caret-down">
                        </i></a>
                        <ul id="exames" class="collapse">
                            <li>
                                <a href="exabesrecebidos.php"><i class="fa fa-exclamation-circle"></i> Exames recebidos </a>
                            </li>
                            <li>
                                <a href="laudosenviados.php"><i class="fa fa-arrow-up"></i> Laudos enviados </a>
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
                            Aqui você pode editar suas informações pessoais
                        </h1>

                        <?php 

                            $codigo_medico = $_SESSION['codigo_medico'];

                            $q = "select * from medico where codigo = $codigo_medico";
                            $resultado = mysqli_query($conexao, $q) or die(mysqli_error($conexao));
                            $dados = mysqli_fetch_array($resultado);

                            echo "<div class='col-lg-12'>";

                                echo "<form name='editarForm' method='post' role='form'  action='editar_medico.php?codigo_medico=" . $dados['codigo'] . "'>";

                                    echo "<div class='panel panel-success' style='width: 70%; position: relative; left: 180px;'>
                                        <div class='panel-heading'>
                                            <center> Informações pessoais </center>
                                        </div>
                                        <div class='panel-body' style='background-color: rgba(0, 0, 0, 0);'>";

                                            echo "<p style='text-align: center'> <img height='350' width='350' src='ver_imagem_medico_pesquisado.php?id_medico=" . $dados['codigo'] . "'></p>

                                            <br />";

                                            echo "<div class='div_panel_body_info' style='font-size: 14pt; text-align: justify;'>";

                                                echo "Nome: <input type='text' name='editNome' value=" . $dados['nome_medico'] . " size='30'> <br />";
                                                echo "Data de nascimento: <input type='text' name='editData' value=" . $dados['data_de_nascimento'] . " size='30'> <br />";
                                                echo "CPF: <input type='text' name='editCPF' value=" . $dados['cpf_medico'] . " size='30'> <br />";
                                                echo "Senha: <input type='text' name='editSenha' value=" . $dados['senha'] . " size='30'> <br />";
                                                echo "CRM: <input type='text' name='editCRM' value=" . $dados['crm'] . " size='30'> <br />";
                                                echo "Email: <input type='text' name='editEmail' value=" . $dados['email_medico'] . " size='30'> <br />";
                                                echo "Telefone: <input type='text' name='editTelefone' value=" . $dados['telefone'] . " size='30'> <br />";
                                                echo "Estado: <input type='text' name='editUF' value=" . $dados['uf'] . "> <br />";
                                                echo "Cidade: <input type='text' name='editCidade' value=" . $dados['cidade'] . " size='30'> <br />";
                                                echo "Bairro: <input type='text' name='editBairro' value=" . $dados['bairro'] . "> <br />";
                                                echo "Rua: <input type='text' name='editRua' value=" . $dados['rua'] . " size='30'> <br />";
                                                echo "Número: <input type='text' name='editNumero' value=" . $dados['numero'] . " size='30'> <br />";

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
