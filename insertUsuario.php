<?php
include("PDOConnectionFactory.class.php");
echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"css/estilo.css\" />";
$matricula = $_POST['matricula'];
$nome = $_POST['nome'];
$senha = $_POST['senha'];

$arrayNivelAcesso = array();
if(!empty($_POST['nivelAcesso'])) {
    foreach($_POST['nivelAcesso'] as $check) {
           array_push($arrayNivelAcesso, $check);
    }
}
$nivelAcesso = implode("|", $arrayNivelAcesso);

$alterarSenha = $_POST['alterarSenha'];
try{
$conexao_db = new PDOConnectionFactory;
$stmt = $conexao_db->con->prepare("INSERT INTO usuarios(matricula, nome, senha, nivelAcesso, alterarSenha) VALUES(?, ?, ?, ?, ?)");
$stmt->bindParam(1,$matricula);
$stmt->bindParam(2,$nome);
$stmt->bindParam(3,$senha);
$stmt->bindParam(4,$nivelAcesso);
$stmt->bindParam(5,$alterarSenha);
$stmt->execute();
echo "<br><br><br><center>Usuario cadastrado com Sucesso<br>Redirecionando em 3 Segundos...<meta http-equiv=\"refresh\" content=\"3;URL=menu.php\">";
}catch(PDOException $ex){
	echo "Erro na Insercao";
}

?>