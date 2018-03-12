<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="css/estilo.css" />
<link rel="icon" type="image/png" href="img/Report.png" />
<title>Entradas - Stock</title>

<script type="text/javascript" src="js/jquery.min.js" ></script>
<script type="text/javascript" src="js/jquery.maskMoney.min.js" ></script>

<link rel="stylesheet" href="css/jquery.superbox.css" type="text/css" media="all" />
<!--<script type="text/javascript" src="js/jquery.min-1.3.2-google.js"></script>-->
<script type="text/javascript" src="js/jquery.superbox-min.js"></script>

    <!--    <script type="text/javascript" src="js/jquery.number.min.js"></script>-->
    
    
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
    
    
$(document).ready(function() {
   $("table tbody tr:odd").addClass('zebraTabela'); //Zebrar tabela
});
    
    </script>
</head>

<body>
<?php

include_once("PDOConnectionFactory.class.php");
$conexao_db = new PDOConnectionFactory; // Cria a conex&atilde;o j&aacute; no construtor

require_once("verificaPermissao.class.php");
$permissoes = new verificaPermissao("verRelatorios");

include_once("menu.php");
$matricula = $_COOKIE['usuario'];

?>
<div class="dv2">
<form action="entradas.php" method="post">
    <center>
        <strong>&rarr; ENTRADAS</strong>
        <img src="img/busca.png" width="18" height="18" alt="Consultar" title="Consulta" />
        
        
        <span title="Secretaria">Consulta por Secretaria: </span>
       <select name="secretaria">
       <option value=""></option>
<option value="Administracao e Recursos Humanos">Administra&ccedil;&atilde;o e Recursos Humanos</option>
<option value="Agricultura e Abastecimento">Agricultura e Abastecimento</option>
<option value="Assistencia Social">Assist&ecirc;ncia Social</option>
<option value="Comunicacao Social">Comunica&ccedil;&atilde;o Social</option>
<option value="Cultura">Cultura</option>
<option value="Educacao">Educa&ccedil;&atilde;o</option>
<option value="Esporte e Lazer">Esporte e Lazer</option>
<option value="Financas">Finan&ccedil;as</option>
<option value="Governo">Governo</option>
<option value="Habitacao">Habita&ccedil;&atilde;o</option>
<option value="Industria, Comercio e Turismo">Ind&uacute;stria, Com&eacute;rcio e Turismo</option>
<option value="Meio Ambiente">Meio Ambiente</option>
<option value="Planejamento e Des. Economico">Planejamento e Des. Econ&ocirc;mico</option>
<option value="Procuradoria Geral do Municipio">Procuradoria Geral do Munic&iacute;pio</option>
<option value="Recursos Materiais e Licitacoes">Recursos Materiais e Licita&ccedil;&otilde;es</option>
<option value="Saude">Sa&uacute;de</option>
<option value="Seguranca">Seguran&ccedil;a</option>
<option value="Trabalho, Emprego e Economia Solidaria">Trabalho, Emprego e Economia Solid&aacute;ria</option>
<option value="Transporte e Transito">Transporte e Tr&acirc;nsito</option>
<option value="Urbanismo">Urbanismo</option>
<option value="Viacao e Obras Publicas">Via&ccedil;&atilde;o e Obras P&uacute;blicas</option>
</select>
        
        por descri&ccedil;&atilde;o itens da NF: <input type="search" name="descricao">
        
        ou por n&ordm; NF: <input type="search" id="nf" name="nf" data-thousands="." data-decimal="." data-prefix="" />
        
        <script type="text/javascript">
            //A precis&atilde;o do decimal (,000) ;
            $("#nf").maskMoney({precision:3}); // Mascara de NF
        </script>
        
        <input name="" type="submit" value="Consultar" style="background-color:#CCC" />
    </center>
</form>

    <table border="1" align="center" bordercolor="#696969" style="border-collapse: collapse" cellpadding="2" bgcolor="#FFF">
        <thead>
            <tr bgcolor="#999999">
                <th><strong>C&oacute;digo</strong></th>
                <th><strong>Data Entrega</strong></th>
                <th><strong>Data Emiss&atilde;o NF</strong></th>
                <th><strong>Usu&aacute;rio</strong></th>
                <th><strong>NF</strong></th>
                <th><strong>Empenho</strong></th>
                <th><strong>Requisi&ccedil;&atilde;o</strong></th>
                <th><strong>Fornecedor</strong></th>
                <th><strong>Secretaria</strong></th>
                <th><strong>Itens</strong></th>
                    <?php

