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
    
    <title>AHRM CDS - Procurar médico</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">

    <!-- jQuery -->
    <script src="js/jquery.js"></script>
    <!-- Plugin JQuery AJAX form -->
    <script src="jquery.form.js"></script> 

    <script>

        // Utiliza AJAX para exibir o resultaddo, dinamicamente e sem atualização da página, da busca pelo médico
        $(document).ready(function() { 

            var options = { 
            target: '#resultado',   // target element(s) to be updated with server response 
            // beforeSubmit:  showRequest,  // pre-submit callback 
            success: showResponse  // post-submit callback 
     
            // other available options: 
            //url:       url         // override for form's 'action' attribute 
            //type:      type        // 'get' or 'post', override for form's 'method' attribute 
            //dataType:  null        // 'xml', 'script', or 'json' (expected server response type) 
            //clearForm: true        // clear all form fields after successful submit 
            //resetForm: true        // reset the form after successful submit 
     
            // $.ajax options can be used here too, for example: 
            //timeout:   3000 

            };   

            // bind 'myForm' and provide a simple callback function 
            $('#procurarForm').ajaxForm(options); 

        });

        // post-submit callback 
        function showResponse(responseText, statusText, xhr, $form)  { 

            // for normal html responses, the first argument to the success callback 
            // is the XMLHttpRequest object's responseText property 
         
            // if the ajaxForm method was passed an Options Object with the dataType 
            // property set to 'xml' then the first argument to the success callback 
            // is the XMLHttpRequest object's responseXML property 
         
            // if the ajaxForm method was passed an Options Object with the dataType 
            // property set to 'json' then the first argument to the success callback 
            // is the json data object returned by the server 
         
            /*
            alert('status: ' + statusText + '\n\nresponseText: \n' + responseText + 
                '\n\nThe output div should have already been updated with the responseText.');
            */

        }  

        /*
        // pre-submit callback 
        function showRequest(formData, jqForm, options) { 

            // formData is an array; here we use $.param to convert it to a string to display it 
            // but the form plugin does this for you automatically when it submits the data 
            var queryString = $.param(formData); 
         
            // jqForm is a jQuery object encapsulating the form element.  To access the 
            // DOM element for the form do this: 
            // var formElement = jqForm[0]; 
         
            alert('About to submit: \n\n' + queryString); 
         
            // here we could return false to prevent the form from being submitted; 
            // returning anything other than false will allow the form submit to continue 
            return true; 

        } 
        */

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
                    <a href="" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell sino" style="font-size: 20px; padding: 0px; margin: 0px; line-height: 50px;"></i> <b class="caret"></b></a>

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
                            Procure por um médico cadastrado em nosso sistema
                        </h1>

                        <div class="col-lg-6" style="float: left;">
                            <form name="procurarForm" id="procurarForm" method="post" role="form" action="resultado_procurar_medico.php">
                                <div class="form-group input-group">
                                    <input type="text" class="form-control" name="fBusca" maxlength="50" placeholder="Para pesquisar escreva corretamente o nome ou email do médico" required>
                                    <span class="input-group-btn">
                                        <button type="submit" class="btn btn-default" name="buscar"><i class="fa fa-search"></i></button>
                                    </span>
                                </div>
                            </form>
                        </div>

                        <div class="col-lg-6" style="float: right;" id="resultado">

                            

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
