<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="css/estilo.css" />
<title>Novo Fornecedor - Stock</title>
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
</head>

<body>
<?php
include_once("menu.php");
require_once("verificaPermissao.class.php");
$permissoes = new verificaPermissao("cadFornecedor");
?>
<form action="insertFornecedor.php" method="post">
<table border="0" align="center" class="tabelaNovoUsuario">
    <tr>
    <td align="right">Raz&atilde;o Social:</td>
    <td><input name="razaoSocial" type="text" required="required" autofocus="autofocus" /></td>
    <td align="right">CNPJ:</td>
    <td><input name="cnpj" id="cnpj" type="text" required="required" /></td>
  </tr>
  <tr>
    <td align="right">Insc. Estadual:</td>
    <td><input name="ie" type="text" /></td>
    <td align="right">Telefone:</td>
    <td><input name="telefone" class="telefone" type="text" required="required" /></td>
  </tr>
  <tr>
    <td align="right">CEP:</td>
    <td><input name="cep" id="cep" type="text" /></td>
    <td align="right">Endere&ccedil;o:</td>
    <td><input name="endereco" type="text" /></td>
  </tr>
  <tr>
    <td align="right">Cidade:</td>
    <td><input name="cidade" type="text" /></td>
	<td align="right">UF:</td>
    <td><select name="uf">
      <option value="AC">AC</option>
      <option value="AL">AL</option>
      <option value="AP">AP</option>
      <option value="AM">AM</option>
      <option value="BA">BA</option>
      <option value="CE">CE</option>
      <option value="DF">DF</option>
      <option value="ES">ES</option>
      <option value="GO">GO</option>
      <option value="MA">MA</option>
      <option value="MT">MT</option>
      <option value="MS">MS</option>
      <option value="MG">MG</option>
      <option value="PR" selected="selected">PR</option>
      <option value="PB">PB</option>
      <option value="PA">PA</option>
      <option value="PE">PE</option>
      <option value="PI">PI</option>
      <option value="RJ">RJ</option>
      <option value="RN">RN</option>
      <option value="RS">RS</option>
      <option value="RO">RO</option>
      <option value="RR">RR</option>
      <option value="SC">SC</option>
      <option value="SE">SE</option>
      <option value="SP">SP</option>
      <option value="TO">TO</option>
      </select></td>
  </tr>
  <tr>
    <td align="right">Bairro:</td>
    <td><input name="bairro" type="text" /></td>
	<td align="right">Contato:</td>
    <td><input name="contato" type="text" /></td>
  </tr>
    <tr>
    <td align="right">E-mail:</td>
    <td><input name="email" type="email" /></td>
	<td colspan="2"><input type="submit" value="Salvar altera&ccedil;&otilde;es" class="botaoSalvar" /></td>
  </tr>
</table>

</form>
</body>
</html>