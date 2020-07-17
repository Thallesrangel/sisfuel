<?php

namespace App\model;

use App\model\Conexao;

abstract class ClsFabricante extends Conexao{

	private $id;
	private $name;
	private $password;
	private $strCampo;
	private $strValor;

	public $tabela = "tbveiculo_fabricante";
	public $keyId = "id_fabricante ";
	
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

interface itfFabricante{

	function cadastrar(ClsFabricante $objClass);
	function atualizar(ClsFabricante $objClass);
	function deletar(ClsFabricante $objClass);
	function buscar_id(ClsFabricante $objClass);
	function ifExist(ClsFabricante $objClass);
	function ifExistId(ClsFabricante $objClass);
	function listar(ClsFabricante $objClass);
	function listar_combo(ClsFabricante $objClass);
	function count(ClsFabricante $objClass);
}

class DaoFabricante implements itfFabricante{

	public function cadastrar(ClsFabricante $objClass)
	{
		$pdo = Conexao::getConn();
		$sql = " INSERT INTO ".$objClass->tabela." (nome_fabricante
        ) values (:nome_fabricante);";
		$stmt = $pdo->prepare($sql);
		$stmt->bindValue(":nome_fabricante", $objClass->getNome());
		$stmt->execute();

		return $pdo->lastInsertId();
	}

	public function atualizar(ClsFabricante $objClass)
	{
		$pdo = Conexao::getConn();
		$sql = "UPDATE ".$objClass->tabela." SET ";
		$sql .= "nome_modelo = :nome_modelo ";		
		$sql .= " WHERE ".$objClass->keyId." = :id_modelo";

		$stmt = $pdo->prepare($sql);
		$stmt->bindvalue(":id_modelo",$objClass->getId());
		$stmt->bindValue(":nome_modelo",$objClass->getNome());
		$stmt->execute();
	

		return 1;
	}

	public function deletar(ClsFabricante $objClass)
	{
		$pdo = Conexao::getConn();

		if (intval($objClass->getId()) == 1) {
			return 0;	
		} else {
			
			$sql = "DELETE FROM ".$objClass->tabela." WHERE ".$objClass->keyId." = :id_fabricante AND ".$objClass->keyId." >= 1";
			$stmt = $pdo->prepare($sql);
			$stmt->bindValue(":id_fabricante",$objClass->getId()); 
			$stmt->execute();
			
			return 1;			
        }
		$db->close();
	}

	public function buscar_id(ClsFabricante $objClass)
	{
        $pdo = Conexao::getConn();
		$sql = "SELECT * FROM ".$objClass->tabela." WHERE ".$objClass->keyId." = :id";
		$stmt = $pdo->prepare($sql);
		$stmt->bindValue(":id",$objClass->getId());
		$stmt->execute();

		$objResultado = $stmt->fetch(\PDO::FETCH_ASSOC);

		return $objResultado;
	}

	public function ifExist(ClsFabricante $objClass)
	{
		$pdo = Conexao::getConn();
		
		$sql = "SELECT * ";
		$sql .= "FROM ".$objClass->tabela;
		$sql .= " WHERE ".$objClass->getStrCampo()." = '".$objClass->getStrValor()."'";
		if (trim($objClass->getId()) != "") {
			$sql .= " and ".$objClass->keyId." <> ".$objClass->getId().";";
		}
		$stmt = $pdo->prepare($sql);
		$stmt->execute();

		$objResultado = $stmt->fetchAll(\PDO::FETCH_ASSOC);

		return count($objResultado);
	}

	public function ifExistId(ClsFabricante $objClass)
	{
        $pdo = Conexao::getConn();
		$sql = "select * ";
		$sql .= "from ".$objClass->tabela;
		$sql .= " where ".$objClass->getStrCampo()." = '".$objClass->getStrValor()."';";
		$stmt = $pdo->prepare($sql);
		$stmt->execute();

		$objResultado = $stmt->fetchAll(\PDO::FETCH_ASSOC);

		return count($objResultado);
	}

	public function listar(ClsFabricante $objClass)
	{
        $pdo = Conexao::getConn();
		$sql = "SELECT * FROM ".$objClass->tabela." WHERE id_cliente = ".$_SESSION['id_cliente']." AND flag_excluido = 0";
		$stmt = $pdo->prepare($sql);
		$stmt->execute();
		$objResultado = $stmt->fetchAll(\PDO::FETCH_ASSOC);

		return $objResultado;
	}

	public function listar_combo(ClsFabricante $objClass)
	{
        $pdo = Conexao::getConn();
		$sql = "SELECT id, name FROM ".$objClass->tabela." WHERE id not in (1) order by name asc;";
		$stmt = $pdo->prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll(\PDO::FETCH_ASSOC);
	}

	public function count(ClsFabricante $objClass)
	{
        $pdo = Conexao::getConn();
		$sql = "select count(*) as Qtd from ".$objClass->tabela.";";
		$stmt = $pdo->prepare($sql);
		$stmt->execute();
		return $stmt->fetchColumn();
	}
}

?>