<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="utf-8">
<title>Qtde por secretaria - Stock</title>
</head>

<body>

<?php
require_once("verificaPermissao.class.php");
$permissoes = new verificaPermissao("verRelatorios");

include_once("PDOConnectionFactory.class.php");
echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"css/estilo.css\" />";

$codigo = $_GET['codigo'];

$conexao_db = new PDOConnectionFactory;

?>
<table border="1" style="border-collapse:collapse">
  <tr>
    <td colspan="4" align="center">Exibindo quantidade de itens por secretaria</strong></td>
  </tr>
<tr bgcolor="#999999">
    <td><strong>C&oacute;digo</strong></td>
    <td><strong>Descri&ccedil;&atilde;o</strong></td>
    <td><strong>Qtde</strong></td>
    <td><strong>Secretaria</strong></td>
  </tr>
<?php
try{
	$rs = $conexao_db->con->prepare("SELECT qtde, secretaria FROM itens_estoque WHERE codigo = ? AND qtde > 0");
	$rs->bindParam(1,$codigo);
	$rs->execute();
	
	$rsItem = $conexao_db->con->prepare("SELECT descricao FROM itens WHERE codigo = ?");
	$rsItem->bindParam(1,$codigo);
	$rsItem->execute();
	$rowItem = $rsItem->fetch(PDO::FETCH_OBJ);
	
	while($row = $rs->fetch(PDO::FETCH_OBJ)){
		echo "  <tr>
    <td>".$codigo."</td>
    <td>".$rowItem->descricao."</td>
    <td>".$row->qtde."</td>
    <td>".$row->secretaria."</td>
  </tr>";
}
	
}catch(PDOException $e){
	die("N&atilde;o foi poss&iacute;vel encontrar os itens desta entrada | <a href=\"entradas.php\">Voltar</a>");
}
?>
</table>

</body>
</html>