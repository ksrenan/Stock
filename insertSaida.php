<meta charset="utf-8">
<?php
$codigo_entrada = $_POST['codigo_entrada'];
$codigo_item = $_POST['item'];
$qtde = $_POST['qtde'];
$patrimonio = $_POST['patrimonio'];


include_once("PDOConnectionFactory.class.php");
echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"css/estilo.css\" />";

try{
$conexao_db = new PDOConnectionFactory;

$stmt = $conexao_db->con->prepare("INSERT INTO saidas(data, hora, usuario, codigo_entrada, codigo_item, qtde, patrimonio) VALUES (CURDATE(), CURTIME(), ?, ?, ?, ?, ?)");
$stmt->bindParam(1,$_COOKIE['usuario']);
$stmt->bindParam(2,$codigo_entrada);
$stmt->bindParam(3,$codigo_item);
$stmt->bindParam(4,$qtde);
$stmt->bindParam(5,$patrimonio);
$stmt->execute();
$rs = $conexao_db->con->prepare("SELECT codigo, nome FROM itens WHERE codigo = ?");
$rs->bindParam(1,$codigo_item);
$rs->execute();

$result = $rs->fetch(PDO::FETCH_OBJ);

echo "Saida do item <strong>".$result->nome."</strong> registrado com Sucesso.";
}catch(PDOException $e){
	die("Erro no registro desta saida!");
}
echo "<meta http-equiv=\"refresh\" content=3;url=\"saidas.php\">";
?>