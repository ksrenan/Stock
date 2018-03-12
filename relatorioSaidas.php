<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1" name="viewport">

    <title>Relat&oacute;rio do Periodo</title>
    <link rel="stylesheet" type="text/css" href="css/estilo.css" />
    <link rel="stylesheet" href="css/jquery.superbox.css" type="text/css" media="all" />
    <script type="text/javascript" src="js/jquery.min-1.3.2-google.js"></script>
    <script type="text/javascript" src="js/jquery.superbox-min.js"></script>
    <script type="text/javascript">
        $(function(){
            $.superbox.settings = {
                closeTxt: "Fechar",
                loadTxt: "Carregando Informa&ccedil;&otilde;es...",
                overlayOpacity: .8, // Background opaqueness
                boxWidth: "600", // Default width of the box
                boxHeight: "400", // Default height of the box
            };
            $.superbox();
        });
        $(document).ready(function() {
            $("table tbody tr:odd").addClass('zebraTabela'); //Zebrar tabela
        });



    </script>
    
</head>

<body>
<a href="saidas.php"><< Voltar <<</a>
<div class="dv2">
    <center>
        <?php
        echo "Item: ".$_GET['item']." | Periodo de: ".date('d/m/Y', strtotime($_GET['dataInicial']))." a ".date('d/m/Y', strtotime($_GET['dataFinal']));
        ?>
        <br><br>

        <strong>Resultado da sua pesquisa:</strong></center>

    <table border="1" bordercolor="#696969" style="border-collapse: collapse; width: 100%" cellpadding="2" bgcolor="#FFF">
        <thead>
        <tr bgcolor="#999999">
            <th><strong>Descri&ccedil;&atilde;o</strong></th>
            <th><strong>Qtde total</strong></th>
            <th><strong>Por Sec.</strong></th>
        </tr>
        </thead>
        <tbody>
        <?php

        include_once("PDOConnectionFactory.class.php");
        $conexao_db = new PDOConnectionFactory; // Cria a conexao ja no construtor

        $rs = $conexao_db->con->query("SELECT SUM(qtde) qtde, descricao FROM saidas WHERE descricao LIKE '%".$_GET['item']."%' AND data BETWEEN '".$_GET['dataInicial']."' AND '".$_GET['dataFinal']."' GROUP BY descricao");

        $rs->execute();

        if($rs->rowCount() > 0){

            while($row = $rs->fetch(PDO::FETCH_OBJ)){
                echo "<tr>"; // Abre Linha Tabela
                echo "<td align=\"center\"><a href='itemPorSec.php?descricao=".$row->descricao."&dataInicial=".$_GET['dataInicial']."&dataFinal=".$_GET['dataFinal']."' rel='superbox[iframe]' title='Qtde retirada por secretaria'>".$row->descricao."</a></td>";
                echo "<td align=\"center\"><a href='itemPorSec.php?descricao=".$row->descricao."&dataInicial=".$_GET['dataInicial']."&dataFinal=".$_GET['dataFinal']."' rel='superbox[iframe]' title='Qtde retirada por secretaria'>".$row->qtde."</a></td>";
                echo "<td align=\"center\"><a href='itemPorSec.php?descricao=".$row->descricao."&dataInicial=".$_GET['dataInicial']."&dataFinal=".$_GET['dataFinal']."' rel='superbox[iframe]' title='Qtde retirada por secretaria'>Por Sec.</a></td>";
                echo "</tr>"; // Fecha Linha Tabela
            } // Fecha While

        }else{ // Se linhas afetadas forem 0...
            echo "Nenhum Registro encontrado.<br>";
        }
        ?>
        </tbody>
    </table>
</div> <!-- Fecha Div dv2 -->
<br>
<!-- Relatório de totais -->

<div class="dv2">
    <center>
        <?php
        echo "Periodo de: ".date('d/m/Y', strtotime($_GET['dataInicial']))." a ".date('d/m/Y', strtotime($_GET['dataFinal']));
        ?>
        <br><br>

        <strong>Total de Itens </strong></center>

    <table border="1" bordercolor="#696969" style="border-collapse: collapse; width: 100%" cellpadding="2" bgcolor="#FFF">
        <thead>
        <tr bgcolor="#999999">
            <th><strong>Descri&ccedil;&atilde;o</strong></th>
            <th><strong>Qtde total</strong></th>
            <th><strong>Por Sec.</strong></th>
        </tr>
        </thead>
        <tbody>
        <?php

        include_once("PDOConnectionFactory.class.php");
        $conexao_db = new PDOConnectionFactory; // Cria a conexao ja no construtor

        $rs = $conexao_db->con->query("SELECT SUM(qtde) qtde, descricao FROM saidas WHERE data BETWEEN '".$_GET['dataInicial']."' AND '".$_GET['dataFinal']."' GROUP BY descricao");

        $rs->execute();

        if($rs->rowCount() > 0){

            while($row = $rs->fetch(PDO::FETCH_OBJ)){
                echo "<tr>"; // Abre Linha Tabela
                echo "<td align=\"center\"><a href='itemPorSec.php?descricao=".$row->descricao."&dataInicial=".$_GET['dataInicial']."&dataFinal=".$_GET['dataFinal']."' rel='superbox[iframe]' title='Qtde retirada por secretaria'>".$row->descricao."</a></td>";
                echo "<td align=\"center\"><a href='itemPorSec.php?descricao=".$row->descricao."&dataInicial=".$_GET['dataInicial']."&dataFinal=".$_GET['dataFinal']."' rel='superbox[iframe]' title='Qtde retirada por secretaria'>".$row->qtde."</a></td>";
                echo "<td align=\"center\"><a href='itemPorSec.php?descricao=".$row->descricao."&dataInicial=".$_GET['dataInicial']."&dataFinal=".$_GET['dataFinal']."' rel='superbox[iframe]' title='Qtde retirada por secretaria'>Por Sec.</a></td>";
                echo "</tr>"; // Fecha Linha Tabela
            } // Fecha While

        }else{ // Se linhas afetadas forem 0...
            echo "Nenhum Registro encontrado.<br>";
        }
        ?>
        </tbody>
    </table>
</div> <!-- Fecha Div dv2 -->

</body>

</html>