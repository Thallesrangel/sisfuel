<?php

namespace App\model;

use App\model\Conexao;

abstract class ClsCatCombustivel extends Conexao{

	private $id;
	private $name;
	private $password;

	// Paginacao
	private $pagina_inicial;
	private $registo_por_pagina;

	private $strCampo;
	private $strValor;

	public $tabela = "tbcategoria_combustivel";
	public $keyId = "id_combustivel";
	
    public function getId(){ return $this->id; }
	public function setId($id){ $this->id = $id; }
    
	public function getNome(){ return $this->name; }	
	public function setNome($name){ $this->name = $name; }

	// Paginacao 
	public function getPaginaInicial(){ return $this->pagina_inicial; }
	public function setPaginaInicial($pagina_inicial){ $this->pagina_inicial = $pagina_inicial; }

	public function getRegistroPorPagina(){ return $this->registo_por_pagina; }
	public function setRegistroPorPagina($registo_por_pagina) { $this->registo_por_pagina = $registo_por_pagina; }

}

interface itfCatCombustivel{

	function cadastrar(ClsCatCombustivel $objClass);
	function atualizar(ClsCatCombustivel $objClass);
	function deletar(ClsCatCombustivel $objClass);
	function buscar_id(ClsCatCombustivel $objClass);
	function ifExist(ClsCatCombustivel $objClass);
	function ifExistId(ClsCatCombustivel $objClass);
	function listar(ClsCatCombustivel $objClass);
	function selectCombustivel(ClsCatCombustivel $objClass);
	function listar_combo(ClsCatCombustivel $objClass);
	function count(ClsCatCombustivel $objClass);
}

class DaoCatCombustivel implements itfCatCombustivel{

	public function cadastrar(ClsCatCombustivel $objClass){
	
		$pdo = Conexao::getConn();
		
		$sql = " INSERT INTO ".$objClass->tabela." (categoria_combustivel) values (:categoria_combustivel);";
		
		$stmt = $pdo->prepare($sql);
		$stmt->bindValue(":categoria_combustivel", $objClass->getNome());
		$stmt->execute();

		return $pdo->lastInsertId();
	}

	public function atualizar(ClsCatCombustivel $objClass){
		$pdo = Conexao::getConn();
		
		$sql = "UPDATE ".$objClass->tabela." SET ";
		$sql .= "categoria_combustivel = :categoria_combustivel ";		
		$sql .= " WHERE ".$objClass->keyId." = :id_combustivel";

		$stmt = $pdo->prepare($sql);
		$stmt->bindvalue(":id_combustivel",$objClass->getId());
		$stmt->bindValue(":categoria_combustivel",$objClass->getNome());
		$stmt->execute();
	

		return 1;
	}

	public function deletar(ClsCatCombustivel $objClass){
		$pdo = Conexao::getConn();

		if (intval($objClass->getId()) == 1) {
			return 0;	
		} else {
			
			$sql = "DELETE FROM ".$objClass->tabela." WHERE ".$objClass->keyId." = :id_combustivel AND ".$objClass->keyId." <> 1";
		
			$stmt = $pdo->prepare($sql);
			$stmt->bindValue(":id_combustivel",$objClass->getId()); 
			$stmt->execute();
			
			return 1;			
        }
		$db->close();
	}

	public function buscar_id(ClsCatCombustivel $objClass){
		// Cria o objeto PDO
        $pdo = Conexao::getConn();
		
		$sql = "SELECT * FROM ".$objClass->tabela." WHERE ".$objClass->keyId." = :id";
		
		$stmt = $pdo->prepare($sql);
		$stmt->bindValue(":id",$objClass->getId()); //Troca Pseudonomes por valores
		$stmt->execute();//Executa A Query

		$objResultado = $stmt->fetch(\PDO::FETCH_ASSOC);

		return $objResultado;
	}

	public function ifExist(ClsCatCombustivel $objClass){

		// Cria o objeto PDO
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

	public function ifExistId(ClsCatCombustivel $objClass){

		// Cria o objeto PDO
        $pdo = Conexao::getConn();
		
		$sql = "select * ";
		$sql .= "from ".$objClass->tabela;
		$sql .= " where ".$objClass->getStrCampo()." = '".$objClass->getStrValor()."';";
		
		$stmt = $pdo->prepare($sql);
		$stmt->execute();//Executa A Query

		$objResultado = $stmt->fetchAll(\PDO::FETCH_ASSOC);

		return count($objResultado);
	}

	public function listar(ClsCatCombustivel $objClass){
		
		// Cria o objeto PDO
        $pdo = Conexao::getConn();
		
		$sql = "select * from ".$objClass->tabela.";";
		
		$stmt = $pdo->prepare($sql);
		$stmt->execute();//Executa A Query

		$objResultado = $stmt->fetchAll(\PDO::FETCH_ASSOC);

		return $objResultado;
	}

	public function selectCombustivel(ClsCatCombustivel $objClass){
        $pdo = Conexao::getConn();
		
		$sql = "SELECT * FROM ".$objClass->tabela.";";
		
		$stmt = $pdo->prepare($sql);
		$stmt->execute();

		$objResultado = $stmt->fetchAll(\PDO::FETCH_ASSOC);

		return $objResultado;
	}

	public function listar_combo(ClsCatCombustivel $objClass){
        $pdo = Conexao::getConn();
		
		$sql = "select id, name from ".$objClass->tabela." where id not in (1) order by name asc;";

		$stmt = $pdo->prepare($sql);
		$stmt->execute();

		return $stmt->fetchAll(\PDO::FETCH_ASSOC);
	}

	public function count(ClsCatCombustivel $objClass){
		// Cria o objeto PDO
        $pdo = Conexao::getConn();
		
		$sql = "select count(*) as Qtd from ".$objClass->tabela.";";

		$stmt = $pdo->prepare($sql);
		$stmt->execute();

		return $stmt->fetchColumn();
	}
}