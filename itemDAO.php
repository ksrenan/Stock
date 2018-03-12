<?php
error_reporting(0); // Nao reportar erros
ini_set("display_errors", 0 ); // Nao reportar erros
include_once("PDOConnectionFactory.class.php"); // include da classe de conexao

class ItemDAO{

	function insert($item){
		
		$conexao_db = new PDOConnectionFactory; // Criando conexao
		
		try{
			$conexao_db = new PDOConnectionFactory;
			$stmt = $conexao_db->con->prepare("INSERT INTO itens(descricao, marca, modelo, observacao, patrimoniar) VALUES(?, ?, ?, ?, ?)");
			$stmt->bindParam(1,$item->getDescricao());
			$stmt->bindParam(2,$item->getMarca());
			$stmt->bindParam(3,$item->getModelo());
			$stmt->bindParam(4,$item->getObservacao());
			$stmt->bindParam(5,$item->getPatrimoniar());
			$stmt->execute();
			return("Item cadastrado com Sucesso");
		}catch(PDOException $ex){
			return("Erro na Insercao do Item");
		}
	}

	function update($item){
		
		$conexao_db = new PDOConnectionFactory; // Criando conexao
		
		try{
			$conexao_db = new PDOConnectionFactory;
			$stmt = $conexao_db->con->prepare("UPDATE itens SET descricao=?, marca=?, modelo=?, observacao=?, patrimoniar=? WHERE codigo=?");
			$stmt->bindParam(1,$item->getDescricao());
			$stmt->bindParam(2,$item->getMarca());
			$stmt->bindParam(3,$item->getModelo());
			$stmt->bindParam(4,$item->getObservacao());
			$stmt->bindParam(5,$item->getPatrimoniar());
			$stmt->bindParam(6,$item->getCodigo());
			$stmt->execute();
			// ---------------------- Atualiza descricao do item TAMBÉM na tabela de itens em estoque
			$stmtItemStock = $conexao_db->con->prepare("UPDATE itens_estoque SET descricao=? WHERE codigo=?");
			$stmtItemStock->bindParam(1,$item->getDescricao());
			$stmtItemStock->bindParam(2,$item->getCodigo());
			$stmtItemStock->execute();
			// ---------------------------------------------------------------------------------------
			// ---------------------- Atualiza descrição do item TAMBÉM na tabela de itens dessa entrada
			$stmtItemStock = $conexao_db->con->prepare("UPDATE itens_entrada SET descricao=? WHERE codigo=?");
			$stmtItemStock->bindParam(1,$item->getDescricao());
			$stmtItemStock->bindParam(2,$item->getCodigo());
			$stmtItemStock->execute();
			// ---------------------------------------------------------------------------------------
			
			return("Item atualizado com Sucesso");
		}catch(PDOException $ex){
			return("Erro na atualizacao do Item");
		}
	}
	
}
?>