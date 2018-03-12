<?php
class Item{
	private $codigo;
	private $nome;
	private $descricao;
	private $marca;
	private $modelo;
	private $patrimoniar;
	private $codigoItem;
	
	public function getCodigo(){
		return $this->codigo;
	}

	public function setCodigo($codigo){
		$this->codigo = $codigo;
	}

	public function getNome(){
		return $this->nome;
	}

	public function setNome($nome){
		$this->nome = $nome;
	}

	public function getDescricao(){
		return $this->descricao;
	}

	public function setDescricao($descricao){
		$this->descricao = $descricao;
	}

	public function getMarca(){
		return $this->marca;
	}

	public function setMarca($marca){
		$this->marca = $marca;
	}

	public function getModelo(){
		return $this->modelo;
	}

	public function setModelo($modelo){
		$this->modelo = $modelo;
	}
	
	public function getPatrimoniar(){
		return $this->patrimoniar;
	}

	public function setPatrimoniar($patrimoniar){
		$this->patrimoniar = $patrimoniar;
	}

	public function getCodigoItem(){
		return $this->codigoItem;
	}

	public function setCodigoItem($codigoItem){
		$this->codigoItem = $codigoItem;
	}
}
?>