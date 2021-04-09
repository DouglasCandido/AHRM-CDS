<?php 

	require_once("../conexao.php");

    # Biblioteca utilizada para transformar o formulario preenchido (laudo) em PDF
	include("mpdf60/mpdf.php");
	
	# Só quem tem acesso a essa página são os médicos logados 
	session_start();

	# Verifica se o médico está logado
    if(!isset($_SESSION["cpf_medico"]) and empty($_SESSION["cpf_medico"]) || !isset($_SESSION["senha_medico"]) and empty($_SESSION["senha_medico"])) {

        header("Location: ../loginmedico.php");

    }

    $codigo_medico = $_SESSION['codigo_medico'];

	$q1 = "select * from medico where codigo =" . $codigo_medico;
	$resultado1 = mysqli_query($conexao, $q1) or die(mysqli_error($conexao));
	$dados1 = mysqli_fetch_array($resultado1);

    # Recuperando os dados necessários para gerar o PDF do laudo:

	# Informações do médico: 
    $nome_medico = $dados1['nome_medico'];
    $crm_medico = $dados1['crm'];
    $email_medico = $dados1['email_medico'];
    # $assinatura_medico = $dados['assinatura']; Para uso futuro
    $telefone_medico = $dados1['telefone'];
    $estado_medico = $dados1['uf'];
    $cidade_medico = $dados1['cidade'];

    # Informações do exame:
    $codigo_exame_escolhido = $_POST['cadExameEscolhido'];
    $q2 = "select * from exame where codigo =" . $codigo_exame_escolhido;
	$resultado2 = mysqli_query($conexao, $q2) or die(mysqli_error($conexao));
	$dados2 = mysqli_fetch_array($resultado2);
	$data_do_exame = $dados2['data_do_exame'];
	$tipo_exame = $dados2['tipo_exame'];
	$descricao_exame = $dados2['descricao_exame'];

	# Informações do paciente: 
    $codigo_paciente = $dados2['codigo_paciente'];


    $q3 = "select * from paciente where codigo =" . $codigo_paciente;
	$resultado3 = mysqli_query($conexao, $q3) or die(mysqli_error($conexao));
	$dados3 = mysqli_fetch_array($resultado3);
    $nome_paciente = $dados3['nome_paciente'];
    $genero_paciente = $dados3['genero'];

    $current_date_time = new DateTime(date());
    $date_time_birth_date = new DateTime($dados3['data_de_nascimento']);
	$idade_paciente =  $current_date_time->format('Y') - $date_time_birth_date->format('Y');

    $peso_paciente = $dados3['peso'];
    $altura_paciente = $dados3['altura'];
    $diabetico = $dados3['diabetico'];

    # Informações do laudo:
    $data_do_laudo = $_POST['cadDataLaudo'];
    $diagnostico_laudo = $_POST['cadDiagnostico'];

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
	    
	    <title>AHRM CDS - Laudo médico sobre exame para detecção de cardiopatia</title>

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

	        <h1 class='page-header' style='text-align: center;'> Laudo médico sobre exame para detecção de cardiopatia </h1>

	        <br /> <br /> <br />

	        <h3 style='text-align: center'> Conforme os dados informados pelo médico no preenchimento dos campos: </h3>

	        <div id='wrapper'>
	            <div id='page-wrapper'>
	                <div class='container-fluid'>

                    <div class='row'>

                        <div class='col-lg-12' style='color: black;'>

                            <div class='col-lg-6' style='float: left; right: 150px;'>

								<div class='row'>

                                    <div class='div_info'>
                                        
                                        <br /> 

                                        <h3> Informações do exame e do laudo: </h3>
                                        <span class='span_info'> Data de recebimento do exame:" . " " . $data_do_exame . "</span> <br />
                                        <span class='span_info'> Tipo do exame:" . " " . $tipo_exame . "</span> <br />
                                        <span class='span_info'> Descrição do exame:" . " " . $descricao_exame . "</span> <br />
                                        <span class='span_info'> Data de realização do laudo:" . " " . $data_do_laudo . "</span> <br />
                                        <h4> Diagnóstico:" . " " . $diagnostico_laudo . "<h4> <br />

                                    </div>

                            	</div>

                                <hr>

                                <br />

                                <div class='row'>

                                    <div class='div_info'>

                                        <h3> Informações do paciente: </h3>
                                        <span class='span_info'> Nome do paciente:" . " " . $nome_paciente . "</span> <br />
                                        <span class='span_info'> Gênero do paciente:" . " " . $genero_paciente . "</span> <br />
                                        <span class='span_info'> Idade do paciente:" . " " . $idade_paciente . "</span> <br />
                                        <span class='span_info'> Peso do paciente:" . " " . $peso_paciente . "</span> <br />
                                        <span class='span_info'> Altura do paciente:" . " " . $altura_paciente . "</span> <br />
                                        <span class='span_info'> O paciente é diabético?" . " " . $diabetico . "</span> <br />

                                    </div>

                                </div>

                                <hr>

                                <br />

                                <div class='row' style='text-align: justify'>

                                	<div class='div_info' style='text-align: center;'>

                                		<span class='span_info'> Nome do médico:" . " " . $nome_medico . "</span> <br />
                                        <span class='span_info'> CRM do médico:" . " " . $crm_medico . "</span> <br />
										<span class='span_info'> Email do médico:" . " " . $email_medico . "</span> <br />
                                        <span class='span_info'> Telefone do médico:" . " " . $telefone_medico . "</span> <br />
                                        <span class='span_info'> Estado do médico:" . " " . $estado_medico . "</span> <br />
                                        <span class='span_info'> Cidade do médico:" . " " . $cidade_medico . "</span> <br />

							    </div>";


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

