<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="css/estilo.css" />
<title>Alterar Item - Stock</title>
<?php
include_once("menu.php");
require_once("verificaPermissao.class.php");
$permissoes = new verificaPermissao("cadItem");
include_once("item.class.php"); // Include da classe modelo
include_once("itemDAO.php");

if(isset($_POST['descricao'])){ // Se foi preenchido o campo descricao do item...

	$item = new Item; // Instanciando um objeto do tipo Item
	
	$item->setCodigo($_POST['codigo']);
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
	$return = $itemDAO->update($item);
	echo "<script>alert('".$return."');
	location.href='itens.php';
	</script>";
}

?>
</head>

<body>
<table border="0" align="center" class="tabelaNovoUsuario" align="center">
<form action="alteraItem.php" method="post">
<?php

$codigo = NULL;
if(!empty($_GET['codigo'])){
$codigo = $_GET['codigo'];
if(is_numeric($codigo)){
include_once("PDOConnectionFactory.class.php");
$conexao_db = new PDOConnectionFactory;
$stmt = $conexao_db->con->prepare("SELECT * FROM itens WHERE codigo =?");
$stmt->bindParam(1,$codigo);
$stmt->execute();

if($stmt->rowCount() > 0){
	$row = $stmt->fetch(PDO::FETCH_OBJ);

	echo "<tr>
    <td align=\"right\">C&oacute;digo:</td>
    <td><input name=\"codigo\" type=\"text\" value=\"".$row->codigo."\" readonly=\"readonly\" /></td>
  </tr>
<tr>
    <td align=\"right\">Descri&ccedil;&atilde;o item:</td>
    <td><input name=\"descricao\" type=\"text\" required=\"required\" value=\"".$row->descricao."\" autofocus=\"autofocus\" /></td>
  </tr>
  <tr>
    <td align=\"right\">Marca:</td>
    <td><input name=\"marca\" type=\"text\" value=\"".$row->marca."\" required=\"required\" /></td>
  </tr>
  <tr>
    <td align=\"right\">Modelo:</td>
    <td><input name=\"modelo\" type=\"text\" value=\"".$row->modelo."\" required=\"required\" /></td>
  </tr>
    <tr>
    <td align=\"right\">Observa&ccedil;&atilde;o:</td>
    <td><textarea name=\"observacao\" cols=\"40\" rows=\"5\" >".$row->observacao."</textarea></td>
  </tr>
      <tr>
  <td colspan=\"2\">Este item precisa ser patrimoniado?<input name=\"patrimoniar\" id=\"patrimoniar\" type=\"checkbox\" value=\"true\" /></td>
  </tr>
    <tr>
	<td colspan=\"2\" align=\"right\"><input type=\"submit\" value=\"Salvar altera&ccedil;&otilde;es\" class=\"botaoSalvar\" /></td>
  </tr>";
}else{
	echo "<script>alert('Nenhum Fornecedor com esse codigo esta cadastrado no sistema.');window.location.href = \"itens.php\";</script>";
}
	
}else{
	die("<center><br><br><br><br>Este nao e um dado Numerico e nao pode ser um Codigo<br><br><a href=\"itens.php\">Voltar</a>");
	}
}else{
	die("<center><br><br><br><br>Campo codigo nao iniciado<br><br><a href=\"itens.php\">Voltar</a>");
	}
?>
<script>
	var patrimoniar = <?php echo json_encode($row->patrimoniar); ?>;
	if(patrimoniar == 1){document.getElementById("patrimoniar").checked = true;}
</script>
</form>
</table>
</body>
</html>