<?php

namespace App\model;

use App\model\Conexao;

abstract class ClsCatVeiculo extends Conexao{

	private $id;
	private $name;
	private $password;

	// Paginacao
	private $pagina_inicial;
	private $registo_por_pagina;

	private $strCampo;
	private $strValor;
	

	public $tabela = "tbcategoria_veiculo";
	public $keyId = "id_categoria_veiculo";
	
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

interface itfCatVeiculo
{
	function cadastrar(ClsCatVeiculo $objClass);
	function atualizar(ClsCatVeiculo $objClass);
	function deletar(ClsCatVeiculo $objClass);
	function buscar_id(ClsCatVeiculo $objClass);
	function ifExist(ClsCatVeiculo $objClass);
	function ifExistId(ClsCatVeiculo $objClass);
	function listar(ClsCatVeiculo $objClass);
	function listar_combo(ClsCatVeiculo $objClass);
	function count(ClsCatVeiculo $objClass);
}

class DaoCatVeiculo implements itfCatVeiculo
{

	public function cadastrar(ClsCatVeiculo $objClass)
	{
		$pdo = Conexao::getConn();
		
		$sql = " INSERT INTO ".$objClass->tabela." (categoria_veiculo
        ) values (:categoria_veiculo);";
		
		$stmt = $pdo->prepare($sql);
		$stmt->bindValue(":categoria_veiculo", $objClass->getNome());
		$stmt->execute();

		return $pdo->lastInsertId();
	}

	public function atualizar(ClsCatVeiculo $objClass)
	{
		$pdo = Conexao::getConn();
		
		$sql = "UPDATE ".$objClass->tabela." SET ";
		$sql .= "categoria_veiculo = :categoria_veiculo";		
		$sql .= " WHERE ".$objClass->keyId." = :id_categoria_veiculo";

		$stmt = $pdo->prepare($sql);
		$stmt->bindvalue(":id_categoria_veiculo",$objClass->getId());
		$stmt->bindValue(":categoria_veiculo",$objClass->getNome());
		$stmt->execute();

		return 1;
	}

	public function deletar(ClsCatVeiculo $objClass)
	{
		$pdo = Conexao::getConn();

		if (intval($objClass->getId()) == 1) {
			return 0;	
		} else {
			
			$sql = "DELETE FROM ".$objClass->tabela." WHERE ".$objClass->keyId." = :id_categoria_veiculo AND ".$objClass->keyId." <> 1";
		
			$stmt = $pdo->prepare($sql);
			$stmt->bindValue(":id_categoria_veiculo",$objClass->getId()); 
			$stmt->execute();
			
			return 1;			
        }
		$db->close();
	}

	public function buscar_id(ClsCatVeiculo $objClass){
		// Cria o objeto PDO
        $pdo = Conexao::getConn();
		
		$sql = "SELECT * FROM ".$objClass->tabela." WHERE ".$objClass->keyId." = :id";
		
		$stmt = $pdo->prepare($sql);
		$stmt->bindValue(":id",$objClass->getId()); //Troca Pseudonomes por valores
		$stmt->execute();//Executa A Query

		$objResultado = $stmt->fetch(\PDO::FETCH_ASSOC);

		return $objResultado;
	}

	public function ifExist(ClsCatVeiculo $objClass)
	{
		$pdo = Conexao::getConn();
		
		$sql = "SELECT * ";
		$sql .= "FROM ".$objClass->tabela;
		$sql .= " WHERE ".$objClass->getStrCampo()." = '".$objClass->getStrValor()."'";
		if (trim($objClass->getId()) != "") {
			$sql .= " AND ".$objClass->keyId." <> ".$objClass->getId().";";
		}
		
		$stmt = $pdo->prepare($sql);
		$stmt->execute();

		$objResultado = $stmt->fetchAll(\PDO::FETCH_ASSOC);

		return count($objResultado);
	}

	public function ifExistId(ClsCatVeiculo $objClass)
	{
        $pdo = Conexao::getConn();
		
		$sql = "SELECT * ";
		$sql .= "FROM ".$objClass->tabela;
		$sql .= "WHERE " . $objClass->getStrCampo()." = '" . $objClass->getStrValor() . "';";
		
		$stmt = $pdo->prepare($sql);
		$stmt->execute();

		$objResultado = $stmt->fetchAll(\PDO::FETCH_ASSOC);

		return count($objResultado);
	}

	public function listar(ClsCatVeiculo $objClass)
	{
        $pdo = Conexao::getConn();
		
		$sql = "SELECT * FROM ".$objClass->tabela.";";
		
		$stmt = $pdo->prepare($sql);
		$stmt->execute();

		$objResultado = $stmt->fetchAll(\PDO::FETCH_ASSOC);

		return $objResultado;
	}

	public function listar_combo(ClsCatVeiculo $objClass)
	{
        $pdo = Conexao::getConn();
		
		$sql = "SELECT id, name FROM ".$objClass->tabela." WHERE id not in (1) order by name ASC;";

		$stmt = $pdo->prepare($sql);
		$stmt->execute();

		return $stmt->fetchAll(\PDO::FETCH_ASSOC);
	}

	public function count(ClsCatVeiculo $objClass)
	{
        $pdo = Conexao::getConn();
		
		$sql = "SELECT count(*) AS Qtd FROM ".$objClass->tabela.";";

		$stmt = $pdo->prepare($sql);
		$stmt->execute();

		return $stmt->fetchColumn();
	}
}

?>