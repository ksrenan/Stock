<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="css/estilo.css" />
<title>Alterar Fornecedor - Stock</title>
    <script src="js/jquery-2.1.4.min.js"></script>
<script src="js/jquery.maskedinput.js"></script>
    <script>
$(document).ready(function(e) {
   jQuery("input.telefone")
        .mask("(99) 9999-9999?9")
        .focusout(function (event) {  
            var target, phone, element;  
            target = (event.currentTarget) ? event.currentTarget : event.srcElement;  
            phone = target.value.replace(/\D/g, '');
            element = $(target);  
            element.unmask();  
            if(phone.length > 10) {  
                element.mask("(99) 99999-999?9");  
            } else {  
                element.mask("(99) 9999-9999?9");  
            }  
        });
		$("#cep").mask("99.999-999"); 
		$("#cnpj").mask("99.999.999/9999-99");
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
		alert('VocÃª nÃ£o pode digitar espaÃ§os no campo cÃ³digo');
		else
		if(isNaN(x))
		alert('VocÃª digitou um texto no campo cÃ³digo, este tipo de dado nÃ£o Ã© vÃ¡lido');
		else{
//		alert('vocÃª digitou um nÃºmero');
//		alert('Tipo: '+typeof(xx) === 'number');
		if(x == "")
		alert('o campo cÃ³digo nÃ£o pode estar vazio');
		else
		window.location.href = "novoFornecedor.php?codigo="+x;
		}
	}
    </script>
    <?php
    include_once("menu.php");
require_once("verificaPermissao.class.php");
$permissoes = new verificaPermissao("cadFornecedor");
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
$stmt = $conexao_db->con->prepare("SELECT `codigo`, `razaoSocial`, `cnpj`, `ie`, `telefone`, `cep`, `endereco`, `cidade`, `uf`, `bairro`, `contato`, `email` FROM `fornecedores` WHERE codigo =?");
$stmt->bindParam(1,$codigo);
$stmt->execute();

if($stmt->rowCount() > 0){
	$row = $stmt->fetch(PDO::FETCH_OBJ);

	echo "<form action=\"updateFornecedor.php\" method=\"post\">
<table border=\"0\" align=\"center\" class=\"tabelaNovoUsuario\">
  <tr>
  	<td align=\"right\" bgcolor=\"#666666\">C&oacute;digo:</td>
    <td colspan=\"3\" bgcolor=\"#666666\"><input name=\"codigo\" id=\"codigo\" type=\"text\" readonly=\"readonly\" value=\"".$row->codigo."\" /></td>
  </tr>
    <tr>
    <td align=\"right\">Raz&atilde;o Social:</td>
    <td><input name=\"razaoSocial\" type=\"text\" required=\"required\" value=\"".$row->razaoSocial."\" autofocus=\"autofocus\" /></td>
    <td align=\"right\">CNPJ:</td>
    <td><input name=\"cnpj\" id=\"cnpj\" type=\"text\" required=\"required\" value=\"".$row->cnpj."\" /></td>
  </tr>
  <tr>
    <td align=\"right\">Insc. Estadual:</td>
    <td><input name=\"ie\" type=\"text\" value=\"".$row->ie."\" /></td>
    <td align=\"right\">Telefone:</td>
    <td><input name=\"telefone\" id=\"telefone\" class=\"telefone\" type=\"text\" required=\"required\" value=\"".$row->telefone."\" /></td>
  </tr>
  <tr>
    <td align=\"right\">CEP:</td>
    <td><input name=\"cep\" id=\"cep\" type=\"text\" value=\"".$row->cep."\" /></td>
    <td align=\"right\">Endere&ccedil;o:</td>
    <td><input name=\"endereco\" type=\"text\" value=\"".$row->endereco."\" /></td>
  </tr>
  <tr>
    <td align=\"right\">Cidade:</td>
    <td><input name=\"cidade\" type=\"text\" value=\"".$row->cidade."\" /></td>
	<td align=\"right\">UF:</td>
    <td><select name=\"uf\">
	<option value=\"".$row->uf."\" selected=\"selected\">PR</option>
      <option value=\"AC\">AC</option>
      <option value=\"AL\">AL</option>
      <option value=\"AP\">AP</option>
      <option value=\"AM\">AM</option>
      <option value=\"BA\">BA</option>
      <option value=\"CE\">CE</option>
      <option value=\"DF\">DF</option>
      <option value=\"ES\">ES</option>
      <option value=\"GO\">GO</option>
      <option value=\"MA\">MA</option>
      <option value=\"MT\">MT</option>
      <option value=\"MS\">MS</option>
      <option value=\"MG\">MG</option>
      <option value=\"PR\">PR</option>
      <option value=\"PB\">PB</option>
      <option value=\"PA\">PA</option>
      <option value=\"PE\">PE</option>
      <option value=\"PI\">PI</option>
      <option value=\"RJ\">RJ</option>
      <option value=\"RN\">RN</option>
      <option value=\"RS\">RS</option>
      <option value=\"RO\">RO</option>
      <option value=\"RR\">RR</option>
      <option value=\"SC\">SC</option>
      <option value=\"SE\">SE</option>
      <option value=\"SP\">SP</option>
      <option value=\"TO\">TO</option>
      </select></td>
  </tr>
  <tr>
    <td align=\"right\">Bairro:</td>
    <td><input name=\"bairro\" type=\"text\" value=\"".$row->bairro."\" /></td>
	<td align=\"right\">Contato:</td>
    <td><input name=\"contato\" type=\"text\" value=\"".$row->contato."\" /></td>
  </tr>
    <tr>
    <td align=\"right\">E-mail:</td>
    <td><input name=\"email\" type=\"email\" value=\"".$row->email."\" /></td>
	<td colspan=\"2\"><input type=\"submit\" value=\"Salvar altera&ccedil;&otilde;es\" class=\"botaoSalvar\" /></td>
  </tr>
</table>

</form>";
}else{
	echo "<script>alert('Nenhum Fornecedor com esse cÃ³digo estÃ¡ cadastrado no sistema.');window.location.href = \"fornecedores.php\";</script>";
}
	
}else{
	die("<center><br><br><br><br>Este n&atilde;o &eacute; um dado Num&eacute;rico e n&atilde;o pode ser um C&oacute;digo<br><br><a href=\"fornecedores.php\">Voltar</a>");
	}
}else{
	die("<center><br><br><br><br>Campo c&oacute;digo n&atilde;o iniciado<br><br><a href=\"fornecedores.php\">Voltar</a>");
	}
?>
</body>
</html>