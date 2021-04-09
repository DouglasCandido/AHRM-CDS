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
    
    <title>AHRM CDS - Meu médico</title>

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
                            Aqui você pode entrar em contato com o seu médico
                        </h1>

                        <?php 

                            $codigo_paciente = $_SESSION['codigo_paciente'];

                            $verificador = "select * from paciente where codigo = $codigo_paciente";
                            $resultado = mysqli_query($conexao, $verificador) or die(mysqli_error($conexao));
                            $retorno = mysqli_fetch_array($resultado);

                            # O paciente só pode enviar exame se já possui um vínculo com um médico
                            if($retorno['medico_paciente'] <= 0) {

                                echo "<script> alert('Você não está vinculado a um médico. Para poder enviar um exame você precisa estar vinculado a um médico.'); </script>";

                                echo "<h2 style='position: absolute; top: 100px; left: 330px; text-align: center;'> <center> Você ainda não está vinculado a um médico. </center> </h2 <br />";

                                echo "<img src='img/img-sad-doctor.png' style='position: absolute; top: 200px; left: 450px; text-align: center;'> <br /> ";

                                echo "<h2 style='position: absolute; top: 500px; text-align: center;'> <center> Não perca tempo e vincule-se a um médico! Só assim você poderá receber laudos online. </center> </h2 <br />";


                            } else {

                                # Caso o paciente esteja vinculado a um médico, irá exibir informações dele
                                $codigo_medico = $retorno['medico_paciente'];

                                $q = "select * from medico where codigo = $codigo_medico";
                                $resultado = mysqli_query($conexao, $q) or die(mysqli_error($conexao)); 
                                $dados = mysqli_fetch_array($resultado);

                                echo "<div class='col-lg-12'>

                                    <div class='panel panel-success' style='width: 70%; position: relative; left: 180px;'>
                                        <div class='panel-heading'>
                                            <center> Seu médico </center>
                                        </div>
                                        <div class='panel-body' style='background-color: rgba(0, 0, 0, 0);'>";

                                            echo "<p style='text-align: center'> <img height='350' width='350' src='ver_imagem_medico_pesquisado.php?id_medico=" . $dados['codigo'] . "'></p>

                                            <br />";

                                            echo "<div class='div_panel_body_info' style='font-size: 12pt;'>";
                                                echo "<p> Nome: " . $dados['nome_medico'] . "</p>";
                                                echo "<p> Email: " . $dados['email_medico'] . "</p>";
                                                echo "<p> CRM: " . $dados['crm'] . "</p>";
                                                echo "<p> Telefone: " . $dados['telefone'] . "</p>";
                                                echo "<p> Estado: " . $dados['uf'] . "</p>";
                                                echo "<p> Cidade: " . $dados['cidade'] . "</p>";
                                                echo "<p> Bairro: " . $dados['bairro'] . "</p>";
                                                echo "<p> Rua: " . $dados['rua'] . "</p>";
                                                echo "<p> Número: " . $dados['numero'] . "</p>";

                                            echo"
                                            </div>
                                        </div>";

                                        echo "<div class='panel-footer' style='text-align: right;'>";

                                            echo "<form name='excluirForm' method='post' role='form'  action='excluir_medico.php?codigo_medico=" . $dados['codigo'] . "'>";

                                                    echo "<span class='input-group-btn'>
                                                        <button class='btn btn-danger' type='submit' name='btnExcluir' data-toggle='modal' data-target='#myModal'><i class='fa fa-trash-o'></i> Excluir médico </button>
                                                    </span>

                                            </form>";

                                        echo "</div> 
                                        </div>";  ?>

                                    <!-- Essa div é responsável por permitir o envio de emails do paciente para o médico -->
                                    <div id='divEnviarEmail>'>

                                        <hr> 

                                        <br />

                                        <h2 style='text-align: center;'> Contate o seu médico enviando um email para ele: </h2> <br />

                                        <form action="meumedico.php" method="post"> 

                                            <div class='form-group'>

                                                <label>Senha da conta de email que você registrou:</label> <br />
                                                <input type='text' name='senhaContaEmail' size='50' placeholder='Exemplo: senha123'> <br /> 

                                            </div>

                                            <div class='form-group'>

                                                <label>Assunto do email:</label> <br />
                                                <input type='text' name='assuntoEmail' size='50' placeholder='Exemplo: Vamos marcar uma consulta pessoalmente'> <br /> 

                                            </div>

                                            <div class='form-group'>

                                                <label>Corpo do email:</label> <br />
                                                <textarea rows='10' cols='145' name='mensagemEmail' placeholder='Exemplo: Olá, Doutor. Eu gostaria de agendar uma consulta pessoalmente na sua clínica.'></textarea>

                                            </div>

                                            <span> 

                                                <button type='submit' class='btn btn-success' name='btnEnviarEmail' data-toggle='modal' value='ok' style='margin-right: 5px;'><i class='fa fa-envelope-o'></i> Enviar email </button>
                                                <button type='reset' class='btn btn-primary' name='btnLimpar' data-toggle='modal'> Limpar </button> 

                                            </span> 

                                        </form>

                                    <?php 

                                        if (isset($_POST) and !empty($_POST)) { 

                                            $botao = $_POST['btnEnviarEmail'];

                                            # Pega os dados do paciente para poder preencher o email
                                            $q = "select * from paciente where codigo =" . $_SESSION['codigo_paciente'] . ";";
                                            $resultado = mysqli_query($conexao, $q) or die(mysqli_error($conexao));
                                            $dados = mysqli_fetch_array($resultado);

                                            # Pega os dados do médico para poder preencher o email
                                            $q2 = "select * from medico where codigo =" . $dados['medico_paciente'] . ";";
                                            $resultado2 = mysqli_query($conexao, $q2) or die(mysqli_error($conexao));
                                            $dados2 = mysqli_fetch_array($resultado2);

                                            $nome_medico = $dados2['nome_medico'];
                                            $email_medico = $dados2['email_medico'];

                                            # Dados enviados pelo formulário
                                            $nomeusuario = $dados['nome_paciente'];
                                            $emailusuario = $dados['email_paciente'];
                                            $senhausuario = $_POST['senhaContaEmail'];

                                            $assunto = $_POST['assuntoEmail'];
                                            $mensagemusuario = $_POST['mensagemEmail'];

                                            if($botao == 'ok') {

                                                include_once('class.phpmailer.php');
                                                require_once('class.smtp.php');
                                                require_once('class.pop3.php');

                                                # Configurações do servidor SMTP
                                                $mail = new PHPMailer();
                                                $mail->IsSMTP();
                                                $mail->Mailer = 'smtp';
                                                $mail->SMTPAuth = true;
                                                $mail->Host = 'smtp.gmail.com'; 
                                                $mail->Port = 587;
                                                $mail->SMTPSecure = 'tls';

                                                # Configurações para autenticação no determinado servidor SMTP
                                                $mail->Username = $emailusuario; 
                                                $mail->Password = $senhausuario; 
                                                $mail->IsHTML(true);
                                                $mail->CharSet = "utf8";

                                                # Configurações do email
                                                $mail->From = $emailusuario;
                                                $mail->FromName = $nomeusuario;
                                                $mail->AddAddress($email_medico, $nome_medico); 
                                                $mail->AddReplyTo($emailusuario, $nomeusuario);
                                                $mail->Subject = "AHRM CDS: ";
                                                $mail->Subject += " " . $assunto;
                                                $mail->Body = $mensagemusuario;

                                                if(!$mail->Send()) {

                                                    echo "<script> alert('O email não foi enviado.'); </script>";
                                                    echo "<h3 style='text-align: center;'> Erro no envio do email: " . $mail->ErrorInfo . "</h3>";
                                                    exit;

                                                }

                                                echo "<script> alert('O email foi enviado com sucesso!'); </script>";

                                            }

                                        }

                                    ?>

                                    </div>

                                    <?php 

                                    echo "
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
