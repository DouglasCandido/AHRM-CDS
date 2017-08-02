<?php
  require_once("conexao.php");
  ?>
<!DOCTYPE html>
<html>
  <head lang="pt">
      <meta charset="UTF-8">
      <title>Armazenando imagens no banco de dados Mysql</title>
  </head>
  <body>

    <h2>Selecione um novo arquivo de imagem</h2>
     
    <form enctype="multipart/form-data" action="upload.php" method="post">
        <input type="hidden" name="MAX_FILE_SIZE" value="999999999"/>
        <div><input name="imagem" type="file"/></div>
        <div><input type="submit" value="Salvar"/></div>
    </form>

    <br />

    <table border="1">
        <tr>
            <td align="center">
                Código
            </td>
            <td align="center">
                Nome da imagem
            </td>
            <td align="center">
                Tamanho
            </td>
            <td align="center">
                Visualizar imagem
            </td>
            <td align="center">
                Excluir imagem
            </td>
		</tr>

    <?php
     
    $query = "select codigo, nome_imagem, tamanho_imagem from imagens_ondas_pacientes";
    $resultado = mysqli_query($conexao, $query) or die(mysqli_error($conexao));
		
		if($resultado) {
			
			printf("Sucesso ao fazer a consulta.");
			
		} else {
			
			printf("Erro: %s \n", mysqli_error($conexao));
			
		}
		
        while($arquivos = mysqli_fetch_array($resultado) or die(mysqli_error($conexao))) { ?>
		
			<tr>
				<td align="center">
					<?php echo $arquivos['codigo']; ?>
				</td>
				<td align="center">
					<?php echo $arquivos['nome_imagem']; ?>
				</td>
				<td align="center">
					<?php echo $arquivos['tamanho_imagem']; ?>
				</td>
				<td align="center">
					<?php echo '<a href="ver_imagem.php?codigo='.$arquivos['codigo'].'">Imagem '.$arquivos['codigo'].'</a>'; ?>
				</td>
				<td align="center">
					<?php echo '<a href="excluir_imagem.php?id='.$arquivos['codigo'].'">Imagem '.$arquivos['codigo'].'</a>'; ?>
				</td>
			</tr>

          <?php } ?>

    </table>

  </body>
</html>