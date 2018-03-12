<?php
class verificaPermissao{	
	public function verificaPermissao($permissao){
		
		if(empty($_COOKIE['usuario'])){ // Se cookie usuário estiver vazio
			header("Location:login.php");
			die; // Morra
		}else{
		
		$matricula = $_COOKIE['usuario'];
		
		require_once("PDOConnectionFactory.class.php");
		$conexao_db = new PDOConnectionFactory; // Cria a conexão no construtor

		$rs = $conexao_db->con->prepare("SELECT nivelAcesso FROM usuarios WHERE matricula = ?");
		$rs->bindParam(1,$matricula);
		$rs->execute();

		if($rs->rowCount() > 0){
		$row = $rs->fetch(PDO::FETCH_OBJ);
	
		$nivelAcesso = $row->nivelAcesso;
	
		$modulos = explode("|", $nivelAcesso);

		$autorizado = NULL;

		foreach($modulos as $value){
			if(strcasecmp($value, $permissao) == 0){
				$autorizado = true; // Tem permissão para ver Relatórios
			}
		}
		if($autorizado == NULL){
			die("<br><br><br>Voc&ecirc; n&atilde;o tem privil&eacute;gios para acessar esta p&aacute;gina | <a href=\"index.php\">Inicio</a><br>");
		}
		}else{
		die("<br><br><br>N&atilde;o foi poss&iacute;vel obter seu n&iacute;vel de Acesso | <a href=\"index.php\">Inicio</a><br>");
		}
		}
	}
}
?>