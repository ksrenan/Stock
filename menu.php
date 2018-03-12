<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="css/estilo.css" />
<link rel="icon" type="image/png" href="img/LogoStock.png" />
<title>Menu - Stock</title>
</head>

<body>
<?php

if(empty($_COOKIE['usuario'])){
	echo "<meta http-equiv=\"refresh\" content=\"0;URL=login.php\">";
}else{
	$matricula = $_COOKIE['usuario'];
	include_once("PDOConnectionFactory.class.php");
	$conexao_db = new PDOConnectionFactory; // Cria a conexao ja no construtor
	
	$rs = $conexao_db->con->query("SELECT nivelAcesso, nome FROM usuarios WHERE matricula = '$matricula'");
	$rs->execute();
	
	$row = $rs->fetch(PDO::FETCH_OBJ);
	$nivelAcesso = $row->nivelAcesso;
	echo "<p class=\"info_user\"><img src=\"img/autenticacao.png\" width=\"20\" height=\"20\" style=\"padding-bottom:0px !important; margin-bottom:0px !important;\" /><strong>".$row->nome."</strong> | <a href=\"logout.php\">Sair</a></p><br>";
	}
?>
<center>
<nav>
<ul class="menu">
<li><a href="novoFornecedor.php">Novo Fornecedor</a></li>
<li><a href="novoItem.php">Novo Item</a></li>
 <?php

if($_COOKIE['usuario'] == 'Admin'){
    echo "<li><a href=\"novoUsuario.php\">Novo Usu&aacute;rio</a></li>";
}
    ?>   
<li><a href="novaEntrada.php">Nova Entrada</a></li>
<li><a href="itensEstoque.php">Itens Estoque</a></li>
<li><a href="#">Relat&oacute;rios</a>
<ul>
<li><a href="itens.php">Itens</a></li>
<li><a href="fornecedores.php">Fornecedores</a></li>
 <?php

if($_COOKIE['usuario'] == 'Admin'){
    echo "<li><a href=\"usuarios.php\">Usu&aacute;rios</a></li>";
    }
    ?>
    
<li><a href="entradas.php">Entradas</a></li>
<li><a href="saidas.php">Sa&iacute;das</a></li>
<li><a href="termos.php">Termos de Resp.</a></li>
</ul>
</li>
</ul>
</nav>
</center>
</body>
</html>