if($_COOKIE['usuario'] == 'Admin'){
    
    echo "<th><center><img src=\"img/remove.png\" width=\"17\" height=\"17\" /></center></th>";
    }
    ?>
            </tr>
        </thead>
        <tbody>
    
<?php
		
	if (isset($_POST['secretaria']) && $_POST['secretaria'] != "" || isset($_POST['nf']) && $_POST['nf'] != ""){ //  Informa se a foi digitado algo na busca
	
        $secretaria = $_POST['secretaria'];
	    $nf = $_POST['nf'];
        
        $rs = $conexao_db->con->prepare("SELECT
        codigo_entrada,
        DATE_FORMAT(data_entrega,'%d/%m/%Y') data_entrega,
        DATE_FORMAT(data_emissao,'%d/%m/%Y') data_emissao,
        usuario,
        nf,
        empenho,
        requisicao,
        fornecedor,
        secretaria
        FROM entradas WHERE nf = '".$nf."' OR secretaria = '".$secretaria."' ");

	}else if(isset($_POST['descricao']) && $_POST['descricao'] != "" ){
        $descricao = $_POST['descricao'];
        
        $rs = $conexao_db->con->prepare(" SELECT 
        entradas.codigo_entrada,
        DATE_FORMAT(entradas.data_entrega,'%d/%m/%Y') data_entrega,
        DATE_FORMAT(entradas.data_emissao,'%d/%m/%Y') data_emissao,
        entradas.usuario,
        entradas.nf,
        entradas.empenho,
        entradas.requisicao,
        entradas.fornecedor,
        entradas.secretaria
        FROM entradas INNER JOIN itens_entrada ON itens_entrada.codigo_entrada = entradas.codigo_entrada WHERE itens_entrada.descricao LIKE '%".$descricao."%' ");
        
    }else{
		$rs = $conexao_db->con->query("SELECT codigo_entrada, DATE_FORMAT(data_entrega,'%d/%m/%Y') data_entrega, DATE_FORMAT(data_emissao,'%d/%m/%Y') data_emissao, usuario, nf, empenho, requisicao, fornecedor, secretaria FROM entradas");
	}
	
	$rs->execute();
	
	if($rs->rowCount() > 0){
		while($row = $rs->fetch(PDO::FETCH_OBJ)){
            
            echo "<tr align=\"center\">"; // Abre Linha Tabela
			echo "<td>".$row->codigo_entrada."</td>";
			echo "<td>".$row->data_entrega."</td>";
            echo "<td>".$row->data_emissao."</td>";
			
			$stmt = $conexao_db->con->query("SELECT nome FROM usuarios WHERE matricula = '".$row->usuario."'");
			$stmt->execute();
			$rsUsuario = $stmt->fetch(PDO::FETCH_OBJ);
			echo "<td>".$rsUsuario->nome."</td>";
			
			echo "<td>".$row->nf."</td>";
			echo "<td>".$row->empenho."</td>";
			echo "<td>".$row->requisicao."</td>";
			
			if(is_numeric($row->fornecedor)){
				$rsForn = $conexao_db->con->query("SELECT razaoSocial FROM fornecedores WHERE codigo = ".$row->fornecedor);
				$rsForn->execute();
				$rsFornObj = $rsForn->fetch(PDO::FETCH_OBJ);
				echo "<td>".$rsFornObj->razaoSocial."</td>";
			}else{
				echo "<td>".$row->fornecedor."</td>";
			}
			echo "<td>".$row->secretaria."</td>";
			echo "<td><center><a href=\"itensEntrada.php?codigo=".$row->codigo_entrada."\" rel='superbox[iframe]'>Itens desta Entrada</a></center></td>";
            if($_COOKIE['usuario'] == 'Admin'){
			echo "<td><center><a href=\"deleteEntrada.php?codigo=".$row->codigo_entrada."\"><img src=\"img/delete.png\" width=\"16\" height=\"16\" /><br>Excluir</a></center></td>";
            }
			echo "</tr>"; // Fecha Linha Tabela
		} // Fecha While
		
		echo "<center>Registros encontrados: <strong>".$rs->rowCount()."</strong></center>";
		
	}else{ // Se linhas afetadas forem 0...
		echo "Nenhum Registro encontrado.<br>";
	}
?>
</tbody>
</table>
</div> <!-- Fecha Div dv2 -->
</body>
</html>