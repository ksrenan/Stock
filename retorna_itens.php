<?php
	echo "<option value=''>..::Selecione o Item::..</option>";

	include_once("PDOConnectionFactory.class.php");
	$conexao_db = new PDOConnectionFactory;
	
	$rs = $conexao_db->con->query("SELECT codigo, descricao FROM itens ORDER BY codigo");
	
	if($rs->rowCount() > 0){
		while($row = $rs->fetch(PDO::FETCH_OBJ)){
			echo "<option value='".$row->codigo."'>".$row->descricao."</option>";
		}
	}
	
	echo "<option value='naoListado'>Item n&atilde;o listado, Cadastrar NOVO</option>";
?>
