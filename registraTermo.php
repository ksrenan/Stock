<?php
$nome = $_POST['nome'];
$matricula = $_POST['matricula'];
$cpf = $_POST['cpf'];
$secretaria = $_POST['secretaria'];
$depto_divisao = $_POST['depto_divisao'];
$local = $_POST['local'];
$_item = $_POST['_item'];
$patrimonio = $_POST['patrimonio'];
$nSuporte = $_POST['nSuporte'];

include_once("PDOConnectionFactory.class.php"); // include da classe de conexão

$conexao_db = new PDOConnectionFactory; // Criando conexão
		
try{
	$conexao_db = new PDOConnectionFactory;
	$stmt = $conexao_db->con->prepare("INSERT INTO termos(nome, matricula, cpf, secretaria, depto_divisao, local, item, patrimonio, nSuporte) VALUES (?,?,?,?,?,?,?,?,?)");
	$stmt->bindParam(1,$nome);
	$stmt->bindParam(2,$matricula);
	$stmt->bindParam(3,$cpf);
	$stmt->bindParam(4,$secretaria);
	$stmt->bindParam(5,$depto_divisao);
	$stmt->bindParam(6,$local);
	$stmt->bindParam(7,$_item);
	$stmt->bindParam(8,$patrimonio);
	$stmt->bindParam(9,$nSuporte);
	$stmt->execute();
	return("Termo registrado com Sucesso");
}catch(PDOException $ex){
	return("Erro no registro do Termo");
}
?>