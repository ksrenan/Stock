<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="css/estilo.css" />
<link rel="icon" type="image/png" href="img/Report.png" />
<title>Termos de Responsabilidade - Stock</title>
<?php
include_once("PDOConnectionFactory.class.php");
$conexao_db = new PDOConnectionFactory; // Cria a conexÃ£o ja no construtor

require_once("verificaPermissao.class.php");
$permissoes = new verificaPermissao("verRelatorios");

include_once("menu.php");
?>
</head>

<body>
<div class="dv2">
<form action="termos.php" method="post">
<center>Consulte Termo pelo patrimonio ou nome do usu&aacute;rio: <img src="img/busca.png" width="18" height="18" alt="Consultar" /><input name="codigo" type="search" />
<input name="" type="submit" value="Consultar" style="background-color:#CCC" /></center>
</form>
<table border="1" bordercolor="#CCCCCC" style="border-collapse: collapse" cellpadding="2" bgcolor="#F0F0F0" align="center">
<tr bgcolor="#999999">
<td><strong>Nome</strong></td>
<td><strong>Matricula</strong></td>
<td><strong>CPF</strong></td>
<td><strong>Secretaria</strong></td>
<td><strong>Depto/Divisao</strong></td>
<td><strong>Local</strong></td>
<td><strong>Item</strong></td>
<td><strong>Patrimonio</strong></td>
<td><strong>N&ordm; Controle Suporte</strong></td>
     <?php

if($_COOKIE['usuario'] == 'Admin'){
    echo "<td><center><img src=\"img/remove.png\" width=\"17\" height=\"17\" /></center></td>";
}
?>
<td><center><img src="img/alterar.png" width="17" height="17" /></center></td>
</tr>
<?php
		
	if (isset($_POST['codigo']) && $_POST['codigo'] != ""){ //  Informa se a foi digitado algo na busca
	$codigo = $_POST['codigo'];
	$rs = $conexao_db->con->prepare("SELECT id, nome, matricula, cpf, secretaria, depto_divisao, local, item, patrimonio, nSuporte FROM termos WHERE patrimonio = ? OR nome LIKE '%".$codigo."%' ");
	$rs->bindParam(1,$codigo);

	}else{
		$rs = $conexao_db->con->query("SELECT * FROM termos");
	}
	
	$rs->execute();
	
	$i = 0; // Contador da Linhas
	
	if($rs->rowCount() > 0){
		while($row = $rs->fetch(PDO::FETCH_OBJ)){
			if($i%2){
				$cor = "#E9E9E9";
			}else{
					$cor = "#FFFFFF";
			}
			
			echo "<tr bgcolor='".$cor."'>"; // Abre Linha Tabela
			echo "<td>".$row->nome."</td>";
			echo "<td>".$row->matricula."</td>";
			echo "<td>".$row->cpf."</td>";
			echo "<td>".$row->secretaria."</td>";
			echo "<td>".$row->depto_divisao."</td>";
			echo "<td>".$row->local."</td>";
			echo "<td>".$row->item."</td>";
			echo "<td>".$row->patrimonio."</td>";
			echo "<td>".$row->nSuporte."</td>";
            if($_COOKIE['usuario'] == 'Admin'){
			echo "<td><center><a href=\"deleteTermo.php?codigo=".$row->id."\"><img src=\"img/delete.png\" width=\"16\" height=\"16\" /><br>Excluir</a></center></td>";
            }
			echo "<td><center><a href=\"alteraTermo.php?codigo=".$row->id."\"><img src=\"img/edit_icon.png\" width=\"16\" height=\"16\" class=\"linkImg\" /><br>Alterar</a></center></td>";
			echo "</tr>"; // Fecha Linha Tabela
			$i++;
		} // Fecha While
		
		echo "<center>Registros encontrados: <strong>".$rs->rowCount()."</strong></center>";
		
	}else{ // Se linhas afetadas forem 0...
		echo "Nenhum Registro encontrado.<br>";
	}
?>
</table>
</div> <!-- Fecha Div dv2 -->
</body>
</html>