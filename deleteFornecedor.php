<meta charset="utf-8">
<?php
require_once("verificaPermissao.class.php");
$permissoes = new verificaPermissao("cadFornecedor");

if($_COOKIE['usuario'] != 'Admin'){
        die("Sem permissao para excluir!");
    }

include_once("PDOConnectionFactory.class.php");
echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"css/estilo.css\" />";

$codigo = $_GET['codigo'];

$conexao_db = new PDOConnectionFactory;

$stmt = $conexao_db->con->prepare("DELETE FROM fornecedores WHERE codigo =?");
$stmt->bindParam(1,$codigo);
$stmt->execute();
echo "<br><br><br><center>Fornecedor com codigo ".$codigo." Removido com Sucesso<br>Redirecionando em 3 Segundos...";
header("Location:fornecedores.php");
?>