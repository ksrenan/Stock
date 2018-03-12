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
	$rs = $conexao_db->con->prepare("DELETE FROM saidas WHERE codigo_saida = ? ");
	$rs->bindParam(1,$codigo);
	$rs->execute();
	
	echo "<br><br><br><center>Registro de saida com codigo ".$codigo." Removido com Sucesso<br>Redirecionando...";
	header("Location:saidas.php");
}catch(PDOException $e){
	die("Nao foi possivel remover esta entrada | <a href=\"saidas.php\">Voltar</a>");
}
?>