<?php
class Item{
	private $codigo;
	private $descricao;
	private $marca;
	private $modelo;
	private $observacao;
	private $patrimoniar;
	
	public function getCodigo(){
		return $this->codigo;
	}

	public function setCodigo($codigo){
		$this->codigo = $codigo;
	}

	public function getObservacao(){
		return $this->observacao;
	}

	public function setObservacao($observacao){
		$this->observacao = $observacao;
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
}
?>