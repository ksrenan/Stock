<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="css/estilo.css" />
<link rel="icon" type="image/png" href="img/Report.png" />
<title>Sa&iacute;das - Stock</title>
<script src="js/jquery-2.1.4.min.js"></script>
<script src="js/jquery.maskedinput.js"></script>
<script>
$(document).ready(function(e) { 
		$("#dataInicial").mask("99/99/9999");
		$("#dataFinal").mask("99/99/9999");
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
$matricula = $_COOKIE['usuario'];
?>
<div class="dv2">
<form action="saidas.php" method="post">
<center>
    <img src="img/busca.png" width="18" height="18" alt="Consultar" />
    Consulte as Sa&iacute;das pelo c&oacute;digo, descri&ccedil;&atilde;o: <input name="codigo" type="search" />
    ou por per&iacute;odo: De <input type="text" id="dataInicial" name="dataInicial" /> a <input type="text" id="dataFinal" name="dataFinal" />
    
    <input name="" type="submit" value="Consultar" style="background-color:#CCC" />
    
    
     <?php
    
    if((isset($_POST['dataInicial']) && $_POST['dataInicial'] != "") && (isset($_POST['dataFinal']) && $_POST['dataFinal'] != "")){
		$dataInicial = $_POST['dataInicial']; // 31/12/2015

		$periodoInicial = explode("/", $dataInicial);
		$diaInicial = $periodoInicial[0]; // Pega o dia Inicial
		$mesInicial = $periodoInicial[1]; // Pega o mes Inicial
		$anoInicial = $periodoInicial[2]; // Pega o Ano Inicial

		$dataInicialFormatada = $anoInicial."-".$mesInicial."-".$diaInicial;

		$dataFinal = $_POST['dataFinal']; // 31/12/2015

		$periodoFinal = explode("/", $dataFinal);
		$diaFinal = $periodoFinal[0]; // Pega o dia Final
		$mesFinal = $periodoFinal[1]; // Pega o mes Final
		$anoFinal = $periodoFinal[2]; // Pega o Ano Final

		$dataFinalFormatada = $anoFinal."-".$mesFinal."-".$diaFinal;


	 if ((isset($_POST['codigo']) && $_POST['codigo'] != "") && ((isset($_POST['dataInicial']) && $_POST['dataInicial'] != "") && (isset($_POST['dataFinal']) && $_POST['dataFinal'] != ""))){ //  Informa se a foi digitado algo na busca e no período
        //if((($anoInicial >= 2015) && ($mesInicial > 0 && $mesInicial <= 12)) && (($anoFinal >= 2015) && ($mesFinal > 0 && $mesFinal <= 12))){
            echo "<a id=\"verGrafico\" href=\"relatorioSaidas.php?item=".$_POST['codigo']."&dataInicial=".$dataInicialFormatada."&dataFinal=".$dataFinalFormatada."\">Ver relat&oacute;rio deste periodo</a>";
        }
    }
    ?>
    
    
    
    </center>
</form>
<table align="center" border="1" bordercolor="#CCCCCC" style="border-collapse: collapse" cellpadding="2" bgcolor="#F0F0F0">

<tr bgcolor="#999999">
<td><strong>C&oacute;digo Sa&iacute;da</strong></td>
<td><strong>Data</strong></td>
<td><strong>Hora</strong></td>
<td><strong>Usu&aacute;rio</strong></td>
<td><strong>C&oacute;d. Item</strong></td>
<td><strong>Qtde</strong></td>
<td><strong>Patrim&ocirc;nio</strong></td>
<td><strong>Descri&ccedil;&atilde;o</strong></td>
<td><strong>Marca</strong></td>
<td><strong>Modelo</strong></td>
<td><strong>Observa&ccedil;&atilde;o</strong></td>
<td><strong>Ordem Servi&ccedil;o</strong></td>
<td><strong>T&eacute;cnico que retirou</strong></td>
<td><strong>Sec. Origem</strong></td>
<td><strong>Sec. Destino</strong></td>
    
    <?php
    
    if($_COOKIE['usuario'] == 'Admin'){
        echo "<td><center><img src=\"img/remove.png\" width=\"17\" height=\"17\" /></center></td>";
    }

?>

</tr>
<?php

	if ((isset($_POST['codigo']) && $_POST['codigo'] != "") && ((isset($_POST['dataInicial']) && $_POST['dataInicial'] != "") && (isset($_POST['dataFinal']) && $_POST['dataFinal'] != ""))){ //  Informa se a foi digitado algo na busca e no período
		$codigo = $_POST['codigo'];
		$rs = $conexao_db->con->prepare("SELECT codigo_saida, DATE_FORMAT(data,'%d/%m/%Y') data, hora, usuario, codigo_item, qtde, patrimonio, descricao, marca, modelo, observacao, numeroOS, tecnicoRetirou, secretaria, secretaria_destino FROM saidas WHERE data BETWEEN '".$dataInicialFormatada."' AND '".$dataFinalFormatada."' AND descricao LIKE '%".$codigo."%' ");
		$rs->bindParam(1,$codigo);

	}else if (isset($_POST['codigo']) && $_POST['codigo'] != ""){ //  Informa se a foi digitado algo na busca
	   $codigo = $_POST['codigo'];
	   $rs = $conexao_db->con->prepare("SELECT codigo_saida, DATE_FORMAT(data,'%d/%m/%Y') data, hora, usuario, codigo_item, qtde, patrimonio, descricao, marca, modelo, observacao, numeroOS, tecnicoRetirou, secretaria, secretaria_destino FROM saidas WHERE codigo_saida = ? OR descricao LIKE '%".$codigo."%' ");
	$rs->bindParam(1,$codigo);

	}else if((isset($_POST['dataInicial']) && $_POST['dataInicial'] != "") && (isset($_POST['dataFinal']) && $_POST['dataFinal'] != "")){

        $rs = $conexao_db->con->query("SELECT codigo_saida, DATE_FORMAT(data,'%d/%m/%Y') data, hora, usuario, codigo_item, qtde, patrimonio, descricao, marca, modelo, observacao, numeroOS, tecnicoRetirou, secretaria, secretaria_destino FROM saidas WHERE data BETWEEN '".$dataInicialFormatada."' AND '".$dataFinalFormatada."'");
        
    }else{
		$rs = $conexao_db->con->query("SELECT codigo_saida, DATE_FORMAT(data,'%d/%m/%Y') data, hora, usuario, codigo_item, qtde, patrimonio, descricao, marca, modelo, observacao, numeroOS, tecnicoRetirou, secretaria, secretaria_destino FROM saidas WHERE MONTH(data) = MONTH(CURDATE()) AND YEAR(data) = YEAR(CURDATE())");
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
			
			echo "<tr bgcolor='".$cor."' align=\"center\">"; // Abre Linha Tabela
			echo "<td>".$row->codigo_saida."</td>";
			echo "<td>".$row->data."</td>";
			echo "<td>".$row->hora."</td>";
			
			$stmt = $conexao_db->con->query("SELECT nome FROM usuarios WHERE matricula = '".$row->usuario."'");
			$stmt->execute();
			$rsUsuario = $stmt->fetch(PDO::FETCH_OBJ);
			echo "<td>".$rsUsuario->nome."</td>";
			
			echo "<td>".$row->codigo_item."</td>";
			echo "<td>".$row->qtde."</td>";
			echo "<td>".$row->patrimonio."</td>";
			echo "<td>".$row->descricao."</td>";
			echo "<td>".$row->marca."</td>";
			echo "<td>".$row->modelo."</td>";
			echo "<td>".$row->observacao."</td>";
			echo "<td>".$row->numeroOS."</td>";
			echo "<td>".$row->tecnicoRetirou."</td>";
			echo "<td>".$row->secretaria."</td>";
			echo "<td>".$row->secretaria_destino."</td>";
			
            if($_COOKIE['usuario'] == 'Admin'){
			echo "<td><center><a href=\"deleteSaida.php?codigo=".$row->codigo_saida."\"><img src=\"img/delete.png\" width=\"16\" height=\"16\" /><br>Excluir</a></center></td>";
            }
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
