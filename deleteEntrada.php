<meta charset="utf-8">
<?php
require_once("verificaPermissao.class.php");
$permissoes = new verificaPermissao("verRelatorios");

if($_COOKIE['usuario'] != 'Admin'){
        die("Sem permissao para excluir!");
    }

include_once("PDOConnectionFactory.class.php");
echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"css/estilo.css\" />";

$codigo = $_GET['codigo'];

$conexao_db = new PDOConnectionFactory;

try{
	$result = $conexao_db->con->prepare("SELECT codigo, qtde, secretaria FROM itens_entrada WHERE codigo_entrada = ? ");
	$result->bindParam(1,$codigo);
	$result->execute();
	
	while($row = $result->fetch(PDO::FETCH_OBJ)){
		$stmt2 = $conexao_db->con->prepare("UPDATE itens_estoque SET qtde=qtde-? WHERE codigo=? AND secretaria=?");
		$stmt2->bindParam(1,$row->qtde);
		$stmt2->bindParam(2,$row->codigo);
		$stmt2->bindParam(3,$row->secretaria);
		$stmt2->execute();
	}
	
	$rs = $conexao_db->con->prepare("DELETE FROM itens_entrada WHERE codigo_entrada = ? ");
	$rs->bindParam(1,$codigo);
	$rs->execute();
	
	$stmt = $conexao_db->con->prepare("DELETE FROM entradas WHERE codigo_entrada = ? ");
	$stmt->bindParam(1,$codigo);
	$stmt->execute();
	
	
	
	echo "<br><br><br><center>Entrada com codigo ".$codigo." Removido com Sucesso<br>Redirecionando...";
	header("Location:entradas.php");
}catch(PDOException $e){
	die("Nao foi possivel remover esta entrada | <a href=\"entradas.php\">Voltar</a>");
}
// Faz correcao das quantidades se elas ficarem menores que Zero!
try{
	$set = $conexao_db->con->prepare("DELETE FROM itens_estoque WHERE qtde <= 0");
	$set->execute();
}catch(PDOException $e){
	echo "<script>alert('Erro na correcao dos campos de quantidade!');</script>";
}
?>