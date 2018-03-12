<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="utf-8">
<title>Altera&ccedil;&atilde;o de Senha - Stock</title>
<link rel="stylesheet" type="text/css" href="css/estilo.css" />
</head>

<body>
<form action="alterarSenha.php" method="post">
<table border="0" align="center">
  <tr>
    <td align="right">Nova senha:</td>
    <td><input name="novaSenha" type="password" required="required" /></td>
  </tr>
  <tr>
    <td align="right">Repita nova senha:</td>
    <td><input name="novaSenha2" type="password" required="required" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input name="" type="submit" value="Salvar" />
      <?php
        if($_COOKIE['usuario'] == 'Admin'){
            echo "<a href=\"usuarios.php\">Voltar</a>";
        }
        ?>
      
      </td>
  </tr>
</table>

</form>
</body>
</html>