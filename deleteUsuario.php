<meta charset="utf-8">
<?php
require_once("verificaPermissao.class.php");
$permissoes = new verificaPermissao("cadUsuario");

if($_COOKIE['usuario'] != 'Admin'){
        die("Sem permissao para excluir!");
    }

include_once("PDOConnectionFactory.class.php");
echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"css/estilo.css\" />";

$codigo = $_GET['codigo'];

$conexao_db = new PDOConnectionFactory;

$stmt = $conexao_db->con->prepare("DELETE FROM usuarios WHERE matricula =?");
$stmt->bindParam(1,$codigo);
$stmt->execute();
echo "<br><br><br><center>Usuario com matricula ".$codigo." Removido com Sucesso<br>Redirecionando em 3 Segundos...";
header("Location:usuarios.php");
?>