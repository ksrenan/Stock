<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="css/estilo.css" />
<link rel="icon" type="image/png" href="img/autenticacao.png" />
<title>Cadastro de Usu&aacute;rios - Stock</title>

<script>
    
    function SomenteNumero(e){
    var tecla=(window.event)?event.keyCode:e.which;   
    if((tecla>47 && tecla<58)) return true;
    else{
    	if (tecla==8 || tecla==0) return true;
	else  return false;
    }
}
    
function verificaChecks(){
	var aChk = document.getElementsByName("nivelAcesso[]");
	var marcado = null;
	for (var i=0;i<aChk.length;i++){  
		if (aChk[i].checked == true){  
			marcado = true;
//			alert(aChk[i].value + " marcado.");
		}
	}
	if(marcado == null){
		document.getElementById("nivelAcesso_3").checked = true;
		document.getElementById("nivelAcesso_4").checked = true;
		alert('Voce deve escolher as permissoes do novo usuario');
	}
} 

</script>

</head>

<body>
<?php
include_once("menu.php");
require_once("verificaPermissao.class.php");
$permissoes = new verificaPermissao("cadUsuario");
?>
<form id="myForm" action="insertUsuario.php" method="post">
<table border="0" align="center" class="tabelaNovoUsuario">
  <tr>
    <td align="right">Matricula:</td>
    <td><input name="matricula" minlength="4" id="matricula" type="text" required="required" autofocus="autofocus" onkeypress='return SomenteNumero(event)' /></td>
  </tr>
  <tr>
    <td align="right">Nome:</td>
    <td><input name="nome" type="text" required="required" /></td>
  </tr>
  <tr>
    <td align="right">N&iacute;vel de Acesso:</td>
    <td><p>
      <label>
        <input onclick="javascript:verificaChecks();" type="checkbox" name="nivelAcesso[]" value="cadFornecedor" id="nivelAcesso_0" />
        Cadastrar Fornecedor</label>
      <br />
      <label>
        <input onclick="javascript:verificaChecks();" type="checkbox" name="nivelAcesso[]" value="cadUsuario" id="nivelAcesso_1" />
        Cadastrar Usu&aacute;rio</label>
      <br />
      <label>
        <input onclick="javascript:verificaChecks();" type="checkbox" name="nivelAcesso[]" value="cadItem" id="nivelAcesso_2" />
        Cadastrar Item</label>
      <br />
      <label>
        <input onclick="javascript:verificaChecks();" type="checkbox" name="nivelAcesso[]" value="regEntrada" id="nivelAcesso_3" checked="checked" />
        Registrar Entrada</label>
      <br />
      <label>
        <input onclick="javascript:verificaChecks();" type="checkbox" name="nivelAcesso[]" value="regSaida" id="nivelAcesso_4" checked="checked" />
        Registrar Sa&iacute;da</label>
      <br />
      <label>
        <input onclick="javascript:verificaChecks();" type="checkbox" name="nivelAcesso[]" value="verRelatorios" id="nivelAcesso_5" />
        Ver Relat&oacute;rios</label>
      <br />
    </p></td>
  </tr>
  <tr>
    <td align="right">Senha:</td>
    <td><input name="senha" type="password" required="required" /></td>
  </tr>
  <tr>
    <td align="right">Alterar senha no pr&oacute;ximo Login?</td>
    <td>
    <select name="alterarSenha">
      <option value="1">Sim</option>
      <option value="0" selected="selected">N&atilde;o</option>
    </select></td>
  </tr>
  <tr>
	<td colspan="2" align="right"><input type="submit" value="Salvar altera&ccedil;&otilde;es" class="botaoSalvar" /></td>
  </tr>
</table>

</form>
</body>
</html>