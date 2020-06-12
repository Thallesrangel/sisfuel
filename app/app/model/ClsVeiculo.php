<?php

namespace App\model;

use App\model\Conexao;

abstract class ClsVeiculo extends Conexao
{
	private $id;
	private $idCliente;
	private $placa;
	private $renavam;
	private $fabricante;
	private $tipocombustivel;
	private $categoriaveiculo;

	// Paginacao
	private $pagina_inicial;
	private $registo_por_pagina;

	private $strCampo;
	private $strValor;	
	
	public $tabela = "tbveiculo";
	public $keyId = "id_veiculo ";
	
    public function getId(){ return $this->id; }
	public function setId($id){ $this->id = $id; }

	public function getIdCliente (){ return $this->idCliente; }	
	public function setIdCliente($idCliente){ $this->idCliente = $idCliente; }
    
	public function getPlaca(){ return $this->placa; }	
	public function setPlaca($placa){ $this->placa = $placa; }

	public function getRenavam(){ return $this->renavam; }	
	public function setRenavam($renavam){ $this->renavam = $renavam; }

	public function getFabricante(){ return $this->fabricante; }	
	public function setFabricante($fabricante){ $this->fabricante = $fabricante; }
	
	public function getCombustivel(){ return $this->tipocombustivel; }	
	public function setCombustivel($tipocombustivel){ $this->tipocombustivel = $tipocombustivel; }

	public function getCatVeiculo(){ return $this->categoriaveiculo; }	
	public function setCatVeiculo($categoriaveiculo){ $this->categoriaveiculo = $categoriaveiculo; }

	// Paginacao 
	public function getPaginaInicial(){ return $this->pagina_inicial; }
	public function setPaginaInicial($pagina_inicial){ $this->pagina_inicial = $pagina_inicial; }

	public function getRegistroPorPagina(){ return $this->registo_por_pagina; }
	public function setRegistroPorPagina($registo_por_pagina) { $this->registo_por_pagina = $registo_por_pagina; }
}

interface itfVeiculo
{
	function cadastrar(ClsVeiculo $objClass);
	function atualizar(ClsVeiculo $objClass);
	function deletar(ClsVeiculo $objClass);
	function buscar_id(ClsVeiculo $objClass);
	function ifExist(ClsVeiculo $objClass);
	function ifExistId(ClsVeiculo $objClass);
	function listar(ClsVeiculo $objClass);
	function listarTodos(ClsVeiculo $objClass);
	function listar_combo(ClsVeiculo $objClass);
	function count(ClsVeiculo $objClass);
}

class DaoVeiculo implements itfVeiculo
{

	public function cadastrar(ClsVeiculo $objClass)
	{	
		$pdo = Conexao::getConn();
		$sql = " INSERT INTO ".$objClass->tabela." (placa, id_cliente, renavam, id_fabricante, id_combustivel, id_categoria_veiculo)
		 values (:placa, :id_cliente, :renavam, :id_fabricante, :id_combustivel,:id_categoria_veiculo);";

		$stmt = $pdo->prepare($sql);
		$stmt->bindValue(":placa", $objClass->getPlaca());
		$stmt->bindValue(":id_cliente", $objClass->getIdCliente());
		$stmt->bindValue(":renavam", $objClass->getRenavam());
		$stmt->bindValue(":id_fabricante", $objClass->getFabricante());
		$stmt->bindValue(":id_combustivel", $objClass->getCombustivel());
		$stmt->bindValue(":id_categoria_veiculo", $objClass->getCatVeiculo());

		$stmt->execute();

		return $pdo->lastInsertId();
	}

	public function atualizar(ClsVeiculo $objClass)
	{
		$pdo = Conexao::getConn();

		$sql = "UPDATE ".$objClass->tabela." SET ";
		$sql .= "nome_modelo = :nome_modelo ";		
		$sql .= "WHERE ".$objClass->keyId." = :id_veiculo";

		$stmt = $pdo->prepare($sql);
		$stmt->bindvalue(":id_veiculo",$objClass->getId());
		$stmt->bindValue(":nome_modelo",$objClass->getPlaca());
		$stmt->execute();
	

		return 1;
	}

