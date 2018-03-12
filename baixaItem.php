<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="css/estilo.css" />
<title>Baixa Item Estoque</title>
<script>

function SomenteNumero(e){
    var tecla=(window.event)?event.keyCode:e.which;   
    if((tecla>47 && tecla<58)) return true;
    else{
    	if (tecla==8 || tecla==0) return true;
	else  return false;
    }
}
</script>
<?php
require_once("verificaPermissao.class.php");
$permissoes = new verificaPermissao("regSaida");

include_once("PDOConnectionFactory.class.php");
include("menu.php");

$codigo = $_GET['codigo'];

$conexao_db = new PDOConnectionFactory;

try{
	$result = $conexao_db->con->prepare("SELECT qtde, secretaria FROM itens_estoque WHERE codigo = ? AND qtde > 0");
	$result->bindParam(1,$codigo);
	$result->execute();
	
	if($result->rowCount() == 0){
		die("Itens correspondentes a este codigo nao foram encontrados.");
	}
		$rsItem = $conexao_db->con->prepare("SELECT * FROM itens WHERE codigo = ?");
		$rsItem->bindParam(1,$codigo);
		$rsItem->execute();
		$rowItem = $rsItem->fetch(PDO::FETCH_OBJ);
	
	$row = $result->fetch(PDO::FETCH_OBJ);
	
}catch(PDOException $e){
	die("Nao foi possivel ler os dados deste item | <a href=\"itensEstoque.php\">Voltar</a>");
}

?>
<script type="text/javascript">
  var qtde = <?php echo json_encode($row->qtde); ?>;
</script>
</head>

<body>
<!-- <a href="itensEstoque.php">&larr; Voltar</a> -->
<form action="baixaItemEstoque.php" method="post">
  <table border="1" style="border-collapse:collapse" align="center">
  <tr>
    <td colspan="2" align="center" bgcolor="#999999">Informa&ccedil;&otilde;es de retirada do item:</td>
  </tr>
  <tr>
    <td align="right">C&oacute;digo:</td>
    <td><input name="codigo" type="text" value="<?php echo $codigo; ?>" readonly="readonly" /></td>
  </tr>
  <tr>
    <td align="right">Descri&ccedil;&atilde;o:</td>
    <td><input name="descricao" type="text" value="<?php echo $rowItem->descricao; ?>" readonly="readonly" /></td>
  </tr>
  <tr>
    <td align="right">Marca:</td>
    <td><input name="marca" type="text" value="<?php echo $rowItem->marca; ?>" readonly="readonly" /></td>
  </tr>
  <tr>
    <td align="right">Modelo:</td>
    <td><input name="modelo" type="text" value="<?php echo $rowItem->modelo; ?>" readonly="readonly" /></td>
  </tr>
  <tr>
    <td align="right">Observa&ccedil;&atilde;o:</td>
    <td><textarea name="observacao" cols="30" rows="4" readonly="readonly" ><?php echo $rowItem->observacao; ?></textarea></td>
  </tr>
  <tr>
    <td align="right">Quantidade:</td>
    <td><input name="qtde" id="qtde" type="text" required="required" onkeypress='return SomenteNumero(event)' /></td>
  </tr>
  <tr>
    <td align="right">Sec. origem do item:</td>
    <td><select name="secretaria">
    <?php
	
	try{
	$rs = $conexao_db->con->prepare("SELECT secretaria FROM itens_estoque WHERE codigo = ?");
	$rs->bindParam(1,$codigo);
	$rs->execute();
	while($row = $rs->fetch(PDO::FETCH_OBJ)){
      echo "<option value='".$row->secretaria."'>".$row->secretaria."</option>";
	}
}catch(PDOException $e){
	die("Nao foi possivel listar as secretarias");
}
	
	?>
    </select></td>
  </tr>
    <tr>
      <td align="right">Sec. destino do item:</td>
      <td>
        <select name="secretaria_destino">
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
      </td>
    </tr>
  <tr>
    <td align="right">N&ordm; Ordem Servi&ccedil;o:</td>
    <td><input name="os" type="text" required="required" onkeypress='return SomenteNumero(event)' /></td>
  </tr>
  <tr>
    <td align="right">T&eacute;cnico que Retirou:</td>
    <td><input name="tecnico_retirou" type="text" required="required" /></td>
  </tr>
  <?php
  if($rowItem->patrimoniar == 1){
	  echo "<tr>
	  <td align=\"right\">Patrim&ocirc;nio:</td>
	  <td><input name=\"patrimonio\" type=\"text\" required=\"required\" /></td>
	  		</tr>
			<script>
			  document.getElementById(\"qtde\").value = 1;
			  document.getElementById(\"qtde\").readOnly = true;
			</script>
			";
  }
  ?>
  <tr>
    <td></td>
    <td><input type="submit" value="Registrar Sa&iacute;da" /></td>
  </tr>
</table>
</form>
</body>
</html>