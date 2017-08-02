<?php

    require_once("conexao.php");

    # Verifica se há cookies setados, pois se houver redirecionará para o index médico
    if(isset($_COOKIE["loginP"]) and !empty($_COOKIE["loginP"]) || isset($_COOKIE["senhaP"]) and !empty($_COOKIE["senhaP"])) {

        header("Location: indexpaciente.php");

    } 

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="icon" href="favicon.png" type="image/x-icon"/>
    
    <title>AHRM CDS - Login</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <script type="text/javascript">

    /*
    A função Mascara tera como valores no argumento os dados inseridos no input (ou no evento onkeypress)
    onkeypress="mascara(this, '## ####-####')"
    onkeypress = chama uma função quando uma tecla é pressionada, no exemplo acima, chama a função mascara e define os valores do argumento na função
    O primeiro valor é o this, é o Apontador/Indicador da Mascara, o '## ####-####' é o modelo / formato da mascara
    no exemplo acima o # indica os números, e o - (hifen) o caracter que será inserido entre os números, ou seja, no exemplo acima o telefone ficara assim: 11-4000-3562
    para o celular de são paulo o modelo deverá ser assim: '## #####-####' [11 98563-1254]
    para o RG '##.###.###.# [40.123.456.7]
    para o CPF '###.###.###.##' [789.456.123.10]
    Ou seja esta mascara tem como objetivo inserir o hifen ou espaço automáticamente quando o usuário inserir o número do celular, cpf, rg, etc 

    lembrando que o hifen ou qualquer outro caracter é contado tambem, como: 11-4561-6543 temos 10 números e 2 hifens, por isso o valor de maxlength será 12
    <input type="text" name="telefone" onkeypress="mascara(this, '## ####-####')" maxlength="12">
    neste código não é possivel inserir () ou [], apenas . (ponto), - (hifén) ou espaço
    */

    function mascara(t, mask) {

        var i = t.value.length;
        var saida = mask.substring(1,0);
        var texto = mask.substring(i)

        if (texto.substring(0,1) != saida){

            t.value += texto.substring(0,1);

        }

    }

    </script>

</head>

<body style="background-image: url('img/img-login2.jpg'); background-repeat: no-repeat; background-position: center top;">

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation" id="cor" style="background-color: #cc0000; opacity: 0.8;">

            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class='navbar-brand' href='index.php' style='color: #fff; font-size: 16pt'>AHRM CDS</a>
            </div>
        </nav>

        <ol class="breadcrumb" style="background-color: rgba(0, 0, 0, 0.7); width: 80%; position: relative; top: 50px;">

            <h1 class="page-header" style="color: white;">
                Entre em sua conta
            </h1>

            <li class="active" style="font-size: 16pt; color: white;">
                <i class="fa fa-user-md" style="font-size: 30pt; color: blue;"></i> Login do Médico
            </li>

            <br /> <br />

            <form name="formLoginMedico" method="post" role="form" action="login/autenticar_medico.php">
                <div class="form-group">
                    <label style="font-size: 12pt; color: white;">CPF</label>
                    <input type="text" class="form-control" minlength="14" maxlength="14" name="fLogin" placeholder="11 dígitos" onkeypress="mascara(this, '###.###.###-##')" required>
                </div>

                <div class="form-group">
                    <label style="font-size: 12pt; color: white;">Senha </label>
                    <input class="form-control" name="fSenha" placeholder="No mínimo 8 dígitos e no máximo 16 dígitos" minlength="8" maxlength="16" type="password" required>                             
                </div>

                <input type="radio" name="manter" value="s" style="position: relative; text-align: left; top: 30px; "> <span style="position: relative; top: 30px; font-size: 12pt; color: white;"> Mantenha-me conectado </span>

                <div style="text-align: right;">

                    <button type="submit" class="btn btn-success">Entrar</button>
                    <button type="reset" class="btn btn-primary">Limpar</button> <br /> <br />

                    <a href="cadmedico.php" id="cad" style="font-size: 14pt;">Ainda não é um usuário? Cadastre-se!</a>

                </div>
            </form>

        </ol>        
    </div>

    <footer style='position: absolute; top: 600px;'>
            <div class='container'>
                <div class='row'>
                    <div class='col-lg-12 text-center'>
                        <p>
                            Copyright &copy; 2016 AHRM CDS Sistema de telemedicina de baixo custo - Todos os direitos reservados

                            <br />

                            Instituto Federal de Educação, Ciência e Tecnologia do Rio Grande do Norte

                            <br />

                            RN 288, s/n, Nova Caicó | Caicó, RN | CEP: 59300-000
                        </p>
                    </div>
                </div>
            </div>
        </footer>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
