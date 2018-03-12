<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="css/estilo.css" />
<link rel="icon" type="image/png" href="img/Report.png" />
<title>Itens - Stock</title>
<link rel="stylesheet" href="css/jquery.superbox.css" type="text/css" media="all" />
<script type="text/javascript" src="js/jquery.min-1.3.2-google.js"></script>
<script type="text/javascript" src="js/jquery.superbox-min.js"></script>
<script type="text/javascript">
		$(function(){
			$.superbox.settings = {
				closeTxt: "Fechar",
				loadTxt: "Carregando Informa&ccedil;&otilde;es...",
				overlayOpacity: .8, // Background opaqueness
				boxWidth: "600", // Default width of the box
				boxHeight: "400", // Default height of the box
			};
			$.superbox();
		});
	</script>
</head>

<body>
<?php

include_once("PDOConnectionFactory.class.php");
$conexao_db = new PDOConnectionFactory; // Cria a conexao ja no construtor

require_once("verificaPermissao.class.php");
$permissoes = new verificaPermissao("verRelatorios");

include_once("menu.php");

?>
<div class="dv2">
<form action="itensEstoque.php" method="post">
<center>Consulte Itens pelo c&oacute;digo ou descri&ccedil;&atilde;o: <img src="img/busca.png" width="18" height="18" alt="Consultar" /><input name="codigo" type="search" />
<input name="" type="submit" value="Consultar" style="background-color:#CCC" /></center>
</form>
<table border="1" align="center" bordercolor="#CCCCCC" style="border-collapse: collapse" cellpadding="2" bgcolor="#F0F0F0">

<tr bgcolor="#999999">
<td><strong>C&oacute;digo</strong></td>
<td><strong>Descri&ccedil;&atilde;o</strong></td>
<td><strong>Marca</strong></td>
<td><strong>Modelo</strong></td>
<td><strong>Observa&ccedil;&atilde;o</strong></td>
<td><strong>Patrim&ocirc;nio</strong></td>
<td><strong>Quantidade</strong></td>
<td><strong>Por Secretaria</strong></td>
<td><center><img src="img/hand.png" width="17" height="17" /></center></td>
</tr>
<?php
		
	if (isset($_POST['codigo']) && $_POST['codigo'] != ""){ //  Informa se a foi digitado algo na busca

	$codigo = $_POST['codigo'];
	$rs = $conexao_db->con->prepare("SELECT codigo, SUM(qtde) qtde, secretaria FROM itens_estoque WHERE codigo = ? OR descricao LIKE '%".$codigo."%' GROUP BY codigo");
	$rs->bindParam(1,$codigo);

	}else{
		$rs = $conexao_db->con->query("SELECT codigo, SUM(qtde) qtde, secretaria FROM itens_estoque GROUP BY codigo");
	}
	
	$rs->execute();
	
	$i = 0; // Contador da Linhas
	
	if($rs->rowCount() > 0){
		while($row = $rs->fetch(PDO::FETCH_OBJ)){
			if($row->qtde > 0){
			if($i%2){
				$cor = "#E9E9E9";
			}else{
				$cor = "#FFFFFF";
			}
			
			echo "<tr bgcolor='".$cor."'>"; // Abre Linha Tabela
			echo "<td>".$row->codigo."</td>";
			
			// ------------------------------------------------------------------------------------------------------------------------
			$rsItem = $conexao_db->con->prepare("SELECT * FROM itens WHERE codigo = ?");
			$rsItem->bindParam(1,$row->codigo);
			$rsItem->execute();
			$rowItem = $rsItem->fetch(PDO::FETCH_OBJ);
			
			echo "<td>".$rowItem->descricao."</td>";
			echo "<td>".$rowItem->marca."</td>";
			echo "<td>".$rowItem->modelo."</td>";
			echo "<td>".$rowItem->observacao."</td>";
			if($rowItem->patrimoniar == 1){
			echo "<td>Bem dur&aacute;vel<br>Necessita patrim&ocirc;nio</td>";
			}else{
				echo "<td>Bem semi-dur&aacute;vel<br>N&atilde;o necessita patrim&ocirc;nio</td>";
			}
			// --------------------------------------------------------------------------------------------------------------------------
			echo "<td>".$row->qtde."</td>";
			echo "<td align=\"center\"><a href='itensPorSec.php?codigo=".$row->codigo."' rel='superbox[iframe]' title='Qtde por secretaria'>Por sec.</a></td>";
			
			echo "<td><center><a href=\"baixaItem.php?codigo=".$row->codigo."\">Retirar</a></center></td>";
			echo "</tr>"; // Fecha Linha Tabela
			$i++;
			} // Fecha IF se qtde Maior que zero
		} // Fecha While
		
//		echo "<center>Registros encontrados: <strong>".$rs->rowCount()."</strong></center>";
		echo "<center>Registros encontrados: <strong>".$i."</strong></center>";
		
	}else{ // Se linhas afetadas forem 0...
		echo "Nenhum Registro encontrado.<br>";
	}
?>
</table>
</div> <!-- Fecha Div dv2 -->
</body>
</html>
