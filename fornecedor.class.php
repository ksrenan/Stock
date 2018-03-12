<?php
class Fornecedor{
	private $id;
	private $razaoSocial;
	private $CNPJ;
	private $IE; // Inscrição Estadual
	private $telefone;
	private $CEP;
	private $endereco;
	private $bairro;
	private $cidade;
	private $estado;
	private $nomeContato;
	private $emailContato;
	
	public function getId(){
		return $this->id;
	}

	public function setId($id){
		$this->id = $id;
	}

	public function getRazaoSocial(){
		return $this->razaoSocial;
	}

	public function setRazaoSocial($razaoSocial){
		$this->razaoSocial = $razaoSocial;
	}

	public function getCNPJ(){
		return $this->CNPJ;
	}

	public function setCNPJ($CNPJ){
		$this->CNPJ = $CNPJ;
	}

	public function getIE(){
		return $this->IE;
	}

	public function setIE($IE){
		$this->IE = $IE;
	}

	public function getTelefone(){
		return $this->telefone;
	}

	public function setTelefone($telefone){
		$this->telefone = $telefone;
	}

	public function getCEP(){
		return $this->CEP;
	}

	public function setCEP($CEP){
		$this->CEP = $CEP;
	}

	public function getEndereco(){
		return $this->endereco;
	}

	public function setEndereco($endereco){
		$this->endereco = $endereco;
	}

	public function getBairro(){
		return $this->bairro;
	}

	public function setBairro($bairro){
		$this->bairro = $bairro;
	}

	public function getCidade(){
		return $this->cidade;
	}

	public function setCidade($cidade){
		$this->cidade = $cidade;
	}

	public function getEstado(){
		return $this->estado;
	}

	public function setEstado($estado){
		$this->estado = $estado;
	}

	public function getNomeContato(){
		return $this->nomeContato;
	}

	public function setNomeContato($nomeContato){
		$this->nomeContato = $nomeContato;
	}

	public function getEmailContato(){
		return $this->emailContato;
	}

	public function setEmailContato($emailContato){
		$this->emailContato = $emailContato;
	}
}
?>