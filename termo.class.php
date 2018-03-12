<?php
class Termo{

private $codigo;
private $nome;
private $matricula;
private $cpf;
private $secretaria;
private $depto_divisao;
private $local;
private $item;
private $patrimonio;
private $nSuporte;

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

	public function getMatricula(){
		return $this->matricula;
	}

	public function setMatricula($matricula){
		$this->matricula = $matricula;
	}

	public function getCpf(){
		return $this->cpf;
	}

	public function setCpf($cpf){
		$this->cpf = $cpf;
	}

	public function getSecretaria(){
		return $this->secretaria;
	}

	public function setSecretaria($secretaria){
		$this->secretaria = $secretaria;
	}

	public function getDepto_divisao(){
		return $this->depto_divisao;
	}

	public function setDepto_divisao($depto_divisao){
		$this->depto_divisao = $depto_divisao;
	}

	public function getLocal(){
		return $this->local;
	}

	public function setLocal($local){
		$this->local = $local;
	}

	public function getItem(){
		return $this->item;
	}

	public function setItem($item){
		$this->item = $item;
	}

	public function getPatrimonio(){
		return $this->patrimonio;
	}

	public function setPatrimonio($patrimonio){
		$this->patrimonio = $patrimonio;
	}

	public function getNSuporte(){
		return $this->nSuporte;
	}

	public function setNSuporte($nSuporte){
		$this->nSuporte = $nSuporte;
	}
	
}
?>