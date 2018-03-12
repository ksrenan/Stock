<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="../css/estilo.css" />
<link rel="icon" type="image/png" href="img/LogoStock.png" />
<title>Stock</title>
</head>

<body>
<?php
if(empty($_COOKIE['usuario'])){
	include_once("login.php");
}else{
	include_once("menu.php");
}
?>
</body>
</html>