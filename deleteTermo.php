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
	$rs = $conexao_db->con->prepare("DELETE FROM termos WHERE id = ? ");
	$rs->bindParam(1,$codigo);
	$rs->execute();
	header("Location: termos.php");
}catch(PDOException $e){
	echo "<script>
	alert('Erro ao deletar este Termo de Responsabilidade!');
	location.href='termos.php';
	</script>";
}
?>