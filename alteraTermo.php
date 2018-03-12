<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="css/estilo.css" />
<title>Alterar Termo de Responsabilidade - Stock</title>
<script type="text/javascript" src="js/jquery-1.2.6.pack.js"></script>
<script type="text/javascript" src="js/jquery.maskedinput-1.1.4.pack.js"/></script>
<script type="text/javascript">
	$(document).ready(function(){
		$("#cpf").mask("999.999.999-99");
	});
	
	function getCodigo(){
		var x = document.getElementById('codigo').value;
		
		var array = x.split("");
		
		var contemEspaco = null;
		for(var i=0;i<array.length;i++){
			if(array[i] == " ")
			contemEspaco = true;
		}
		if(contemEspaco == true)
		alert('Voce nao pode digitar espacos no campo codigo');
		else
		if(isNaN(x))
		alert('Voce digitou um texto no campo codigo, este tipo de dado nao e valido');
		else{
//		alert('vocÃª digitou um nÃºmero');
//		alert('Tipo: '+typeof(xx) === 'number');
		if(x == "")
		alert('o campo codigo nao pode estar vazio');
		else
		window.location.href = "novoFornecedor.php?codigo="+x;
		}
	}
    </script>
    <?php
    include_once("menu.php");
require_once("verificaPermissao.class.php");
$permissoes = new verificaPermissao("verRelatorios");

if(isset($_POST['codigo'])){
	
	$codigo = $_POST['codigo'];

	include_once("termoDAO.php");
	include_once("termo.class.php");
	
	$termo = new Termo;
	$termo->setCodigo($codigo);
	$termo->setNome($_POST['nome']);
	$termo->setMatricula($_POST['matricula']);
	$termo->setCpf($_POST['cpf']);
	$termo->setSecretaria($_POST['secretaria']);
	$termo->setDepto_divisao($_POST['depto_divisao']);
	$termo->setLocal($_POST['local']);
	$termo->setItem($_POST['item']);
	$termo->setPatrimonio($_POST['patrimonio']);
	$termo->setNSuporte($_POST['nSuporte']);
	
	$termoDAO = new TermoDAO;
	$return = $termoDAO->update($termo);
	echo "<script>alert('".$return."');
	location.href='termos.php';
	</script>";
}

	?>
</head>

<body>
<?php
$codigo = NULL;
if(!empty($_GET['codigo'])){
$codigo = $_GET['codigo'];
if(is_numeric($codigo)){

include_once("PDOConnectionFactory.class.php");
$conexao_db = new PDOConnectionFactory;
$stmt = $conexao_db->con->prepare("SELECT id, nome, matricula, cpf, secretaria, depto_divisao, local, item, patrimonio, nSuporte FROM termos WHERE id =?");
$stmt->bindParam(1,$codigo);
$stmt->execute();

if($stmt->rowCount() > 0){
	$row = $stmt->fetch(PDO::FETCH_OBJ);

	echo "<form action=\"alteraTermo.php\" method=\"post\">
<table border=\"0\" align=\"center\" class=\"tabelaNovoUsuario\">
  <tr>
  	<td align=\"right\" bgcolor=\"#666666\">C&oacute;digo:</td>
    <td colspan=\"3\" bgcolor=\"#666666\"><input name=\"codigo\" id=\"codigo\" type=\"text\" readonly=\"readonly\" value=\"".$row->id."\" /></td>
  </tr>
    <tr>
    <td align=\"right\">Nome:</td>
    <td><input name=\"nome\" type=\"text\" required=\"required\" value=\"".$row->nome."\" autofocus=\"autofocus\" /></td>
    <td align=\"right\">Matricula:</td>
    <td><input name=\"matricula\" type=\"text\" required=\"required\" value=\"".$row->matricula."\" /></td>
  </tr>
  <tr>
    <td align=\"right\">CPF:</td>
    <td><input name=\"cpf\" id=\"cpf\" type=\"text\" required=\"required\" value=\"".$row->cpf."\" /></td>
    <td align=\"right\">Secretaria:</td>
    <td>
	<select required name='secretaria' id='secretaria' >
<option value='Administracao e Recursos Humanos'>Administra&ccedil;&atilde;o e Recursos Humanos</option>
<option value='Agricultura e Abastecimento'>Agricultura e Abastecimento</option>
<option value='Assistencia Social'>Assist&ecirc;ncia Social</option>
<option value='Comunicacao Social'>Comunica&ccedil;&atilde;o Social</option>
<option value='Cultura'>Cultura</option>
<option value='Educacao'>Educa&ccedil;&atilde;o</option>
<option value='Esporte e Lazer'>Esporte e Lazer</option>
<option value='Financas'>Finan&ccedil;as</option>
<option value='Governo'>Governo</option>
<option value='Habitacao'>Habita&ccedil;&atilde;o</option>
<option value='Industria, Comercio e Turismo'>Ind&uacute;stria, Com&eacute;rcio e Turismo</option>
<option value='Meio Ambiente'>Meio Ambiente</option>
<option value='Planejamento e Des. Economico' selected='selected'>Planejamento e Des. Econ&ocirc;mico</option>
<option value='Procuradoria Geral do Municipio'>Procuradoria Geral do Munic&iacute;pio</option>
<option value='Recursos Materiais e Licitacoes'>Recursos Materiais e Licita&ccedil;&otilde;es</option>
<option value='Saude'>Sa&uacute;de</option>
<option value='Seguranca'>Seguran&ccedil;a</option>
<option value='Trabalho, Emprego e Economia Solidaria'>Trabalho, Emprego e Economia Solid&aacute;ria</option>
<option value='Transporte e Transito'>Transporte e Tr&acirc;nsito</option>
<option value='Urbanismo'>Urbanismo</option>
<option value='Viacao e Obras Publicas'>Via&ccedil;&atilde;o e Obras P&uacute;blicas</option>
</select>
	</td>
  </tr>
  <tr>
    <td align=\"right\">Depto/Divisao:</td>
    <td><input name=\"depto_divisao\" type=\"text\" value=\"".$row->depto_divisao."\" /></td>
    <td align=\"right\">Local:</td>
    <td><input name=\"local\" type=\"text\" value=\"".$row->local."\" /></td>
  </tr>
  <tr>
    <td align=\"right\">Item:</td>
    <td><input name=\"item\" type=\"text\" value=\"".$row->item."\" /></td>
    <td align=\"right\">Patrimonio:</td>
    <td><input name=\"patrimonio\" type=\"text\" value=\"".$row->patrimonio."\" /></td>
  </tr>
  <tr>
    <td align=\"right\">N&ordm; Controle Suporte:</td>
    <td><input name=\"nSuporte\" type=\"text\" value=\"".$row->nSuporte."\" /></td>
	<td align=\"right\"></td>
	<td colspan=\"2\"><input type=\"submit\" value=\"Salvar altera&ccedil;&otilde;es\" class=\"botaoSalvar\" /></td>
  </tr>
</table>

</form>";
}else{
	echo "<script>alert('Nenhum Termo de Responsabilidade com esse codigo esta cadastrado no sistema.');window.location.href = \"termos.php\";</script>";
}
	
}else{
	die("<center><br><br><br><br>Este n&atilde;o &eacute; um dado Num&eacute;rico e n&atilde;o pode ser um C&oacute;digo<br><br><a href=\"termos.php\">Voltar</a>");
	}
}else{
	die("<center><br><br><br><br>Campo c&oacute;digo n&atilde;o iniciado<br><br><a href=\"termos.php\">Voltar</a>");
	}
?>
</body>
</html>