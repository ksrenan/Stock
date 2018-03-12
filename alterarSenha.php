<?php
$matricula = $_COOKIE['usuario'];

$novaSenha = $_POST['novaSenha'];
$novaSenha2 = $_POST['novaSenha2'];

if($novaSenha != $novaSenha2){
	echo "Senhas n&atilde;o conferem, por favor tente novamente.<br><br><br><a href=\"alteracaoSenha.php\">Voltar</a>";
}else{
	include("PDOConnectionFactory.class.php");
	$conexao_db = new PDOConnectionFactory; // Cria a conexao ja no construtor

	$rs = $conexao_db->con->prepare("UPDATE usuarios SET senha = ?, alterarSenha = 0 WHERE matricula = ?");
	$rs->bindParam(1,$novaSenha);
	$rs->bindParam(2,$matricula);
	$rs->execute();
	
	echo "<br><br><br><center>Senha alterada com Sucesso<br>Redirecionando em 3 Segundos...<meta http-equiv=\"refresh\" content=\"3;URL=itensEstoque.php\">";
	
}

?>