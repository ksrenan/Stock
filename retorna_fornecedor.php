<?php
echo "<option value='' selected='selected'>..::Selecione o Fornecedor::..</option>";

	include_once("PDOConnectionFactory.class.php");
	$conexao_db = new PDOConnectionFactory;
	$stmt = $conexao_db->con->query("SELECT codigo, razaoSocial FROM fornecedores ORDER BY razaoSocial");

	if($stmt->rowCount() > 0){
		while($row = $stmt->fetch(PDO::FETCH_OBJ)){
			echo "<option value='".$row->codigo."'>".$row->razaoSocial."</option>";
		}
	}
	
echo "<option value='naoListado'>Fornecedor n&atilde;o listado, Cadastrar NOVO</option>";
?>