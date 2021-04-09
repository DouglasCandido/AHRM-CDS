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
    
    <title>AHRM CDS - Novo exame</title>

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
            $('#escolher-foto').inputFileText( { text: 'Selecione as fotos dos seu exames (eletrocardiograma, radiológico, radioscopia, ressonância magnética)' } );
        });

    </script>

</head>

<body onload="alert('Para realizar a consulta é necessário preencher os campos abaixo com a maior veracidade possível, isso ajudará o médico a elaborar um diagnóstico preciso.');">

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

                </li>
                <li class="dropdown">
                    <a href="" class="dropdown-toggle" data-toggle="dropdown"> <img class="imagem_perfil_menu_topo" src="ver_imagem_paciente.php?id_paciente=<?php echo $_SESSION['codigo_paciente'];?>"> <?php echo $_SESSION['nome_paciente']; ?> <b class="caret"></b> </a>
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
                            Aqui você poderá realizar um nova consulta com o seu médico 
                        </h1>

                        <ol class="breadcrumb" style="background-color: rgba(0, 0, 0, 0.8); position: relative; width: 100%; height: 100%;">

                            <li class="active" style="font-size: 16pt; color: white;">
                                <i class="fa fa-edit" style="font-size: 30pt; color: blue;"></i> Novo exame
                            </li>

                            <br /> <br />

                            <form name="novoExameForm" method="post" role="form" enctype="multipart/form-data" action="cadastro/cadastro_exame.php">

                            <?php 

                            # Exibe algumas informações do paciente
                            $q = "select nome_paciente, genero, peso, altura, diabetico, data_de_nascimento from paciente where codigo=" . $_SESSION['codigo_paciente'] . "";
                            $resultado = mysqli_query($conexao, $q) or die(mysqli_error($conexao)); 
                            $dados = mysqli_fetch_array($resultado);

                            $nome_paciente = $dados['nome_paciente'];
                            $genero_paciente = $dados['genero'];
                            $peso_paciente = $dados['peso'];
                            $altura_paciente = $dados['altura'];
                            $diabetico = $dados['diabetico'];

                            $current_date_time = new DateTime(date());
                            $date_time_birth_date = new DateTime($dados['data_de_nascimento']);
                            $idade_paciente =  $current_date_time->format('Y') - $date_time_birth_date->format('Y');

                            ?>

                            <div class="form-group" style="text-align: center;">
                                <?php echo"<h2 style='color: white; font-size: 16pt;'> Nome do paciente: " . $nome_paciente . "</h2>"; ?>
                            </div>

                            <div class="form-group" style="text-align: center;">
                                <?php echo"<h2 style='color: white; font-size: 16pt;'> Idade do paciente: " . $idade_paciente . " anos </h2>"; ?>
                            </div>

                            <div class="form-group" style="text-align: center;">
                                <?php echo"<h2 style='color: white; font-size: 16pt;'> Gênero do paciente: " . $genero_paciente . ". </h2>"; ?>
                            </div>

                            <div class="form-group" style="text-align: center;">
                                <?php echo"<h2 style='color: white; font-size: 16pt;'> Peso do paciente: " . $peso_paciente . ".  </h2>"; ?>
                            </div>

                            <div class="form-group" style="text-align: center;">
                                <?php echo"<h2 style='color: white; font-size: 16pt;'> Altura do paciente: " . $altura_paciente . ". </h2>"; ?>
                            </div>

                            <div class="form-group" style="text-align: center;">
                                <?php echo"<h2 style='color: white; font-size: 16pt;'> O paciente é diabético? " . $diabetico . ". </h2>"; ?>
                            </div>

                            <div class="form-group">

                                    <label style="font-size: 12pt; color: white;">Data de realização do exame:</label> &nbsp;

                                    <?php

                                        $time = strtotime(date('Y-m-d H:i:s'));
                                        $data_do_exame = date('Y-m-d', $time);

                                        echo "<input type='text' name='cadDataExame' style='color: black;' value=" . $data_do_exame . ">";

                                    ?>

                            </div>

                            <!-- 
                            <div class="form-group">

                                    <label style="font-size: 12pt; color: white;">Tipo do exame:</label> &nbsp;

                                    <select name='cadTipoExame'>
                                    <option> Eletrocardiograma </option>
                                    <option> Radiológico </option>
                                    <option> Radioscopia </option>
                                    <option> Ressonância magnética </option>
                                    </select>

                            </div>
                            -->

                            <br />

                            <div id="perguntasPessoais">

                                <div class="form-group" style="color: white; font-size: 12pt;">
                                    <label style="font-size: 12pt; color: white;"> Você fuma? </label> <br />
                                    <input type="radio" name="cadFumarPerguntasPessoais" value="Nunca" > Nunca <br>
                                    <input type="radio" name="cadFumarPerguntasPessoais" value="Raramente" > Raramente <br>
                                    <input type="radio" name="cadFumarPerguntasPessoais" value="Às vezes" > Às vezes <br>
                                    <input type="radio" name="cadFumarPerguntasPessoais" value="Frequentemente" > Muito frequentemente <br>
                                </div>

                                <div class="form-group" style="color: white; font-size: 12pt;">
                                    <label style="font-size: 12pt; color: white;"> Você bebe? </label> <br />
                                    <input type="radio" name="cadBeberPerguntasPessoais" value="Nunca" > Nunca <br>
                                    <input type="radio" name="cadBeberPerguntasPessoais" value="Raramente" > Raramente <br>
                                    <input type="radio" name="cadBeberPerguntasPessoais" value="Às vezes" > Às vezes <br>
                                    <input type="radio" name="cadBeberPerguntasPessoais" value="Frequentemente" > Muito frequentemente <br>
                                </div>

                                <div class="form-group" style="color: white; font-size: 12pt;">
                                    <label style="font-size: 12pt; color: white;"> Você tem estresse? </label> <br />
                                    <input type="radio" name="cadEstressePerguntasPessoais" value="Nunca" > Nunca <br>
                                    <input type="radio" name="cadEstressePerguntasPessoais" value="Raramente" > Raramente <br>
                                    <input type="radio" name="cadEstressePerguntasPessoais" value="Às vezes" > Às vezes <br>
                                    <input type="radio" name="cadEstressePerguntasPessoais" value="Frequentemente" > Muito frequentemente <br>
                                </div>

                                <div class="form-group" style="color: white; font-size: 12pt;">
                                    <label style="font-size: 12pt; color: white;"> Algo de anormal acontece quando você pratica algum exercício físico? </label> <br />
                                    <input type="radio" name="cadAnomaliaPerguntasPessoais" value="Nunca" > Nunca <br>
                                    <input type="radio" name="cadAnomaliaPerguntasPessoais" value="Raramente" > Raramente <br>
                                    <input type="radio" name="cadAnomaliaPerguntasPessoais" value="Às vezes" > Às vezes <br>
                                    <input type="radio" name="cadAnomaliaPerguntasPessoais" value="Frequentemente" > Muito frequentemente <br>
                                </div>

                                <div class="form-group">
                                    <label style="font-size: 12pt; color: white;">Observações - Para um melhor diagnóstico é necessário detalhadar as informações acima.</label>
                                    <textarea rows="10" cols="143" name="cadObservacoesPerguntasPessoais"></textarea>
                                </div>

                                <hr style="height: 3px; background-color: red; color: red; margin: 0; padding: 0;">

                                <br />

                            </div>

                            <div id="innerNovoExameForm" name="innerNovoExameForm">

                                    <?php

                                    $q = "select * from sintoma;";
                                    $resultado = mysqli_query($conexao, $q) or die(mysqli_error($conexao));

                                    $i = 0;

                                    while(($sintoma = mysqli_fetch_array($resultado)) != null) {

                                        $i += 1;

                                        echo "<div class='form-group' style='color: white;'>
                                        <label style='font-size: 12pt; color: white;'> Você sente" . " " . $sintoma['nome'] . "? </label>

                                        <br />";

                                            echo "<input type='hidden' name='cadNomeSintoma" . $i . "' value='" . $sintoma['nome'] . "'>";
                                            
                                            echo "<input type='radio' name='cadQuantidadeSintoma" . $i . "' value='Nunca' > Nunca <br>
                                            <input type='radio' name='cadQuantidadeSintoma" . $i . "' value='Raramente' > Raramente <br>
                                            <input type='radio' name='cadQuantidadeSintoma" . $i . "' value='Às vezes' > Às vezes <br>
                                            <input type='radio' name='cadQuantidadeSintoma" . $i . "' value='Frequentemente' > Frequentemente <br>";

                                        echo "</div>";

                                        echo "<div class='form-group'>
                                            <label style='font-size: 12pt; color: white;'>Cronologia - A data de que você começou a sentir esse sintoma:</label>
                                            <input type='date' class='form-control' name='cadDataSintoma" . $i . "'>
                                        </div>

                                        <div class='form-group'>
                                            <label style='font-size: 12pt; color: white;'>Circunstâncias - Detalhe informações sobre o local, a atividade que exercia no momento da ocorrência do sintoma, se houve exposição a fatores ambientais e quais alimentos você ingeriu durante esse dia.</label>
                                            <textarea rows='10' cols='143' name='cadCircunstanciasSintoma" . $i . "'></textarea>
                                        </div>

                                        <hr style='height: 3px; background-color: red; color: red; margin: 0; padding: 0;'>

                                        <br />";

                                    }

                                    ?>

                            </div>

                            <div class="form-group"> 
                                <input name="cadImagem" id="escolher-foto" type="file"> 
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
