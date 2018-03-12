<?php
error_reporting(0); // Não reportar erros
ini_set("display_errors", 0 ); // Não reportar erros
include_once("PDOConnectionFactory.class.php"); // include da classe de conexão

class TermoDAO{

	function update($termo){
		$conexao_db = new PDOConnectionFactory; // Criando conexão

		try{
			$stmt = $conexao_db->con->prepare("UPDATE termos SET nome=?, matricula=?, cpf=?, secretaria=?, depto_divisao=?, local=?, item=?, patrimonio=?, nSuporte=? WHERE id = ?");	
			$stmt->bindParam(1,$termo->getNome());
			$stmt->bindParam(2,$termo->getMatricula());
			$stmt->bindParam(3,$termo->getCpf());
			$stmt->bindParam(4,$termo->getSecretaria());
			$stmt->bindParam(5,$termo->getDepto_divisao());
			$stmt->bindParam(6,$termo->getLocal());
			$stmt->bindParam(7,$termo->getItem());
			$stmt->bindParam(8,$termo->getPatrimonio());
			$stmt->bindParam(9,$termo->getNSuporte());
			$stmt->bindParam(10,$termo->getCodigo());
			$stmt->execute();
			return("Termo atualizado com Sucesso");
		}catch(PDOException $ex){
			return("Erro na atualizacao do termo");
		}
	}
}
?>