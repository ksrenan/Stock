<!DOCTYPE html>
<html lang="pt-br">
<meta charset="utf-8">
<script language="javascript" type="text/javascript">
function gerarTermo(codigoItem, patrimonio){
	decisao = confirm("Retirada do item registrado com sucesso.\nGerar Termo de responsabilidade?");
	if (decisao){
	    location.href="geraTermo.php?codigoItem="+codigoItem+"&patrimonio="+patrimonio;
	} else {
	    location.href="itensEstoque.php";
	}
}
</script>

<?php
require_once("verificaPermissao.class.php");
$permissoes = new verificaPermissao("regSaida");

include_once("PDOConnectionFactory.class.php");
echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"css/estilo.css\" />";

$conexao_db = new PDOConnectionFactory;

$codigo = $_POST['codigo'];
$descricao = $_POST['descricao'];
$marca = $_POST['marca'];
$modelo = $_POST['modelo'];
$observacao = $_POST['observacao'];

	$rs = $conexao_db->con->prepare("SELECT qtde FROM itens_estoque WHERE codigo=?");
	$rs->bindParam(1,$codigo);
	$rs->execute();
	$row = $rs->fetch(PDO::FETCH_OBJ);
	
$qtde = $_POST['qtde'];

	if($qtde > $row->qtde){
		die("Nao e possivel retirar a quantidade solicitada para este item, por favor <a href=\"baixaItem.php?codigo=".$codigo."\">Tente novamente</a>");
	}

$os = $_POST['os'];

if(isset($_POST['patrimonio'])){
	$patrimonio = $_POST['patrimonio'];
}else{
	$patrimonio = "";
}

$tecnico_retirou = $_POST['tecnico_retirou'];

$secretaria = $_POST['secretaria'];
$secretariaDestino = $_POST['secretaria_destino'];

try{
	$stmt = $conexao_db->con->prepare("INSERT INTO saidas (data, hora, usuario, codigo_item, qtde, patrimonio, descricao, marca, modelo, observacao, numeroOS, tecnicoRetirou, secretaria, secretaria_destino) VALUES (CURDATE(), CURTIME(), ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
	$stmt->bindParam(1,$_COOKIE['usuario']);
	$stmt->bindParam(2,$codigo);
	$stmt->bindParam(3,$qtde);
	$stmt->bindParam(4,$patrimonio);
	$stmt->bindParam(5,$descricao);
	$stmt->bindParam(6,$marca);
	$stmt->bindParam(7,$modelo);
	$stmt->bindParam(8,$observacao);
	$stmt->bindParam(9,$os);
	$stmt->bindParam(10,$tecnico_retirou);
	$stmt->bindParam(11,$secretaria);
	$stmt->bindParam(12,$secretariaDestino);
	$stmt->execute();
	
	echo "<br><br><br><center>Saida de item com codigo ".$codigo." registrado com Sucesso<br>";
	
	$stmt2 = $conexao_db->con->prepare("UPDATE itens_estoque SET qtde=qtde-? WHERE codigo=? AND secretaria=?");
	$stmt2->bindParam(1,$qtde);
	$stmt2->bindParam(2,$codigo);
	$stmt2->bindParam(3,$secretaria);
	$stmt2->execute();// Decrementar quantidade deste item no estoque
	
	if($patrimonio != ""){
		echo "<script language=\"javascript\" type=\"text/javascript\">gerarTermo(".$codigo.",".$patrimonio.");</script>";
	}else{
		echo "<script language=\"javascript\" type=\"text/javascript\">
		alert('Retirada do item registrado com sucesso.');
		location.href=\"itensEstoque.php\";
		</script>";
	}
	
	//header("Location:itensEstoque.php");
}catch(PDOException $e){
	die("Nao foi possivel remover esta saida | <a href=\"saidas.php\">SaÃ­das</a>");
}
?>ht