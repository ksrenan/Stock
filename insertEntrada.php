<meta charset="utf-8">
<?php
include_once("PDOConnectionFactory.class.php");
echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"css/estilo.css\" />";
$nf = $_POST['nf'];
$requisicao = $_POST['requisicao'];
$empenho = $_POST['empenho'];
$fornecedor = $_POST['fornecedor'];
$secretaria = $_POST['secretaria'];


$dataEmissaoPT_BR = explode("/", $_POST['dataEmissao']);
$dataEmissao = $dataEmissaoPT_BR[2]."/".$dataEmissaoPT_BR[1]."/".$dataEmissaoPT_BR[0]; // Ano/Mes/Data


$dataEntregaPT_BR = explode("/", $_POST['dataEntrega']);
$dataEntrega = $dataEntregaPT_BR[2]."/".$dataEntregaPT_BR[1]."/".$dataEntregaPT_BR[0]; // Ano/Mes/Data


$itens = $_POST['ListaItensAdicionados'];
//print_r ($itens);

if(strcmp($nf, "Sem Nota Fiscal") == 0){
	$fornecedor = "Sem Fornecedor";
}

$usuario = $_COOKIE['usuario'];

try{
$conexao_db = new PDOConnectionFactory;
$stmt = $conexao_db->con->prepare("INSERT INTO entradas(usuario, nf, empenho, requisicao, fornecedor, secretaria, data_emissao, data_entrega) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bindParam(1,$usuario);
$stmt->bindParam(2,$nf);
$stmt->bindParam(3,$empenho);
$stmt->bindParam(4,$requisicao);
$stmt->bindParam(5,$fornecedor);
$stmt->bindParam(6,$secretaria);
$stmt->bindParam(7,$dataEmissao);
$stmt->bindParam(8,$dataEntrega);
$stmt->execute();

$id = $conexao_db->con->query("SELECT codigo_entrada FROM entradas ORDER BY codigo_entrada DESC LIMIT 1");
$codigo_entrada = $id->fetch(PDO::FETCH_OBJ);
echo "cÃ³digo do insert: ".$codigo_entrada->codigo_entrada;

for($i=0; $i<count($itens); $i++){
	
/*	$arrayItem = explode("-", $itens[$i]);
	$codItem = $arrayItem[0];
	$arrayItemQtde = explode("|", $arrayItem[1]);
	$nomeItem = $arrayItemQtde[0];
	$qtdeItem = $arrayItemQtde[1]; */
    
    $arrayItem = explode("|", $itens[$i]);
	$codItem = $arrayItem[0];
	$qtdeItem = $arrayItem[1];
    
    $query = $conexao_db->con->query("SELECT descricao FROM itens WHERE codigo = '".$codItem."' ");
    $query->execute();
    $rsQuery = $query->fetch(PDO::FETCH_OBJ);
	
	$stmt = $conexao_db->con->prepare("INSERT INTO itens_entrada(codigo, descricao, qtde, codigo_entrada, secretaria) VALUES (?, ?, ?, ?, ?)");
	$stmt->bindParam(1,$codItem);
    $stmt->bindParam(2,$rsQuery->descricao); // --------------------------------------
	$stmt->bindParam(3,$qtdeItem);
	$stmt->bindParam(4,$codigo_entrada->codigo_entrada);
	$stmt->bindParam(5,$secretaria);
	$stmt->execute();
}
}catch(PDOException $e){
	die("Erro na insercao dos itens");
}
try{
	
	$verifica = $conexao_db->con->query("SELECT codigo, secretaria FROM itens_estoque");
	$encontrado = NULL;
	
	
	for($i=0; $i<count($itens); $i++){
		
		/*$arrayItem = explode("-", $itens[$i]);
		$codItem = $arrayItem[0];
		$arrayItemQtde = explode("|", $arrayItem[1]);
		$nomeItem = $arrayItemQtde[0];
		$qtdeItem = $arrayItemQtde[1];*/
        
        $arrayItem = explode("|", $itens[$i]);
		$codItem = $arrayItem[0];
		$qtdeItem = $arrayItem[1];
        
        
        $encontrado = NULL;
		
		while($codigos_estoque = $verifica->fetch(PDO::FETCH_OBJ)){
			if($codigos_estoque->codigo == $codItem && $codigos_estoque->secretaria == $secretaria){
				$encontrado = true;
			}
		}
		
		if($encontrado == true){
			$stmt = $conexao_db->con->prepare("UPDATE itens_estoque SET qtde=qtde+? WHERE codigo=? AND secretaria=?");
			$stmt->bindParam(1,$qtdeItem);
			$stmt->bindParam(2,$codItem);
			$stmt->bindParam(3,$secretaria);
			$stmt->execute();
		}else{
            $query = $conexao_db->con->query("SELECT descricao FROM itens WHERE codigo = '".$codItem."' ");
            $query->execute();
            $rsQuery = $query->fetch(PDO::FETCH_OBJ);
            
			$stmt = $conexao_db->con->prepare("INSERT INTO itens_estoque(codigo, descricao, qtde, secretaria) VALUES (?,?,?,?)");
			$stmt->bindParam(1,$codItem);
			$stmt->bindParam(2,$rsQuery->descricao); // --------------------------------------
			$stmt->bindParam(3,$qtdeItem);
			$stmt->bindParam(4,$secretaria);
			$stmt->execute();
		}
	}
    echo "<br><br><br><center>Entrada Registrada com Sucesso<br>Redirecionando em 3 Segundos...";
    header("Location:itensEstoque.php");
}catch(PDOException $e){
	die("Erro na insercao dos itens no Estoque");
}

echo "<a href=\"novaEntrada.php\">Voltar</a>";
?>