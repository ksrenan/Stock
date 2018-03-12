<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="css/estilo.css" />
<link rel="icon" type="image/png" href="img/Report.png" />
<title>Itens - Stock</title>

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
<form action="itens.php" method="post">
<center>Consulte Itens pelo c&oacute;digo ou descri&ccedil;&atilde;o: <img src="img/busca.png" width="18" height="18" alt="Consultar" /><input name="codigo" type="search" />
<input name="" type="submit" value="Consultar" style="background-color:#CCC" /></center>
</form>
<table align="center" border="1" bordercolor="#CCCCCC" style="border-collapse: collapse" cellpadding="2" bgcolor="#F0F0F0">

<tr bgcolor="#999999">
<td><strong>C&oacute;digo</strong></td>
<td><strong>Descri&ccedil;&atilde;o</strong></td>
<td><strong>Marca</strong></td>
<td><strong>Modelo</strong></td>
<td><strong>Observa&ccedil;&atilde;o</strong></td>
<td><strong>Tipo de bem</strong></td>

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
	$rs = $conexao_db->con->prepare("SELECT * FROM itens WHERE codigo = ? OR descricao LIKE '%".$codigo."%'");
	$rs->bindParam(1,$codigo);

	}else{
		$rs = $conexao_db->con->query("SELECT * FROM itens");
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
			echo "<td>".$row->codigo."</td>";
			echo "<td>".$row->descricao."</td>";
			echo "<td>".$row->marca."</td>";
			echo "<td>".$row->modelo."</td>";
			echo "<td>".$row->observacao."</td>";
			
			if($row->patrimoniar == 1){
			echo "<td>Bem dur&aacute;vel<br>Necessita patrim&ocirc;nio</td>";
			}else{
				echo "<td>Bem semi-dur&aacute;vel<br>N&atilde;o necessita patrim&ocirc;nio</td>";
			}
			if($_COOKIE['usuario'] == 'Admin'){
			echo "<td><center><a href=\"deleteItem.php?codigo=".$row->codigo."\"><img src=\"img/delete.png\" width=\"16\" height=\"16\" /><br>Excluir</a></center></td>";
            }
			echo "<td><center><a href=\"alteraItem.php?codigo=".$row->codigo."\"><img src=\"img/edit_icon.png\" width=\"16\" height=\"16\" class=\"linkImg\" /><br>Alterar</a></center></td>";
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
 