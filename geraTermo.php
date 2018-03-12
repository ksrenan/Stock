<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="css/estilo.css" />
<script src="js/jquery-2.1.4.min.js"></script>
<script type="text/javascript" src="js/jquery.maskedinput-1.1.4.pack.js"/></script>
<link rel="icon" type="image/png" href="img/Report.png" />
<title>Termo de Responsabilidade - Stock</title>
<script>
var salvo = false;
$(document).ready(function(){
    $("#button").click(function(){
		if($("#nome").val() == "" ||
		$("#matricula").val() == "" ||
		$("#cpf").val() == "" ||
		$("#secretaria").val() == "" ||
		$("#depto_divisao").val() == "" ||
		$("#local").val() == "" ||
		$("#item").val() == "" ||
		$("#patrimonio").val() == "" ||
		$("#nSuporte").val() == ""){
			alert("Voce tem que preencher todos os campos!");
		}else{
			if(salvo == false){
			$.post( "registraTermo.php",
			{
				nome: $("#nome").val(),
				matricula: $("#matricula").val(),
				cpf: $("#cpf").val(),
				secretaria: $("#secretaria").val(),
				depto_divisao: $("#depto_divisao").val(),
				local: $("#local").val(),
				_item: $("#item").val(),
				patrimonio: $("#patrimonio").val(),
				nSuporte: $("#nSuporte").val()
			});
			salvo = true;
			$("#button").val('Imprimir');
			}
			window.print() ;
		}
    });
    $("#cpf").mask("999.999.999-99");
});
</script>
<?php

if(empty($_GET['codigoItem']) || empty($_GET['patrimonio'])){
	die("Algum valor nao foi iniciado");
}
$codigoItem = $_GET['codigoItem'];
$patrimonio = $_GET['patrimonio'];

require_once("verificaPermissao.class.php");
$permissoes = new verificaPermissao("regSaida");

include_once("PDOConnectionFactory.class.php");
$conexao_db = new PDOConnectionFactory;

	$rs = $conexao_db->con->prepare("SELECT descricao, marca, modelo, observacao FROM itens WHERE codigo=?");
	$rs->bindParam(1,$codigoItem);
	$rs->execute();
	
	$row = $rs->fetch(PDO::FETCH_OBJ);
	
	if($rs->rowCount() == 0){
		die("Este codigo nao existe");
	}
	
	$row->descricao;
	$row->marca;
	$row->modelo;
	$row->observacao;
	$patrimonio;
?>
</head>

<body>
<table border="0" align="center" style="width:100%;">
  <tr>
    <td rowspan="2" width="116" height="100"><img src="img/logoPref.jpg" width="116" height="100" /></td>
    <td align="center" style="vertical-align:bottom"><strong>PREFEITURA MUNICIPAL DE S&Atilde;O JOS&Eacute; DOS PINHAIS</strong></td>
  </tr>
  <tr>
    <td align="center" style="vertical-align:text-top">ESTADO DO PARAN&Aacute;</td>
  </tr>
</table>
<p align="center" style="margin-top:50px; margin-bottom:50px; ">TERMO DE RESPONSABILIDADE</p>
Eu, <input name="nome" id="nome" type="text" autofocus="autofocus" style="width:16cm; background-color:transparent; border:none; border-bottom-width:1px; border-bottom-style:solid; border-bottom-color:#000;"> ,<br>
Matr&iacute;cula: <input name="matricula" id="matricula" type="text" style="background-color:transparent; border:none; border-bottom-width:1px; border-bottom-style:solid; border-bottom-color:#000; text-align:center;">, 
CPF N&ordm; <input name="cpf" type="text" id="cpf" style="background-color:transparent; border:none; border-bottom-width:1px; border-bottom-style:solid; border-bottom-color:#000; text-align:center;" maxlength="11">, mediante este instrumento declaro responsabilizar-me pela guarda e conserva&ccedil;&atilde;o do equipamento abaixo descrito, de propriedade da Secretaria Municipal de <select name="secretaria" id="secretaria" style="background-color:transparent; border:none; border-bottom-width:1px; border-bottom-style:solid; border-bottom-color:#000; -webkit-appearance: none; text-align:center;">
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
</select>,
Departamento/Divis&atilde;o: <input name="depto_divisao" id="depto_divisao" type="text" style="background-color:transparent; border:none; border-bottom-width:1px; border-bottom-style:solid; border-bottom-color:#000; text-align:center;">,
Local: <input name="local" id="local" type="text" style="background-color:transparent; border:none; border-bottom-width:1px; border-bottom-style:solid; border-bottom-color:#000; width:11cm; text-align:center;">.<br />

<input name="item" id="item" type="text" style="background-color:transparent; border:none; border-bottom-width:1px; border-bottom-style:solid; border-bottom-color:#000; text-align:center; width:300px;" value="<?php echo $row->descricao; ?>" readonly="readonly">,

sob Patrim&ocirc;nio N&ordm;  <input name="patrimonio" id="patrimonio" type="text" style="background-color:transparent; border:none; border-bottom-width:1px; border-bottom-style:solid; border-bottom-color:#000; text-align:center;" value="<?php echo $patrimonio; ?>" size="6" readonly="readonly">
e C&oacute;digo de Controle do Suporte T&eacute;cnico N&ordm; <input name="nSuporte" id="nSuporte" type="text" style="background-color:transparent; border:none; border-bottom-width:1px; border-bottom-style:solid; border-bottom-color:#000; text-align:center; text-align:center;" size="10">, comprometendo-me a devolv&ecirc;-lo e/ou transferi-lo em perfeito estado na &eacute;poca da devolu&ccedil;&atilde;o/transfer&ecirc;ncia.
<br><br>
<input type="button" name="button" id="button" value="Salvar e Imprimir" /> <a href="itensEstoque.php" id="linkInicio">In&iacute;cio</a>
<br><br><br><br>
Em caso de extravio e danos que acarretem a perda total ou parcial do bem, ou altera&ccedil;&atilde;o da configura&ccedil;&atilde;o padr&atilde;o entregue sem pr&eacute;via autoriza&ccedil;&atilde;o atrav&eacute;s de memorando, fica obrigado(a) a ressarcir a Secretaria dos eventuais preju&iacute;zos experimentados.<br>
Faz-se necess&aacute;rio que o servidor ao receber seu novo equipamento, solicite imediatamente a guarda dos bens recebidos ao Departamento de Patrim&ocirc;nio, de acordo com o Decreto n&ordm; 2.637 de 10/7/2009 &minus; Instru&ccedil;&atilde;o Normativa SPA n&ordm; 01/2009, atrav&eacute;s de Sistema.<br><br><br><br><br>

S&atilde;o Jos&eacute; dos Pinhais, <?php
setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');
echo utf8_encode(strftime('%A, %d de %B de %Y', strtotime('today')));
?><br><br><br><br><br><br><br><br>

_________________________________________________________<br>			
Assinatura do servidor
<br><br><br><br><br><br>
<hr style="border: 1px solid #000;">
<center><p style="font-size:12px;">Rua Passos de Oliveira. 1101 &minus; CEP 83030-270 &minus; Fone (41) 3381-6800 &minus; S&atilde;o Jos&eacute; dos Pinhais &minus; Paran&aacute;</p></center>
</body>
</html>