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
$stmt = $conexao_db->con->prepare("UPDATE usuarios SET nome=?, senha=?, nivelAcesso=?, alterarSenha=? WHERE matricula=?");
$stmt->bindParam(1,$nome);
$stmt->bindParam(2,$senha);
$stmt->bindParam(3,$nivelAcesso);
$stmt->bindParam(4,$alterarSenha);
$stmt->bindParam(5,$matricula);
$stmt->execute();
echo "<br><br><br><center>Informacaes de usuario alteradas com Sucesso<br>Redirecionando em 3 Segundos...";
header("Location:usuarios.php");
}catch(PDOException $ex){
	echo "Erro na Insercao";
}
?>