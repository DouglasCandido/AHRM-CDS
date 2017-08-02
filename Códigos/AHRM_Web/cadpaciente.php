<?php 

    require_once("conexao.php");

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
    
    <title>AHRM CDS - Cadastro de Paciente</title>

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
            $('#escolher-foto').inputFileText( { text: 'Escolher foto do perfil' } );
        });
     
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
                <a class='navbar-brand' href='index.php' style='color: #fff; font-size: 16pt'>AHRM CDS</a>
            </div>

        </nav>
        <div id="page-wrapper">

            <div class="container-fluid">

                <div class="row">
                    <div class="col-lg-10">
                        <h1 class="page-header">
                            Cadastre-se! Nosso principal objetivo sempre será facilitar seu acesso à saúde!
                        </h1>
                        <ol class="breadcrumb" style="background-color: rgba(0, 0, 0, 0.8); position: relative; width: 100%; height: 100%;">
                            <li class="active" style="font-size: 16pt; color: white;">
                                <i class="fa fa-user" style="font-size: 30pt; color: blue;"></i> Cadastro de Paciente
                            </li>

                            <br /> <br />

                            <form name="cadPacienteForm" method="post" role="form" enctype="multipart/form-data" action="cadastro/cadastro_paciente.php">

                            <div class="form-group">
                                <label style="font-size: 12pt; color: white;">Nome</label>
                                <input type="text" class="form-control" name="cadNome" placeholder="Digite o seu nome completo" maxlength="50" required>                           
                            </div>

                            <div class="form-group" style="color: white;">
                                <label>Gênero</label style="font-size: 12pt; color: white;"> <br />
                                <input type="radio" name="cadGenero" value="Homem" required> Homem &nbsp;
                                <input type="radio" name="cadGenero" value="Mulher" required> Mulher <br />
                            </div>

                            <div class="form-group">
                                <label style="font-size: 12pt; color: white;">Peso</label>
                                <input type="text" class="form-control" name="cadPeso" placeholder="Digite o seu peso" maxlength="6" required>                           
                            </div>

                            <div class="form-group">
                                <label style="font-size: 12pt; color: white;">Altura</label>
                                <input type="text" class="form-control" name="cadAltura" placeholder="Digite a sua altura" maxlength="4" required>                           
                            </div>

                            <div class="form-group" style="color: white;">
                                <label>Diabético</label style="font-size: 12pt; color: white;"> <br />
                                <input type="radio" name="cadDiabetico" value="Sim" required> Sim &nbsp;
                                <input type="radio" name="cadDiabetico" value="Não" required> Não <br />
                            </div>

                            <div class="form-group">
                                <label style="font-size: 12pt; color: white;">Data de Nascimento</label>
                                <input type="date" class="form-control" name="cadData" required>
                            </div>

                            <div class="form-group">
                                <label style="font-size: 12pt; color: white;">CPF</label>
                                <input type="text" class="form-control" minlength="14" maxlength="14" name="cadCPF" placeholder="Digite o seu CPF (11 dígitos)" onkeypress="mascara(this, '###.###.###-##')" required>
                            </div>

                            <div class="form-group">
                                <label style="font-size: 12pt; color: white;">Senha</label>
                                <input class="form-control" type="password" name="cadSenha" minlength="8" maxlength="16" placeholder="Digite a sua senha" required>                             
                            </div>

                            <div class="form-group">
                                <label style="font-size: 12pt; color: white;">Email</label>
                                <input class="form-control" type="email" name="cadEmail" placeholder="Digite o seu email (ex: exemplo@hotmail.com)" maxlength="100" required>                          
                            </div>

                            <div class="form-group">
                                <label style="font-size: 12pt; color: white;">Telefone</label>
                                <input class="form-control" type="text" name="cadTelefone" minlength="12" maxlength="12" placeholder="Digite o seu telefone (ex: 84999550998)" onkeypress="mascara(this, '#######-####')" required>
                            </div>

                            <div class="form-group">
                                <label style="font-size: 12pt; color: white;">Estado</label>
                                <?php

                                    # Carrega os estados registrados no BD
                                    echo "<select class=\"form-control\" style=\"\" id=\"cadUf\" name=\"cadUf\" required>";
                                        
                                    $q = "select * from Uf;";
                                    $resultado = mysqli_query($conexao, $q) or die(mysqli_error($conexao));

                                    while(($uf = mysqli_fetch_array($resultado)) != null) {

                                        echo "<option value='$uf[sigla]'>$uf[sigla]</option>";

                                    }

                                    echo ("</select>");

                                ?>
                            </div>

                            <div class="form-group">
                                <label style="font-size: 12pt; color: white;">Cidade</label>
                                <input class="form-control" type="text" name="cadCidade" maxlength="30" placeholder="Digite o nome da sua cidade" required>
                            </div>

                            <div class="form-group">
                                <label style="font-size: 12pt; color: white;">Bairro</label>
                                <input class="form-control" type="text" name="cadBairro" maxlength="30" placeholder="Digite o nome do seu bairro" required>
                            </div>

                            <div class="form-group">
                                <label style="font-size: 12pt; color: white;">Rua</label>
                                <input class="form-control" type="text" name="cadRua" maxlength="30" placeholder="Digite o nome da sua rua" required>
                            </div>

                            <div class="form-group">
                                <label style="font-size: 12pt; color: white;">Número</label>
                                <input class="form-control" type="number" name="cadNumero" maxlength="4" placeholder="Digite o número da sua casa" required>
                            </div>

                            <div class="form-group"> 
                                <input name="cadImagem" id="escolher-foto" type="file" required> 
                            </div>

                            <input type="hidden" name="MAX_FILE_SIZE" value="999999999">
                        
                            <br />

                            <div style="text-align: right;">

                                <button type="submit" class="btn btn-success">Cadastrar</button>
                                <button type="reset" class="btn btn-primary">Limpar</button>

                            </div>

                        </form>

                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer style='position: absolute; top: 1550px; background-color: #CCC'>
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
