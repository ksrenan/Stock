<?php
class PDOConnectionFactory{
	
	public $con = null;
    public $dbType = "mysql"; // Tipo de BD
    public $host = "localhost";
    public $user = "root";
    public $senha = "123";
    public $db = "stock";
    public $persistent = true; // permitir a persistencia da conexão para todas as páginas para deixar a conexão mais rápida
	
	function __construct(){ // Construtor
		$this->getConnection();
	}
	
	public function getConnection(){
		try{
			$this->con = new PDO($this->dbType.":host=".$this->host.";dbname=".$this->db, $this->user, $this->senha,
      			array( PDO::ATTR_PERSISTENT => $this->persistent ) );
      			return $this->con;
      	}catch ( PDOException $ex ){
			echo "Erro: ".$ex->getMessage();
		}
	}
	public function Close(){
		if( $this->con != null )
			$this->con = null;
	}
}
?>