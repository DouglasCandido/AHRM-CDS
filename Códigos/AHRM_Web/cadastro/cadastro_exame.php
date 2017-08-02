<?php 

	require_once("../conexao.php");
	
	# Só quem tem acesso a essa página são pacientes logados 
	session_start();

	# Verifica se o paciente está logado
    if(!isset($_SESSION["cpf_paciente"]) and empty($_SESSION["cpf_paciente"]) || !isset($_SESSION["senha_paciente"]) and empty($_SESSION["senha_paciente"])) {

        header("Location: ../loginpaciente.php");

    }

    $codigo_paciente = $_SESSION['codigo_paciente'];

	$verificador = "select * from paciente where codigo = $codigo_paciente";
	$resultado = mysqli_query($conexao, $verificador) or die(mysqli_error($conexao));
	$retorno = mysqli_fetch_array($resultado);

	# O paciente só pode enviar exame se já possui um vínculo com um médico
	if($retorno['medico_paciente'] <= 0) {

		echo "<script> alert('Você não está vinculado a um médico. Para poder enviar um exame você precisa estar vinculado a um médico.'); window.location = '../procurarmedico.php'; </script>";

	} 

    # Biblioteca utilizada para transformar o formulario preenchido (exame) em PDF
	include("mpdf60/mpdf.php");

	$q = "select * from paciente where codigo=" . $_SESSION['codigo_paciente'] . "";
    $resultado = mysqli_query($conexao, $q) or die(mysqli_error($conexao)); 
    $dados = mysqli_fetch_array($resultado);

    # Recuperando os dados necessários para gerar o PDF do exame:
    $nome_paciente = $dados['nome_paciente'];
    $genero_paciente = $dados['genero'];
    $peso_paciente = $dados['peso'];
    $altura_paciente = $dados['altura'];
    $diabetico = $dados['diabetico'];

    $date_time = new DateTime($dados['data_de_nascimento']);
    $idade_paciente = 2016 - $date_time->format('Y');

    $date_time_exame = new DateTime($_POST['cadDataExame']);
    $data_do_exame = $date_time_exame->format('d/m/Y');
    # $tipo_do_exame = $_POST['cadTipoExame'];

    # Perguntas pessoais:
	$fumar = $_POST['cadFumarPerguntasPessoais'];
	$beber = $_POST['cadBeberPerguntasPessoais'];
	$estresse = $_POST['cadEstressePerguntasPessoais'];
	$anomalia = $_POST['cadAnomaliaPerguntasPessoais'];
	$observacoes = $_POST['cadObservacoesPerguntasPessoais'];

	# Imagem:
	$imagem = $_FILES['cadImagem']['tmp_name'];
    $tamanho = $_FILES['cadImagem']['size'];
    $tipo = $_FILES['cadImagem']['type'];
    $nome_imagem = $_FILES['cadImagem']['name'];

	# HTML utilizado para gerar o PDF
	$html = "

	<!DOCTYPE html>
	<html lang='en'>

	<head>

	    <meta charset='utf-8'>
	    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
	    <meta name='viewport' content='width=device-width, initial-scale=1'>
	    <meta name='description' content=''>
	    <meta name='author' content=''>

	    <link rel='icon' href='favicon.png' type='image/x-icon'/>
	    
	    <title>AHRM CDS - Exame para detecção de cardiopatia </title>

	    <!-- Bootstrap Core CSS -->
	    <link href='../css/bootstrap.min.css' rel='stylesheet'>

	    <!-- Custom CSS -->
	    <link href='estilo.css' rel='stylesheet'>

	    <!-- Custom Fonts -->
	    <link href='font-awesome/css/font-awesome.min.css' rel='stylesheet' type='text/css'>

	    <link rel='stylesheet' href='http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css'>

	    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

	    <link href='http://fonts.googleapis.com/css?family=Josefin+Slab:100,300,400,600,700,100italic,300italic,400italic,600italic,700italic' rel='stylesheet' type='text/css'>

	    <!-- jQuery -->
	    <script src='js/jquery.js'></script>

	</head>

	<body>
		<div class='brand' style='text-align: center;'> <img src='../img/img-logo.png'> </div>

	        <h1 class='page-header' style='text-align: center;'> Exame para detecção de cardiopatia </h1>

	        <br /> <br /> <br />

	        <h3 style='text-align: center'> Conforme os dados informados pelo paciente no preenchimento dos parâmetros: </h3>

	        <div id='wrapper'>
	            <div id='page-wrapper'>
	                <div class='container-fluid'>

                    <div class='row'>

                        <div class='col-lg-12' style='color: black;'>

                            <div class='col-lg-6' style='float: left; right: 150px;'>

                                <div>
                                    <img src='../ver_imagem_paciente.php?id_paciente=" . $_SESSION['codigo_paciente'] . "' style='vertical-align:middle; float: right; width: 300px; height: 300px;'>
                                </div>

                                <div class='row'>

                                    <div class='div_info'>
                                        
                                        <br /> 

                                        <span class='span_info'> Nome do paciente:" . " " . $nome_paciente . "</span> <br />
                                        <span class='span_info'> Gênero do paciente:" . " " . $genero_paciente . "</span> <br />
                                        <span class='span_info'> Idade do paciente:" . " " . $idade_paciente . "</span> <br />
                                        <span class='span_info'> Peso do paciente:" . " " . $peso_paciente . "</span> <br />
                                        <span class='span_info'> Altura do paciente:" . " " . $altura_paciente . "</span> <br />
                                        <span class='span_info'> O paciente é diabético?" . " " . $diabetico . "</span> <br />
                                        
                                        <span class='span_info'> Data de realização do exame:" . " " . $data_do_exame . "</span> <br />

                                    </div>

                                </div>

                                <br />

                                <div class='row' style='text-align: justify'>

                                	<div class='div_info'>

	                                <span> O paciente fuma? " . $fumar . "</span> <br />
	                                <span> O paciente bebe? " . $beber . "</span> <br />
	                                <span> O paciente tem estresse? " . $estresse . "</span> <br />
	                                <span> O paciente apresenta alguma anomalia ao fazer exercícios físicos? " . $anomalia . "</span> <br />
	                                <span> O paciente escreveu alguma observação? " . $observacoes . "</span> <br />

	                                <hr> "; 

									for($i = 0; $i < 7; $i ++) {

										$nome_sintoma = $_POST['cadNomeSintoma' . $i];
										$quantidade_sintoma = $_POST['cadQuantidadeSintoma' . $i];
										$data_sintoma = $_POST['cadDataSintoma'];
										$circunstancias_sintoma = $_POST['cadCircunstanciasSintoma' . $i];

										$html .= "<span> Sintoma: " . $nome_sintoma . "</span> <br />";	
										$html .= "<span> O paciente sente o sintoma com qual frequência? " . $quantidade_sintoma . "</span> <br />";
										$html .= "<span> Quando o paciente começou a apresentar o sintoma? " . $data_sintoma . "</span> <br />";
										$html .= "<span> Em quais ciscunstâncias o sintoma ocorre? " . $circunstancias_sintoma . "</span> <br />";
										
										$html .= "<hr> <br />";									

									}

									$html .= "<h3> Imagem do exame de ECG (eletrocardiograma) do paciente </h3> <br />";

									# Imagem do ECG do paciente
									$caminho = '../img/' . $_FILES['cadImagem']['name'];

									$html .= "
									<div>
                                    <img src='" . $caminho . "'style='vertical-align:middle; text-align: center; width: 800px; height: 600px;'>
                                	</div> <br />";

                                	$html .= "
                                	<div>

							            <hr>

							            <br />

							            <p style='text-align: center; font-size: 12pt;'> 

							                Copyright &copy; 2016 AHRM CDS Sistema de telemedicina de baixo custo - Todos os direitos reservados

							                <br />

							                Instituto Federal de Educação, Ciência e Tecnologia do Rio Grande do Norte

							                <br />

											RN 288, s/n, Nova Caicó | Caicó, RN | CEP: 59300-000

							            </p>

							        </div>";

									$html .= "</div>
								</div
                            </div>  
                        </div>
                    </div>
                </div>
	        </div>
        </div>
    </body>";

    # Instância da classe utilizada para transformar o formulario preenchido (exame) em PDF 
	$mpdf = new mPDF(); 
	$mpdf->SetDisplayMode('fullpage'); // Exibe o PDF em tela cheia.

	# WriteHTML é a função responsável por fazer a transformação
	$mpdf->WriteHTML($html);

	# Gera o PDF e exibe no navegador
	$mpdf->Output();

?>