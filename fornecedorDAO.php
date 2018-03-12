<?php
error_reporting(0); // Não reportar erros
ini_set("display_errors", 0 ); // Não reportar erros
include_once("PDOConnectionFactory.class.php"); // include da classe de conexão

class fornecedorDAO{

	function insert($fornecedor){
		
		$conexao_db = new PDOConnectionFactory; // Criando conexão

		try{
			$stmt = $conexao_db->con->prepare("INSERT INTO fornecedores(razaoSocial, cnpj, ie, telefone, cep, endereco, cidade, uf, bairro, contato, email) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
			$stmt->bindParam(1,$fornecedor->getRazaoSocial());
			$stmt->bindParam(2,$fornecedor->getCNPJ());
			$stmt->bindParam(3,$fornecedor->getIE());
			$stmt->bindParam(4,$fornecedor->getTelefone());
			$stmt->bindParam(5,$fornecedor->getCEP());
			$stmt->bindParam(6,$fornecedor->getEndereco());
			$stmt->bindParam(7,$fornecedor->getCidade());
			$stmt->bindParam(8,$fornecedor->getEstado());
			$stmt->bindParam(9,$fornecedor->getBairro());
			$stmt->bindParam(10,$fornecedor->getNomeContato());
			$stmt->bindParam(11,$fornecedor->getEmailContato());
			$stmt->execute();
			return("Fornecedor cadastrado com Sucesso");
		}catch(PDOException $ex){
			return("Erro no cadastro do Fornecedor");
		}
	}
	
	function retornaUltimo(){
		
		$conexao_db = new PDOConnectionFactory; // Criando conexão
		
		try{
			$stmt = $conexao_db->con->query("SELECT codigo, razaoSocial FROM fornecedores ORDER BY codigo DESC LIMIT 1");
			$row = $stmt->fetch(PDO::FETCH_OBJ);
			return($row);
		}catch(PDOException $ex){
			return("");
		}

	}
}
?>