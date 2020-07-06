<?php

namespace App\model;

use App\model\Conexao;

abstract class ClsIpva extends Conexao{

	private $id;
	private $idCliente;
	private $idVeiculo;
	private $dataVencimento;
	private $valor;
	private $idSituacao;
	private $data_inicial;
	private $data_final;

	// Paginacao
	private $pagina_inicial;
	private $registo_por_pagina;

	private $strCampo;
	private $strValor;

	public $tabela = "tbipva";
	public $keyId = "id_ipva";
	
    public function getId(){ return $this->id; }
	public function setId($id){ $this->id = $id; }

	public function getIdCliente(){ return $this->idCliente; }	
	public function setIdCliente($idCliente){ $this->idCliente = $idCliente; }
    
	public function getIdVeiculo(){ return $this->idVeiculo; }	
	public function setIdVeiculo($idVeiculo){ $this->idVeiculo = $idVeiculo; }

	public function getDataVencimento(){ return $this->dataVencimento; }	
	public function setDataVencimento($dataVencimento){ $this->dataVencimento = $dataVencimento; }

	public function getValor(){ return $this->valor; }
	public function setValor($valor){ $this->valor = $valor; }

	public function getSituacao(){ return $this->idSituacao; }
	public function setSituacao($idSituacao){ $this->idSituacao = $idSituacao; }

	# Usado no formulário do relatório

	public function getDataInicial(){ return $this->data_inicial; }	
	public function setDataInicial($data_inicial){ $this->data_inicial = $data_inicial; }

	public function getDataFinal(){ return $this->data_final; }	
	public function setDataFinal($data_final){ $this->data_final = $data_final; }
	

	// Paginacao 
	public function getPaginaInicial(){ return $this->pagina_inicial; }
	public function setPaginaInicial($pagina_inicial){ $this->pagina_inicial = $pagina_inicial; }

	public function getRegistroPorPagina(){ return $this->registo_por_pagina; }
	public function setRegistroPorPagina($registo_por_pagina) { $this->registo_por_pagina = $registo_por_pagina; }

	
}

interface interfaceIpva
{
	function cadastrar(ClsIpva $objClass);
	function atualizar(ClsIpva $objClass);
	function deletar(ClsIpva $objClass);
	function buscar_id(ClsIpva $objClass);
	function ifExist(ClsIpva $objClass);
	function ifExistId(ClsIpva $objClass);
	function listar(ClsIpva $objClass);
	function listarTodos(ClsIpva $objClass);
	function listar_combo(ClsIpva $objClass);
	function count(ClsIpva $objClass);
}

class DaoIpva implements interfaceIpva
{

	public function cadastrar(ClsIpva $objClass)
	{
		$pdo = Conexao::getConn();
		
		$sql = " INSERT INTO ".$objClass->tabela." (id_cliente, id_veiculo, data_vencimento, valor, id_situacao)
		VALUES (:id_cliente, :id_veiculo, :data_vencimento, :valor, :id_situacao );";
		
		$stmt = $pdo->prepare($sql);
		$stmt->bindValue(":id_cliente", $objClass->getIdCliente());
		$stmt->bindValue(":id_veiculo", $objClass->getIdVeiculo());
		$stmt->bindValue(":data_vencimento", $objClass->getDataVencimento());
		$stmt->bindValue(":valor", $objClass->getValor());
		$stmt->bindValue(":id_situacao", $objClass->getSituacao());
		$stmt->execute();

		return $pdo->lastInsertId();
	}

	public function atualizar(ClsIpva $objClass)
	{
		$pdo = Conexao::getConn();
		
		$sql = "UPDATE ".$objClass->tabela." SET ";
		$sql .= "nome_motorista = :nome_motorista";		
		$sql .= " WHERE ".$objClass->keyId." = :id_motorista";

		$stmt = $pdo->prepare($sql);
		$stmt->bindvalue(":id_ipva",$objClass->getId());
		$stmt->bindValue(":nome_motorista",$objClass->getNome());
		$stmt->execute();

		return 1;
	}

