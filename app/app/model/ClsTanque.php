<?php

namespace App\model;

use App\model\Conexao;

abstract class ClsTanque extends Conexao{

	private $id;
	private $idCliente;
	private $placa;
	private $capacidade;
	private $limite;
	private $quantidade;
	private $tipocombustivel;
	private $unidadeMedida;
	private $strCampo;
	private $strValor;	

	public $tabela = "tbtanque";
	public $keyId = "id_tanque";
	
    public function getId(){ return $this->id; }
	public function setId($id){ $this->id = $id; }
    
	public function getNome(){ return $this->nome; }	
	public function setNome($nome){ $this->nome = $nome; }

	public function getIdCliente(){ return $this->idCliente; }	
	public function setIdCliente($idCliente){ $this->idCliente = $idCliente; }

	public function getQuantidade(){ return $this->quantidade; }	
	public function setQuantidade($quantidade){ $this->quantidade = $quantidade; }

	public function getLimite(){ return $this->limite; }	
	public function setLimite($limite){ $this->limite = $limite; }

	public function getCapacidade(){ return $this->capacidade; }	
	public function setCapacidade($capacidade){ $this->capacidade = $capacidade; }
	
	public function getCombustivel(){ return $this->tipocombustivel; }	
	public function setCombustivel($tipocombustivel){ $this->tipocombustivel = $tipocombustivel; }

	public function getUnidadeMedida(){ return $this->unidadeMedida; }	
	public function setUnidadeMedida($unidadeMedida){ $this->unidadeMedida = $unidadeMedida; }

}

interface itfTanque{
	
	function cadastrar(ClsTanque $objClass);
	function atualizar(ClsTanque $objClass);
	function deletar(ClsTanque $objClass);
	function buscar_id(ClsTanque $objClass);
	function ifExist(ClsTanque $objClass);
	function ifExistId(ClsTanque $objClass);
	function listar(ClsTanque $objClass);
	function listarTodos(ClsTanque $objClass);
	function listar_combo(ClsTanque $objClass);
	function count(ClsTanque $objClass);
	function capacidadeCombustivelPorTanque(ClsTanque $objClass);
}

class DaoTanque implements itfTanque{

	public function cadastrar(ClsTanque $objClass){
	
		$pdo = Conexao::getConn();
		
		$sql = " INSERT INTO ".$objClass->tabela." (nome_tanque, id_cliente, capacidade, alerta_limite, id_combustivel, id_medida)
		 values (:nome_tanque, :id_cliente,:capacidade, :alerta_limite, :id_combustivel, :id_medida)";
		
		$stmt = $pdo->prepare($sql);
		$stmt->bindValue(":nome_tanque", $objClass->getNome());
		$stmt->bindValue(":id_cliente", $objClass->getIdCliente());
		$stmt->bindValue(":capacidade", $objClass->getCapacidade());
		$stmt->bindValue(":alerta_limite", $objClass->getLimite());
		$stmt->bindValue(":id_combustivel", $objClass->getCombustivel());
		$stmt->bindValue(":id_medida", $objClass->getUnidadeMedida());
		$stmt->execute();

		return $pdo->lastInsertId();
	}

	public function atualizar(ClsTanque $objClass){
		$pdo = Conexao::getConn();
		
		$sql = "UPDATE ".$objClass->tabela." SET ";
		$sql .= "nome_modelo = :nome_modelo ";		
		$sql .= " WHERE ".$objClass->keyId." = :id_veiculo";

		$stmt = $pdo->prepare($sql);
		$stmt->bindvalue(":id_veiculo",$objClass->getId());
		$stmt->bindValue(":nome_modelo",$objClass->getPlaca());
		$stmt->execute();

		return 1;
	}


	public function deletar(ClsTanque $objClass){
		$pdo = Conexao::getConn();

		$sql = "UPDATE ".$objClass->tabela." SET flag_excluido = 1  WHERE ".$objClass->keyId." = :id_tanque AND id_cliente = :id_cliente";
		$stmt = $pdo->prepare($sql);
		$stmt->bindValue(":id_tanque",$objClass->getId()); 
		$stmt->bindValue(":id_cliente", $_SESSION['id_cliente']);
		$stmt->execute();
		
		return 1;			
        
		$db->close();
	}

