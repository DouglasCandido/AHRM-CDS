<?php 

    require_once("conexao.php");

    require_once("integridademedico.php");


    # Carrega todos os pedidos de vínculo para o médico logado
    $codigo_medico = $_SESSION['codigo_medico'];

    $q = "select * from pedido_vinculo where codigo_medico = $codigo_medico;";
    $resultado1 = mysqli_query($conexao, $q) or die(mysqli_error($conexao));
    $total = mysqli_num_rows($resultado1);

    if($total > 0) {

        $i = 0;

        while($dados = mysqli_fetch_array($resultado1)) {

            $i += 1;

            $codigo_paciente = $dados['codigo_paciente'];
            $pega_dados_paciente = "select codigo, nome_paciente, email_paciente, telefone, uf, cidade from paciente where codigo = $codigo_paciente;";
            $resultado2 = mysqli_query($conexao, $pega_dados_paciente) or die(mysqli_error($conexao));
            $informacao_paciente = mysqli_fetch_array($resultado2);
            $dados = $informacao_paciente;

            echo "<div class='col-lg-8' style='left: 33%;' id='divPedidoVinculo'>";

            echo "<div class='panel panel-info' style='width: 50%;' id='" . $i . "'>";
                echo "<div class='panel-heading'>
                    <center> Pedido de vínculo </center>
                    </div>
                <div class='panel-body'>";

                    echo "<p style='text-align: center'>"; 

                    include("ver_imagem_paciente_pesquisado.php");

                    echo "<div class='div_panel_body_info'>";
                        echo "<p> Nome: " . $informacao_paciente['nome_paciente'] . "</p>";
                        echo "<p> Email: " . $informacao_paciente['email_paciente'] . "</p>";
                        echo "<p> Telefone: " . $informacao_paciente['telefone'] . "</p>";
                        echo "<p> Estado: " . $informacao_paciente['uf'] . "</p>";
                        echo "<p> Cidade: " . $informacao_paciente['cidade'] . "</p>
                    </div>
                </div>";
                echo "<div class='panel-footer' style='text-align: center;'>";

                    echo "<form name='vinculoForm' method='post' role='form' action='confirmar_vinculo.php?codigo_paciente=" . $informacao_paciente['codigo'] . "'>"; 
                        echo "<span class='input-group-btn'>";
                            echo "<button class='btn btn-success' type='submit' name='btnDecisao' data-toggle='modal' data-target='#myModal' style='margin-right: 5px;' value='s'><i class='fa fa-heart'></i> Aceitar vínculo </button>";
                            echo "<button class='btn btn-danger' type='submit' name='btnDecisao' data-toggle='modal' data-target='#myModal' value='n'><i class='fa fa-times'></i> Declinar vínculo </button>
                        </span>    
                    </form>

                    </div>
                </div>";
            echo "</div>";

        }

    }
        
    else {

        echo "<br />";
        echo "<h3 style='text-align: center;'>";
        echo "Não há pedidos de vínculo para você.";
        echo "</h3>";

    }

?>