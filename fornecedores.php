<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="css/estilo.css" />
<link rel="icon" type="image/png" href="img/Report.png" />
<title>Fornecedores - Stock</title>
<?php
include_once("PDOConnectionFactory.class.php");
$conexao_db = new PDOConnectionFactory; // Cria a conex&atilde;o jÃ¡ no construtor

require_once("verificaPermissao.class.php");
$permissoes = new verificaPermissao("verRelatorios");

include_once("menu.php");
?>
</head>

<body>
<?php


$matricula = $_COOKIE['usuario'];

?>
<div class="dv2">
<form action="fornecedores.php" method="post">
<center>Consulte Fornecedor pelo c&oacute;digo ou pela raz&atilde;o social: <img src="img/busca.png" width="18" height="18" alt="Consultar" /><input name="codigo" type="search" />
<input name="" type="submit" value="Consultar" style="background-color:#CCC" /></center>
</form>
<table border="1" bordercolor="#CCCCCC" style="border-collapse: collapse;" cellpadding="2" bgcolor="#F0F0F0" align="center">

<tr bgcolor="#999999">
<td><strong>C&oacute;digo</strong></td>
<td><strong>Raz&atilde;o Social</strong></td>
<td><strong>CNPJ</strong></td>
<td><strong>Insc. Estadual</strong></td>
<td><strong>Telefone</strong></td>
<td><strong>CEP</strong></td>
<td><strong>Endere&ccedil;o</strong></td>
<td><strong>Cidade</strong></td>
<td><strong>UF</strong></td>
<td><strong>Bairro</strong></td>
<td><strong>Contato</strong></td>
<td><strong>E-Mail</strong></td>
    
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
	$rs = $conexao_db->con->prepare("SELECT * FROM fornecedores WHERE codigo = ? OR razaoSocial LIKE '%".$codigo."%' ");
	$rs->bindParam(1,$codigo);

	}else{
		$rs = $conexao_db->con->query("SELECT * FROM fornecedores");
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
			echo "<td>".$row->razaoSocial."</td>";
			echo "<td>".$row->cnpj."</td>";
			echo "<td>".$row->ie."</td>";
			echo "<td>".$row->telefone."</td>";
			echo "<td>".$row->cep."</td>";
			echo "<td>".$row->endereco."</td>";
			echo "<td>".$row->cidade."</td>";
			echo "<td>".$row->uf."</td>";
			echo "<td>".$row->bairro."</td>";
			echo "<td>".$row->contato."</td>";
			echo "<td>".$row->email."</td>";
            if($_COOKIE['usuario'] == 'Admin'){
			echo "<td><center><a href=\"deleteFornecedor.php?codigo=".$row->codigo."\"><img src=\"img/delete.png\" width=\"16\" height=\"16\" /><br>Excluir</a></center></td>";
            }
			echo "<td><center><a href=\"alteraFornecedor.php?codigo=".$row->codigo."\"><img src=\"img/edit_icon.png\" width=\"16\" height=\"16\" class=\"linkImg\" /><br>Alterar</a></center></td>";
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