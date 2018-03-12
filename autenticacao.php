<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<?php
echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"css/estilo.css\" />";
$matricula = $_POST['matricula'];
$senha = $_POST['senha'];

include("PDOConnectionFactory.class.php");
$conexao_db = new PDOConnectionFactory; // Cria a conexão já no construtor

$rs = $conexao_db->con->prepare("SELECT matricula, senha, alterarSenha FROM usuarios WHERE matricula = ? AND senha = ?");
$rs->bindParam(1,$matricula);
$rs->bindParam(2,$senha);
$rs->execute();

if($rs->rowCount() > 0){
	setcookie("usuario", $matricula);
	$row = $rs->fetch(PDO::FETCH_OBJ);
	$alterarSenha = $row->alterarSenha;
	if($alterarSenha == 1){
		echo "<meta http-equiv=\"refresh\" content=\"0;URL=alteracaoSenha.php\">";
	}else{
		echo "<meta http-equiv=\"refresh\" content=\"0;URL=itensEstoque.php\">";
	}
}else{
	echo "<br><br><br><br><br><br><br><center>Falha na Autenticação, por favor tente novamente.<br><br><a href=\"login.php\" autofocus >Voltar</a>";
}

?>   