<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <title>Qtde retirada por secretaria - Stock</title>
</head>

<body>

<?php
require_once("verificaPermissao.class.php");
$permissoes = new verificaPermissao("verRelatorios");

include_once("PDOConnectionFactory.class.php");
echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"css/estilo.css\" />";

$descricao = $_GET['descricao'];
$dataFinal = $_GET['dataFinal'];
$dataInicial = $_GET['dataInicial'];

$conexao_db = new PDOConnectionFactory;

?>
<table border="1" style="border-collapse:collapse">
    <tr>
        <td colspan="4" align="center">Exibindo quantidade de <strong><?php echo $descricao; ?></strong> retirado por secretaria</strong></td>
    </tr>
    <tr bgcolor="#999999">
        <td><strong>Secretaria</strong></td>
        <td><strong>Qtde</strong></td>

    </tr>
    <?php
    try{
        $rs = $conexao_db->con->prepare("SELECT SUM(qtde) qtde, secretaria_destino FROM saidas WHERE descricao = ? AND data BETWEEN ? AND ? GROUP BY secretaria_destino");
        $rs->bindParam(1,$descricao);
        $rs->bindParam(2,$dataInicial);
        $rs->bindParam(3,$dataFinal);
        $rs->execute();

        while($row = $rs->fetch(PDO::FETCH_OBJ)){
            echo "<tr>
                  <td>".$row->secretaria_destino."</td>
                  <td>".$row->qtde."</td>
                  </tr>";
        }

    }catch(PDOException $e){
        die("N&atilde;o foi poss&iacute;vel encontrar registros");
    }
    ?>
</table>

</body>
</html>