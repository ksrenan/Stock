<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="css/estilo.css" />
<link rel="icon" type="image/png" href="img/Report.png" />
<title>Usu&aacute;rios - Stock</title>
    
    <script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $("table tbody tr:odd").addClass('zebraTabela');
        });
    
        
    </script>

</head>

<body>
<?php

/*error_reporting(0);
ini_set(â€œdisplay_errorsâ€, 0 );*/

include_once("PDOConnectionFactory.class.php");
$conexao_db = new PDOConnectionFactory; // Cria a conexÃ£o ja no construtor

require_once("verificaPermissao.class.php");
$permissoes = new verificaPermissao("verRelatorios");

include_once("menu.php");
$matricula = $_COOKIE['usuario'];
?>
<div class="dv2">
<form action="usuarios.php" method="post">
<center>Consulte usu&aacute;rio pela matr&iacute;cula: <img src="img/busca.png" width="18" height="18" alt="Consultar" /><input name="codigo" type="search" />
<input name="" type="submit" value="Consultar" style="background-color:#CCC" /></center>
</form>
<table border="1" bordercolor="#696969" style="border-collapse: collapse" cellpadding="2" bgcolor="#FFF" align="center">

    <thead>
<tr bgcolor="#999999">
    <th><strong>Matr&iacute;cula</strong></th>
    <th><strong>Nome</strong></th>
    <th><strong>Permiss&otilde;es</strong></th>
    
    <?php

if($_COOKIE['usuario'] == 'Admin'){
    
    echo "<th><center><img src=\"img/remove.png\" width=\"17\" height=\"17\" /></center></th>";
    echo "<th><center><img src=\"img/alterar.png\" width=\"17\" height=\"17\" /></center></th>";
    
    }
    ?>
</tr>
    </thead>
<tbody>
<?php
		
	if (isset($_POST['codigo']) && $_POST['codigo'] != ""){ //  Informa se a foi digitado algo na busca

	$codigo = $_POST['codigo'];
	$rs = $conexao_db->con->prepare("SELECT * FROM usuarios WHERE matricula = ?");
	$rs->bindParam(1,$codigo);

	}else{
		$rs = $conexao_db->con->query("SELECT * FROM usuarios");
	}
	
	$rs->execute();
	
	if($rs->rowCount() > 0){
		while($row = $rs->fetch(PDO::FETCH_OBJ)){
            
            if($row->matricula != 'Admin'){
            
            echo "<tr>"; // Abre Linha Tabela
			echo "<td>".$row->matricula."</td>";
			echo "<td>".$row->nome."</td>";
			
            
            $arrayPermissoes = explode("|", $row->nivelAcesso);
            
            echo "<td>";
            foreach ($arrayPermissoes as $value) {
                switch($value){
                    case "cadFornecedor": echo "Cadastrar Fornecedor<br>";
                        break;
                        
                    case "cadUsuario": echo "Cadastrar Usuario<br>";
                        break;
                        
                    case "cadItem": echo "Cadastrar Item<br>";
                        break;
                        
                    case "regEntrada": echo "Registrar Entrada<br>";
                        break;
                        
                    case "regSaida": echo "Registrar Sa&iacute;da<br>";
                        break;
                        
                    case "verRelatorios": echo "Ver Relat&oacute;rios<br>";
                        break;
                }
                //echo $value."<br>";
            }
            echo "</td>";
            
            
            
            
            
            if($_COOKIE['usuario'] == 'Admin'){
            
			echo "<td><center><a href=\"deleteUsuario.php?codigo=".$row->matricula."\"><img src=\"img/delete.png\" width=\"16\" height=\"16\" /><br>Excluir</a></center></td>";
                
			echo "<td><center><a href=\"alteraUsuario.php?codigo=".$row->matricula."\"><img src=\"img/edit_icon.png\" width=\"16\" height=\"16\" class=\"linkImg\" /><br>Alterar</a></center></td>";
            }
			echo "</tr>"; // Fecha Linha Tabela
			
        } // Fecha se for diferente de Admin
            
		} // Fecha While
		
		echo "<center>Registros encontrados: <strong>".$rs->rowCount()."</strong></center>";
		
	}else{ // Se linhas afetadas forem 0...
		echo "Nenhum Registro encontrado.<br>";
	}
if($_COOKIE['usuario'] == 'Admin'){
            
			echo "<tr>";
                echo "<td colspan=\"5\">";
                    
    
    echo "<center><a href=\"alteracaoSenha.php\">Alterar Senha do Administrador</a></center>";
    
    
                echo "</td>";
            echo "</tr>";
                
			
            }
?>
</tbody>
</table>
</div> <!-- Fecha Div dv2 -->
</body>
</html>
