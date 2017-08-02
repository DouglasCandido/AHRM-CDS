<?php 

    require_once("conexao.php");

    # Pesquisa pelo médico e retorna uma resposta
    if(!empty($_POST)) {

        $busca = $_POST['fBusca'];

        $q = "select distinct codigo, nome_medico, email_medico, telefone, uf, cidade from medico where nome_medico like '%".$busca."%' or email_medico like '%".$busca."%' limit 1;";

        $resultado = mysqli_query($conexao, $q) or die(mysqli_error($conexao)); 

        $dados = mysqli_fetch_array($resultado);

        $total = mysqli_num_rows($resultado);

        if($total) {

            echo "<div class='col-lg-12'>
                <div class='panel panel-success'>
                    <div class='panel-heading'>
                        <center> Médico encontrado! </center>
                    </div>
                    <div class='panel-body'>";

                        echo "<p style='text-align: center'> <img height='350' width='350' src='ver_imagem_medico_pesquisado.php?id_medico=" . $dados['codigo'] . "'></p>

                        <br />";

                        echo "<div class='div_panel_body_info'>";
                            echo "<p> Nome: " . $dados['nome_medico'] . "</p>";
                            echo "<p> Email: " . $dados['email_medico'] . "</p>";
                            echo "<p> Telefone: " . $dados['telefone'] . "</p>";
                            echo "<p> Estado: " . $dados['uf'] . "</p>";
                            echo "<p> Cidade: " . $dados['cidade'] . "</p>
                        </div>
                    </div>";

                    echo "<div class='panel-footer' style='text-align: right;'>";

                        echo "<form name='vinculoForm' method='post' role='form'  action='pedido_vinculo.php?codigo_medico=" . $dados['codigo'] . "'>";

                                echo "<span class='input-group-btn'>
                                    <button class='btn btn-success' type='submit' name='btnVinculo' data-toggle='modal' data-target='#myModal'><i class='fa fa-heart'></i> Criar vínculo </button>
                                </span>
                        </form>

                    </div>
                </div>
            </div>";
            
        } 

        else {

            echo "<h3 style='position: absolute; top: -20px;'> A busca não retornou resultados. Pesquise por outro médico. </h3";

        }

    }

?> 
