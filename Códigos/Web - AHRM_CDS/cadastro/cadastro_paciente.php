<?php 

    require_once("../conexao.php");

    # Pega os dados submetidos pelo form
    $nome = $_POST['cadNome'];
    $genero = $_POST['cadGenero'];
    $peso = $_POST['cadPeso'];
    $altura = $_POST['cadAltura'];
    $diabetico = $_POST['cadDiabetico'];

    $data_de_nascimento = $_POST['cadData'];
    $time = strtotime($data_de_nascimento);
    $data_de_nascimento = date('Y-m-d', $time);

    $cpf = $_POST['cadCPF'];
    $email = $_POST['cadEmail'];
    $telefone = $_POST['cadTelefone'];
    $senha = $_POST['cadSenha'];
    $uf = $_POST['cadUf'];
    $cidade = $_POST['cadCidade'];
    $bairro = $_POST['cadBairro'];
    $rua = $_POST['cadRua'];
    $numero = $_POST['cadNumero'];

    $imagem = $_FILES['cadImagem']['tmp_name'];
    $tamanho = $_FILES['cadImagem']['size'];
    $tipo = $_FILES['cadImagem']['type'];
    $nome_imagem = $_FILES['cadImagem']['name'];

    # Insere na tabela
    if($imagem != null) {

        $arquivo = fopen($imagem, "rb");
        $conteudo = fread($arquivo, $tamanho);
        $conteudo = addslashes($conteudo);
        fclose($arquivo);

        $q = "insert into paciente(nome_paciente, cpf_paciente, email_paciente, telefone, senha, uf, cidade, bairro, rua, numero, genero, peso, altura, diabetico, data_de_nascimento, nome_imagem_perfil, tamanho_imagem_perfil, tipo_imagem_perfil, imagem_perfil) values('$nome', '$cpf', '$email', '$telefone', '$senha', '$uf', '$cidade', '$bairro', '$rua', $numero, '$genero', '$peso', '$altura', '$diabetico', '$data_de_nascimento','$nome_imagem', '$tamanho', '$tipo', '$conteudo');";

        $resultado = mysqli_query($conexao, $q);

        if($resultado) {

            header("Location: ../indexpaciente.php");

        } else {

            echo "Não foi possível realizar o cadastro. Erro: " . mysqli_error($conexao);

            exit;

        }
    }

?>
