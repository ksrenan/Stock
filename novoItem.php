<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="css/estilo.css" />
<title>Novo Item - Stock</title>
</head>

<body>
<?php
include_once("menu.php");
require_once("verificaPermissao.class.php");
$permissoes = new verificaPermissao("cadItem");
include_once("item.class.php"); // Include da classe modelo
include_once("itemDAO.php");

if(isset($_POST['descricao'])){ // Se foi preenchido o campo descriÃ§Ã£o do item...

	$item = new Item; // Instanciando um objeto do tipo Item
	
	$item->setDescricao($_POST['descricao']);
	$item->setMarca($_POST['marca']);
	$item->setModelo($_POST['modelo']);
	if(isset($_POST['observacao'])){
		$item->setObservacao($_POST['observacao']);
	}else{
		$item->setObservacao("");
	}
	if(isset($_POST['patrimoniar']) && $_POST['patrimoniar'] == "true"){
		$item->setPatrimoniar(1);
	}else{
		$item->setPatrimoniar(0);
	}
	
	$itemDAO = new ItemDAO;
	$return = $itemDAO->insert($item);
	echo "<script>alert('".$return."');</script>";
}
?>
<form action="novoItem.php" method="post">
<table border="0" align="center" class="tabelaNovoUsuario">
<tr>
    <td align="right">Descri&ccedil;&atilde;o item:</td>
    <td><input name="descricao" type="text" required="required" autofocus="autofocus" /></td>
  </tr>
  <tr>
    <td align="right">Marca:</td>
    <td><input name="marca" type="text" required="required" /></td>
  </tr>
  <tr>
    <td align="right">Modelo:</td>
    <td><input name="modelo" type="text" required="required" /></td>
  </tr>
    <tr>
    <td align="right">Observa&ccedil;&atilde;o:</td>
    <td><textarea name="observacao" cols="40" rows="5"></textarea></td>
  </tr>
    <tr>
  <td colspan="2">Este item precisa ser patrimoniado?<input name="patrimoniar" id="patrimoniar" type="checkbox" value="true" /></td>
  </tr>
    <tr>
	<td colspan="2" align="right"><input type="submit" value="Salvar altera&ccedil;&otilde;es" class="botaoSalvar" /></td>
  </tr>
</table>

</form>
</body>
</html>