	public function deletar(ClsIpva $objClass)
	{
		$pdo = Conexao::getConn();

		$sql = "DELETE FROM ".$objClass->tabela." WHERE ".$objClass->keyId." = :id_ipva";
		$stmt = $pdo->prepare($sql);
		$stmt->bindValue(":id_ipva",$objClass->getId()); 
		$stmt->execute();
		
		return 1;			
        
		$db->close();
	}

	public function buscar_id(ClsIpva $objClass)
	{
        $pdo = Conexao::getConn();
		
		$sql = "SELECT * FROM ".$objClass->tabela." WHERE ".$objClass->keyId." = :id";
		
		$stmt = $pdo->prepare($sql);
		$stmt->bindValue(":id",$objClass->getId()); 
		$stmt->execute();

		$objResultado = $stmt->fetch(\PDO::FETCH_ASSOC);

		return $objResultado;
	}

	public function ifExist(ClsIpva $objClass)
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

	public function ifExistId(ClsIpva $objClass)
	{
        $pdo = Conexao::getConn();
		
		$sql = "SELECT * ";
		$sql .= "FROM ".$objClass->tabela;
		$sql .= " WHERE ".$objClass->getStrCampo()." = '".$objClass->getStrValor()."';";
		
		$stmt = $pdo->prepare($sql);
		$stmt->execute();

		$objResultado = $stmt->fetchAll(\PDO::FETCH_ASSOC);

		return count($objResultado);
	}

	public function listar(ClsIpva $objClass)
	{
        $pdo = Conexao::getConn();
		
		$sql = "SELECT *, b.*, c.* FROM ".$objClass->tabela." a
			INNER JOIN tbpagamento_situacao b ON (b.id_situacao = a.id_situacao)
			INNER JOIN tbveiculo c ON (c.id_veiculo = a.id_veiculo)
		WHERE a.id_cliente = ".$_SESSION['id_cliente']." AND a.flag_excluido = 0";
		
		$stmt = $pdo->prepare($sql);
		$stmt->execute();

		$objResultado = $stmt->fetchAll(\PDO::FETCH_ASSOC);

		return $objResultado;
	}

	# Usado em relatório 
	public function listarTodos(ClsIpva $objClass)
	{
        $pdo = Conexao::getConn();
		
		$sql = "SELECT *, b.*, c.* FROM ".$objClass->tabela." a
			INNER JOIN tbpagamento_situacao b ON (b.id_situacao = a.id_situacao)
			INNER JOIN tbveiculo c ON (c.id_veiculo = a.id_veiculo)
		WHERE a.id_cliente = ".$_SESSION['id_cliente']."
		AND a.id_situacao IN(".implode(',', $objClass->getSituacao()).")
		AND a.id_veiculo IN(".implode(',', $objClass->getIdVeiculo()).")
		AND a.data_vencimento BETWEEN :data_inicial AND :data_final AND a.flag_excluido = 0 ORDER BY a.id_ipva DESC";

		$stmt = $pdo->prepare($sql);
		$stmt->bindValue(':data_inicial', $objClass->getDataInicial(), \PDO::PARAM_STR);
        $stmt->bindValue(':data_final', $objClass->getDataFinal(), \PDO::PARAM_STR);
	
		$stmt->execute();

		$objResultado = $stmt->fetchAll(\PDO::FETCH_ASSOC);

		return $objResultado;
	}
	
	public function listar_combo(ClsIpva $objClass)
	{
        $pdo = Conexao::getConn();
		
		$sql = "SELECT id, name from ".$objClass->tabela." WHERE id_motorista NOT in (1) ORDER BY name ASC;";

		$stmt = $pdo->prepare($sql);
		$stmt->execute();

		return $stmt->fetchAll(\PDO::FETCH_ASSOC);
	}

	public function count(ClsIpva $objClass)
	{
        $pdo = Conexao::getConn();
		
		$sql = "SELECT count(*) AS Qtd FROM ".$objClass->tabela.";";

		$stmt = $pdo->prepare($sql);
		$stmt->execute();

		return $stmt->fetchColumn();
	}
}

?>