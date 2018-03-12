<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="utf-8">
<title>Nova Entrada - Stock</title>
<link rel="stylesheet" type="text/css" href="css/estilo.css" /><!--
<link rel="stylesheet" type="text/css" href="css/jquery-ui.min.css" />-->
<script type="text/javascript" src="js/funcoes.js"></script>
<script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>
    
    <script type="text/javascript" src="js/jquery.min.js" ></script>
    <script src="js/jquery.maskedinput.js"></script>
    <script type="text/javascript" src="js/jquery.maskMoney.min.js" ></script>
    
    
    <!--
    
    <script type="text/javascript" src="js/jquery-ui.min.js" ></script>
    
    <script type="text/javascript" src="js/datepicker-pt-BR.js" ></script>-->

<link rel="icon" type="image/png" href="img/LogoStock.png" />
<script>
function SomenteNumero(e){
    var tecla=(window.event)?event.keyCode:e.which;   
    if((tecla>47 && tecla<58)) return true;
    else{
    	if (tecla==8 || tecla==0) return true;
	else  return false;
    }
}
		
function enableDisableNF(){
	var aChk = document.getElementsByName("semNF");   
		if (aChk[0].checked == true){  
			// CheckBox semNF Marcado...
			//alert(aChk[0].value+" marcado.");
			document.getElementById("nf").value = "Sem Nota Fiscal";
			document.getElementById("requisicao").value = "Sem Requisição"
			document.getElementById("empenho").value = "Sem Empenho";
			document.getElementById("fornecedor").required = false;
            document.getElementById("dataEmissao").required = false;
			document.getElementById("nf").readOnly = true;
			document.getElementById("requisicao").readOnly = true;
			document.getElementById("empenho").readOnly = true;
		}  else {
			//alert(aChk[0].value+" desmarcado.");
			document.getElementById("nf").value = "";
			document.getElementById("requisicao").value = ""
			document.getElementById("empenho").value = "";
			document.getElementById("fornecedor").selectedIndex = 0;
			document.getElementById("fornecedor").required = true;
            document.getElementById("dataEmissao").required = true;
			document.getElementById("nf").readOnly = false;
			document.getElementById("requisicao").readOnly = false;
			document.getElementById("empenho").readOnly = false;
			document.getElementById("nf").focus();
		}
}
function verificaFornecedor(){
	var e = document.getElementById("fornecedor");
	var fornecedor = e.options[e.selectedIndex].value;
	if(fornecedor == "naoListado"){
		var LeftPosition = (screen.width) ? (screen.width-550)/2 : 0;
		var TopPosition = (screen.height) ? (screen.height-300)/2 : 0;
		var myWindow = window.open("novoFornecedorpopup.php", "Novo Fornecedor", "width=550, height=300,top="+TopPosition+",left="+LeftPosition);
		document.getElementById('fornecedor').selectedIndex = 0;
	}
}
function verificaOpcaoItem(){
	var e = document.getElementById("item");
	var fornecedor = e.options[e.selectedIndex].value;
	if(fornecedor == "naoListado"){
		var LeftPosition = (screen.width) ? (screen.width-550)/2 : 0;
		var TopPosition = (screen.height) ? (screen.height-300)/2 : 0;
		var myWindow = window.open("novoItempopup.php", "Novo Item", "width=550, height=300,top="+TopPosition+",left="+LeftPosition);
		document.getElementById('item').selectedIndex = 0;
	}
}
function isValidForm(){
	
	var itensAdicionados = document.getElementById('ListaItensAdicionados').size; // pega total de linhas da lista de itens
	if(itensAdicionados < 1){
		alert('A lista de itens desta entrada est&aacute; vazia, voce nao pode registrar uma entrada sem pelo menos um item!\nPor favor insira os itens da NF.');
		return false;
	}else{
		ListaItensAdicionados = document.getElementById('ListaItensAdicionados');
		tamanho=ListaItensAdicionados.length;
		for(var cont=0; cont<tamanho; cont++){
			ListaItensAdicionados.options[cont].selected = true;
		}
		//alert(itensAdicionados+' Itens adicionados');
		return true;
	}
}

$(document).ready(function() {
	$("#dataEmissao").mask("99/99/9999");
	$("#dataEntrega").mask("99/99/9999");
	var last_valid_selection = null;

	$('#ListaItensAdicionados').change(function(event) {
		if ($(this).val().length > 1) {
			$(this).val(last_valid_selection);
			alert('Voce só pode selecionar um item!');
		}else{
			last_valid_selection = $(this).val();
        }
    });
    document.getElementById('dataEntrega').valueAsDate = new Date();
    /*
	$('#dataEmissao').datepicker();
	$('#dataEntrega').datepicker();*/
});
</script>
<?php
include_once("menu.php");
require_once("verificaPermissao.class.php");
$permissoes = new verificaPermissao("regEntrada");

include_once("PDOConnectionFactory.class.php");
$conexao_db = new PDOConnectionFactory;
?>

</head>

