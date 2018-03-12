<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="css/estilo.css" />
<title>Alterar Informa&ccedil;&otilde;es de Usu&aacute;rio - Stock</title>
<?php
include_once("menu.php");
require_once("verificaPermissao.class.php");
$permissoes = new verificaPermissao("cadUsuario");
?>
</head>

<body>
<table border="0" class="tabelaNovoUsuario" align="center">
<form action="updateUsuario.php" method="post">
<?php
$codigo = NULL;
if(!empty($_GET['codigo'])){
$codigo = $_GET['codigo'];
if(is_numeric($codigo)){

include_once("PDOConnectionFactory.class.php");
$conexao_db = new PDOConnectionFactory;
$stmt = $conexao_db->con->prepare("SELECT matricula, nome, senha, nivelAcesso FROM usuarios WHERE matricula =?");
$stmt->bindParam(1,$codigo);
$stmt->execute();

if($stmt->rowCount() > 0){
	$row = $stmt->fetch(PDO::FETCH_OBJ);
	echo "<tr>
    <td align=\"right\">Matricula:</td>
    <td><input name=\"matricula\" id=\"matricula\" type=\"text\" required=\"required\" value=\"".$row->matricula."\" readonly=\"readonly\" /></td>
  </tr>
  <tr>
    <td align=\"right\">Nome:</td>
    <td><input name=\"nome\" type=\"text\" required=\"required\" autofocus=\"autofocus\" value=\"".$row->nome."\" /></td>
  </tr>
  <tr>
    <td align=\"right\">N&iacute;vel de Acesso:</td>
    <td><p>
      <label>
        <input onclick=\"javascript:verificaChecks();\" type=\"checkbox\" name=\"nivelAcesso[]\" value=\"cadFornecedor\" id=\"nivelAcesso_0\" />
        Cadastrar Fornecedor</label>
      <br />
      <label>
        <input onclick=\"javascript:verificaChecks();\" type=\"checkbox\" name=\"nivelAcesso[]\" value=\"cadUsuario\" id=\"nivelAcesso_1\" />
        Cadastrar Usu&aacute;rio</label>
      <br />
      <label>
        <input onclick=\"javascript:verificaChecks();\" type=\"checkbox\" name=\"nivelAcesso[]\" value=\"cadItem\" id=\"nivelAcesso_2\" />
        Cadastrar Item</label>
      <br />
      <label>
        <input onclick=\"javascript:verificaChecks();\" type=\"checkbox\" name=\"nivelAcesso[]\" value=\"regEntrada\" id=\"nivelAcesso_3\" />
        Registrar Entrada</label>
      <br />
      <label>
        <input onclick=\"javascript:verificaChecks();\" type=\"checkbox\" name=\"nivelAcesso[]\" value=\"regSaida\" id=\"nivelAcesso_4\" />
        Registrar Sa&iacute;da</label>
      <br />
      <label>
        <input onclick=\"javascript:verificaChecks();\" type=\"checkbox\" name=\"nivelAcesso[]\" value=\"verRelatorios\" id=\"nivelAcesso_5\" />
        Ver Relat&oacute;rios</label>
      <br />
    </p></td>
  </tr>
  <tr>
    <td align=\"right\">Senha:</td>
    <td><input name=\"senha\" type=\"password\" required=\"required\" value=\"".$row->senha."\" /></td>
  </tr>
  <tr>
    <td align=\"right\">Alterar senha no pr&oacute;ximo Login?</td>
    <td>
    <select name=\"alterarSenha\">
      <option value=\"1\">Sim</option>
      <option value=\"0\" selected=\"selected\">N&atilde;o</option>
    </select></td>
  </tr>
  <tr>
	<td colspan=\"2\" align=\"right\"><input type=\"submit\" value=\"Salvar altera&ccedil;&otilde;es\" class=\"botaoSalvar\" /></td>
  </tr>";
}else{
	echo "<script>alert('Nenhum Usuario com esta matricula esta cadastrado no sistema.');window.location.href = \"usuarios.php\";</script>";
}
	
}else{
	die("<center><br><br><br><br>Este n&atilde;o &eacute; um dado Num&eacute;rico e n&atilde;o pode ser um C&oacute;digo<br><br><a href=\"usuarios.php\">Voltar</a>");
	}
}else{
	die("<center><br><br><br><br>Campo c&oacute;digo n&atilde;o iniciado<br><br><a href=\"usuarios.php\">Voltar</a>");
	}
?>
<script>
	var strNivelAcesso = <?php echo json_encode($row->nivelAcesso); ?>;
	var arrayNivelAcesso = strNivelAcesso.split("|");
	for(var i=0; i<6; i++){
		if(arrayNivelAcesso[i] == "cadFornecedor"){document.getElementById("nivelAcesso_0").checked = true;}
		if(arrayNivelAcesso[i] == "cadUsuario"){document.getElementById("nivelAcesso_1").checked = true;}
		if(arrayNivelAcesso[i] == "cadItem"){document.getElementById("nivelAcesso_2").checked = true;}
		if(arrayNivelAcesso[i] == "regEntrada"){document.getElementById("nivelAcesso_3").checked = true;}
		if(arrayNivelAcesso[i] == "regSaida"){document.getElementById("nivelAcesso_4").checked = true;}
		if(arrayNivelAcesso[i] == "verRelatorios"){document.getElementById("nivelAcesso_5").checked = true;}
	}
</script>
</form>
</table>
</body>
</html>