	public function buscar_id(ClsTanque $objClass)
	{	
        $pdo = Conexao::getConn();
		
		$sql = "SELECT * FROM ".$objClass->tabela." WHERE ".$objClass->keyId." = :id";
		
		$stmt = $pdo->prepare($sql);
		$stmt->bindValue(":id",$objClass->getId()); 
		$stmt->execute();
		$objResultado = $stmt->fetch(\PDO::FETCH_ASSOC);

		return $objResultado;
	}

	public function ifExist(ClsTanque $objClass)
	{
		$pdo = Conexao::getConn();
		
		$sql = "select * ";
		$sql .= "from ".$objClass->tabela;
		$sql .= " where ".$objClass->getStrCampo()." = '".$objClass->getStrValor()."'";
		if (trim($objClass->getId()) != "") {
			$sql .= " and ".$objClass->keyId." <> ".$objClass->getId().";";
		}
		
		$stmt = $pdo->prepare($sql);
		$stmt->execute();//Executa A Query

		$objResultado = $stmt->fetchAll(\PDO::FETCH_ASSOC);

		return count($objResultado);
	}

	public function ifExistId(ClsTanque $objClass){

        $pdo = Conexao::getConn();
		
		$sql = "select * ";
		$sql .= "from ".$objClass->tabela;
		$sql .= " where ".$objClass->getStrCampo()." = '".$objClass->getStrValor()."';";
		$stmt = $pdo->prepare($sql);
		$stmt->execute();

		$objResultado = $stmt->fetchAll(\PDO::FETCH_ASSOC);

		return count($objResultado);
	}

	# Usado com parametros de paginacao LIMIT e ORDER BY
	public function listar(ClsTanque $objClass){
		
        $pdo = Conexao::getConn();
		
		$sql = "SELECT * FROM ".$objClass->tabela." a
			INNER JOIN tbcategoria_combustivel b ON (b.id_combustivel = a.id_combustivel)
			INNER JOIN tbunidade_medida c ON (c.id_medida = a.id_medida) 
		WHERE a.id_cliente = ".$_SESSION['id_cliente']." AND a.flag_excluido = 0";
		
		$stmt = $pdo->prepare($sql);
		$stmt->execute();

		$objResultado = $stmt->fetchAll(\PDO::FETCH_ASSOC);

		return $objResultado;
	}

	# Usado nos relatorios 
	public function listarTodos(ClsTanque $objClass){
		
        $pdo = Conexao::getConn();
		
		$sql = "SELECT * FROM ".$objClass->tabela." a
			INNER JOIN tbcategoria_combustivel b ON (b.id_combustivel = a.id_combustivel)
			INNER JOIN tbunidade_medida c ON (c.id_medida = a.id_medida) 
		WHERE a.id_cliente = ".$_SESSION['id_cliente']." 
		AND a.id_combustivel IN(".implode(',', $objClass->getCombustivel()).") 
		AND a.flag_excluido = 0";
		
		$stmt = $pdo->prepare($sql);
		$stmt->execute();

		$objResultado = $stmt->fetchAll(\PDO::FETCH_ASSOC);

		return $objResultado;
	}

	public function capacidadeCombustivelPorTanque(ClsTanque $objClass){
		
        $pdo = Conexao::getConn();
		
		$sql = "SELECT capacidade FROM ".$objClass->tabela."
		WHERE ".$objClass->keyId." = :id_tanque";

		$stmt = $pdo->prepare($sql);
		$stmt->bindValue(":id_tanque",$objClass->getId()); 
		$stmt->execute();

		$objResultado = $stmt->fetchAll(\PDO::FETCH_ASSOC);

		return $objResultado;
	}

	public function listar_combo(ClsTanque $objClass){
		// Cria o objeto PDO
        $pdo = Conexao::getConn();
		
		$sql = "SELECT id_veiculo, name FROM ".$objClass->tabela." where id not in (1) order by name asc;";

		$stmt = $pdo->prepare($sql);
		$stmt->execute();

		return $stmt->fetchAll(\PDO::FETCH_ASSOC);
	}

	public function count(ClsTanque $objClass){
		// Cria o objeto PDO
        $pdo = Conexao::getConn();
		
		$sql = "SELECT COUNT(*) as Qtd from ".$objClass->tabela.";";

		$stmt = $pdo->prepare($sql);
		$stmt->execute();//Executa A Query

		return $stmt->fetchColumn();
	}
}

?>