<body onLoad="history.go(+1)"> <!-- Nao permite que o usuario volte a pagina -->
<div class="div_table_entrada">
<form name="FormRegEntrada" id="FormRegEntrada" action="insertEntrada.php" method="post" onsubmit="return isValidForm()">
<fieldset><legend>Informa&ccedil;&otilde;es de Entrada</legend>
  <table border="1" align="center" class="tabelaNovoUsuario" style="margin-top:0px !important; border:1px; border-collapse:collapse; width:100%;">
    <tr>
      <td align="right">Nota Fiscal N&ordm;:</td>
      <td bgcolor="#FFFFFF">
          <input name="nf" type="text" id="nf" style="width:100%; background-color:transparent; border:none;" autofocus required data-thousands="." data-decimal="." data-prefix="" />
          
          <script type="text/javascript">
            //A precisao do decimal (,000) ;
                $("#nf").maskMoney({precision:3}); // Mascara de NF
          </script>
        
        </td>
      <td><input name="semNF" type="checkbox" value="Sem NF" onclick="javascript:enableDisableNF();" /> Sem Nota Fiscal (Itens Usados)</td>
      <td>Data Emiss&atilde;o NF: <input name="dataEmissao" id="dataEmissao" type="text" required /></td>
      <td>Data Entrega: <input name="dataEntrega" id="dataEntrega" type="text" required /></td>
    </tr>
        <tr>
      <td align="right">Requisi&ccedil;&atilde;o N&ordm;:</td>
      <td bgcolor="#FFFFFF"><input type="text" name="requisicao" style="width:100%; background-color:transparent; border:none;" id="requisicao" required /></td>
      <td align="right">Empenho N&ordm; :</td>
      <td colspan="2" bgcolor="#FFFFFF"><input type="text" name="empenho" style="width:100%; background-color:transparent; border:none;" id="empenho" required /></td>
    </tr>
    <tr>
      <td align="right">Fornecedor:</td>
      <td colspan="2">
      <select required name="fornecedor" id="fornecedor" style="width:85%;" onchange="javascript:verificaFornecedor();">
        <option value="" selected="selected">..::Selecione o Fornecedor::..</option>
        <?php
        // Listar Fornecedores
		$stmt = $conexao_db->con->query("SELECT codigo, razaoSocial FROM fornecedores ORDER BY razaoSocial");
		if($stmt->rowCount() > 0){
			while($row = $stmt->fetch(PDO::FETCH_OBJ)){
				echo "<option value=\"".$row->codigo."\">".$row->razaoSocial."</option>";
			}
		}
        ?>
        <option value="naoListado">Fornecedor n&atilde;o listado, Cadastrar NOVO</option>
        </select>
      <a href="#" onclick="recarregarFornecedores()">Atualizar</a>
      </td>
      <td align="right">Secretaria:</td>
      <td>
      <select required name="secretaria" style="width:100%">
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
<option value="Planejamento e Des. Economico" selected="selected">Planejamento e Des. Econ&ocirc;mico</option>
<option value="Procuradoria Geral do Municipio">Procuradoria Geral do Munic&iacute;pio</option>
<option value="Recursos Materiais e Licitacoes">Recursos Materiais e Licita&ccedil;&otilde;es</option>
<option value="Saude">Sa&uacute;de</option>
<option value="Seguranca">Seguran&ccedil;a</option>
<option value="Trabalho, Emprego e Economia Solidaria">Trabalho, Emprego e Economia Solid&aacute;ria</option>
<option value="Transporte e Transito">Transporte e Tr&acirc;nsito</option>
<option value="Urbanismo">Urbanismo</option>
<option value="Viacao e Obras Publicas">Via&ccedil;&atilde;o e Obras P&uacute;blicas</option>
</select>
      </td>
    </tr>
        </table>
</fieldset>
<!-- -------------------------------------------------------------------------------------------------------------------------------------------------------- -->
<!-- -------------------------------------------------------------------------------------------------------------------------------------------------------- -->
<!-- -------------------------------------------------------------------------------------------------------------------------------------------------------- -->
<!-- -------------------------------------------------------A PARTIR DAQUI INFORMAÇÕES DOS ITENS------------------------------------------------------------- -->
<!-- -------------------------------------------------------------------------------------------------------------------------------------------------------- -->
<!-- -------------------------------------------------------------------------------------------------------------------------------------------------------- -->
<!-- -------------------------------------------------------------------------------------------------------------------------------------------------------- -->
      <fieldset><legend>Itens adicionados</legend>
      <table id="tabelaItens" align="center" border="1" class="tabelaNovoUsuario" style="margin-top:0px !important; border:1px; border-collapse:collapse; width:100%;">
    	<tr bgcolor="#999999">
      		<td align="center">Item</td>
      		<td align="center">Quantidade</td>
    	</tr>
		<tr>
      <td><select name="item" id="item" style="width:90%" onchange="javascript:verificaOpcaoItem();">
        <option value="">..::Selecione o Item::..</option>
        <?php
		$rs = $conexao_db->con->query("SELECT codigo, descricao FROM itens ORDER BY codigo");
	
		if($rs->rowCount() > 0){
			while($row = $rs->fetch(PDO::FETCH_OBJ)){
				echo "<option value='".$row->codigo."'>".$row->descricao."</option>";
			}
		}
		?>
        <option value="naoListado">Item n&atilde;o listado, Cadastrar NOVO</option>
      </select>
        <a href="#" onclick="recarregarItens()">Atualizar</a></td>
      <td bgcolor="#FFFFFF"><input name="qtde" type="text" id="qtde" style="width:100%; background-color:transparent; border:none; text-align:center;" onkeypress='return SomenteNumero(event)' maxlength="6" /></td>
      </tr>
	  </table>
      <p align="right"><a href="#" onclick="inserirItemLista()"><img src="img/adiciona.png" width="16" height="15" />Adicionar Item a lista</a></p>
<!--          <button id="addItemList" onclick="inserirItemLista()"><img src="img/adiciona.png" width="16" height="15" />Adicionar Item a lista</button> -->
    <select name="ListaItensAdicionados[]" size="0" multiple="MULTIPLE" id="ListaItensAdicionados">
    </select><br><br>
    <a href="#" onclick="removerItemLista()"><img src="img/removeItem.png" /> Remover Item</a>
    </fieldset>
  <p align="right"><input name="" type="submit" value="Registrar Entrada" class="botaoRegistraEntrada"/></p>
</form>
</div> <!-- Fecha Div Entrada -->
</body>
</html>
