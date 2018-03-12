<meta charset="utf-8">
<?php
include("PDOConnectionFactory.class.php");
echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"css/estilo.css\" />";

$codigo = $_POST['codigo']; // Usado so para atualizar dados na Tabela
$razaoSocial = $_POST['razaoSocial'];
$cnpj = $_POST['cnpj'];
$ie = $_POST['ie'];
$telefone = $_POST['telefone'];
$cep = $_POST['cep'];
$endereco = $_POST['endereco'];
$cidade = $_POST['cidade'];
$uf = $_POST['uf'];
$bairro = $_POST['bairro'];
$contato = $_POST['contato'];
$email = $_POST['email'];

$conexao_db = new PDOConnectionFactory;

try{
$stmt = $conexao_db->con->prepare("INSERT INTO fornecedores(razaoSocial, cnpj, ie, telefone, cep, endereco, cidade, uf, bairro, contato, email) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bindParam(1,$razaoSocial);
$stmt->bindParam(2,$cnpj);
$stmt->bindParam(3,$ie);
$stmt->bindParam(4,$telefone);
$stmt->bindParam(5,$cep);
$stmt->bindParam(6,$endereco);
$stmt->bindParam(7,$cidade);
$stmt->bindParam(8,$uf);
$stmt->bindParam(9,$bairro);
$stmt->bindParam(10,$contato);
$stmt->bindParam(11,$email);
$stmt->execute();
echo "<br><br><br><center>Fornecedor cadastrado com Sucesso<br>Redirecionando em 3 Segundos...";
header("Location:fornecedores.php");
}catch(PDOException $ex){
	die("Erro no cadastro do Fornecedor");
}
?>