	public function deletar(ClsVeiculo $objClass){
		$pdo = Conexao::getConn();

		$sql = "UPDATE ".$objClass->tabela." SET flag_excluido = 1  WHERE ".$objClass->keyId." = :id_veiculo AND id_cliente = :id_cliente";
		$stmt = $pdo->prepare($sql);
		$stmt->bindValue(":id_veiculo",$objClass->getId()); 
		$stmt->bindValue(":id_cliente", $_SESSION['id_cliente']);
		$stmt->execute();
		
		return 1;			
        
		$db->close();
	}

	public function buscar_id(ClsVeiculo $objClass)
	{		
        $pdo = Conexao::getConn();
		
		$sql = "SELECT * FROM ".$objClass->tabela." WHERE ".$objClass->keyId." = :id";
		
		$stmt = $pdo->prepare($sql);
		$stmt->bindValue(":id",$objClass->getId());
		$stmt->execute();

		$objResultado = $stmt->fetch(\PDO::FETCH_ASSOC);

		return $objResultado;
	}

	public function ifExist(ClsVeiculo $objClass)
	{
		$pdo = Conexao::getConn();
		
		$sql = "select * ";
		$sql .= "from ".$objClass->tabela;
		$sql .= " where ".$objClass->getStrCampo()." = '".$objClass->getStrValor()."'";
		if (trim($objClass->getId()) != "") {
			$sql .= " and ".$objClass->keyId." <> ".$objClass->getId().";";
		}
		
		$stmt = $pdo->prepare($sql);
		$stmt->execute();

		$objResultado = $stmt->fetchAll(\PDO::FETCH_ASSOC);

		return count($objResultado);
	}

	public function ifExistId(ClsVeiculo $objClass)
	{
        $pdo = Conexao::getConn();
		
		$sql = "select * ";
		$sql .= "from ".$objClass->tabela;
		$sql .= " where ".$objClass->getStrCampo()." = '".$objClass->getStrValor()."';";
		
		$stmt = $pdo->prepare($sql);
		$stmt->execute();//Executa A Query

		$objResultado = $stmt->fetchAll(\PDO::FETCH_ASSOC);

		return count($objResultado);
	}

	public function listar(ClsVeiculo $objClass)
	{	
        $pdo = Conexao::getConn();
		
		$sql = "SELECT * FROM ".$objClass->tabela." a
			LEFT JOIN tbfabricante_veiculo b ON (b.id_fabricante = a.id_fabricante)
			LEFT JOIN tbcategoria_combustivel c ON (c.id_combustivel = a.id_combustivel)
			LEFT JOIN tbcategoria_veiculo d ON (d.id_categoria_veiculo = a.id_categoria_veiculo)
		WHERE a.id_cliente = ".$_SESSION['id_cliente']." AND a.flag_excluido = 0";
		
		$stmt = $pdo->prepare($sql);
		$stmt->execute();

		$objResultado = $stmt->fetchAll(\PDO::FETCH_ASSOC);

		return $objResultado;
	}

	public function listarTodos(ClsVeiculo $objClass)
	{	
        $pdo = Conexao::getConn();
		
		$sql = "SELECT * FROM ".$objClass->tabela." a
			LEFT JOIN tbfabricante_veiculo b ON (b.id_fabricante = a.id_fabricante)
			LEFT JOIN tbcategoria_combustivel c ON (c.id_combustivel = a.id_combustivel)
			LEFT JOIN tbcategoria_veiculo d ON (d.id_categoria_veiculo = a.id_categoria_veiculo)
		WHERE a.id_cliente = ".$_SESSION['id_cliente']." AND a.flag_excluido = 0";
		
		$stmt = $pdo->prepare($sql);
		$stmt->execute();

		$objResultado = $stmt->fetchAll(\PDO::FETCH_ASSOC);

		return $objResultado;
	}

	public function listar_combo(ClsVeiculo $objClass)
	{
        $pdo = Conexao::getConn();
		
		$sql = "SELECT id_veiculo, name FROM ".$objClass->tabela." where id not in (1) order by name asc;";

		$stmt = $pdo->prepare($sql);
		$stmt->execute();

		return $stmt->fetchAll(\PDO::FETCH_ASSOC);
	}

	public function count(ClsVeiculo $objClass)
	{	
        $pdo = Conexao::getConn();
		
		$sql = "SELECT COUNT(*) as Qtd from ".$objClass->tabela.";";

		$stmt = $pdo->prepare($sql);
		$stmt->execute();

		return $stmt->fetchColumn();
	}
}