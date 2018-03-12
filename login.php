<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="css/estilo.css" />
<link rel="icon" href="img/autenticacao.png">
<title>Autentica&ccedil;&atilde;o - Stock</title>
</head>

<body>
<form action="autenticacao.php" method="post">
<table border="0" class="tabelaAutenticacao" align="center">
  <tr>
    <td><img src="img/autenticacao.png" /></td>
    <td><p style="font-size:50px; font-weight:bold">Stock</p></td>
  </tr>
  <tr>
    <td align="right">Matr&iacute;cula:</td>
    <td><input name="matricula" type="text" autofocus required="required" /></td>
  </tr>
  <tr>
    <td align="right">Senha:</td>
    <td><input name="senha" type="password" required="required" /></td>
  </tr>
  <tr>
    <td></td>
    <td align="right"><input type="submit" value="Entrar" class="botaoEntrar" /></td>
  </tr>
</table>

</form>
</body>
</html>