<?php

namespace App\model;

use App\model\Conexao;

abstract class ClsSeguro extends Conexao
{
	private $idSeguro;
	private $idCliente;
	private $apolice;
	private $veiculo;
	private $data_vencimento;
	private $valor;
	private $id_situacao;
	private $id_fornecedor;
	private $data_inicial;
	private $data_final;
	
	// Paginacao
	private $pagina_inicial;
	private $registo_por_pagina;

	private $strCampo;
	private $strValor;	
	
	public $tabela = "tbseguro";
	public $keyId = "id_seguro ";
	
    public function getId(){ return $this->idSeguro; }
	public function setId($idSeguro){ $this->idSeguro = $idSeguro; }

	public function getIdCliente (){ return $this->idCliente; }	
	public function setIdCliente($idCliente){ $this->idCliente = $idCliente; }
    
	public function getApolice(){ return $this->apolice; }	
	public function setApolice($apolice){ $this->apolice = $apolice; }

	public function getVeiculo(){ return $this->veiculo; }	
	public function setVeiculo($veiculo){ $this->veiculo = $veiculo; }

	public function getDataVencimento(){ return $this->data_vencimento; }	
	public function setDataVencimento($data_vencimento){ $this->data_vencimento = $data_vencimento; }
	
	public function getValor(){ return $this->valor; }	
	public function setValor($valor){ $this->valor = $valor; }

	public function getSituacao(){ return $this->id_situacao; }	
	public function setSituacao($id_situacao){ $this->id_situacao = $id_situacao; }
	
	public function getFornecedor(){ return $this->id_fornecedor; }	
	public function setFornecedor($id_fornecedor){ $this->id_fornecedor = $id_fornecedor; }

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

interface itfSeguro
{
	function cadastrar(ClsSeguro $objClass);
	function atualizar(ClsSeguro $objClass);
	function deletar(ClsSeguro $objClass);
	function buscar_id(ClsSeguro $objClass);
	function ifExist(ClsSeguro $objClass);
	function ifExistId(ClsSeguro $objClass);
	function listar(ClsSeguro $objClass);
	function listarTodos(ClsSeguro $objClass);
	function listar_combo(ClsSeguro $objClass);
	function count(ClsSeguro $objClass);
}

class DaoSeguro implements itfSeguro
{

	public function cadastrar(ClsSeguro $objClass)
	{	
		$pdo = Conexao::getConn();
		$sql = " INSERT INTO ".$objClass->tabela." (id_cliente, apolice, id_veiculo, data_vencimento, valor, id_situacao, id_fornecedor)
		 values (:id_cliente, :apolice, :id_veiculo, :data_vencimento, :valor, :id_situacao, :id_fornecedor);";

		$stmt = $pdo->prepare($sql);

		$stmt->bindValue(":id_cliente", $objClass->getIdCliente());
		$stmt->bindValue(":apolice", $objClass->getApolice());
		$stmt->bindValue(":id_veiculo", $objClass->getVeiculo());
		$stmt->bindValue(":data_vencimento", $objClass->getDataVencimento());
		$stmt->bindValue(":valor", $objClass->getValor());
		$stmt->bindValue(":id_situacao", $objClass->getSituacao());
		$stmt->bindValue(":id_fornecedor", $objClass->getFornecedor());

		$stmt->execute();

		return $pdo->lastInsertId();
	}

	public function atualizar(ClsSeguro $objClass)
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
	
	public function deletar(ClsSeguro $objClass)
	{
		$pdo = Conexao::getConn();
		
		$sql = "UPDATE ".$objClass->tabela." SET ";
		$sql .= "flag_excluido = :flag_excluido ";		
		$sql .= " WHERE ".$objClass->keyId." = :id_seguro";

		$stmt = $pdo->prepare($sql);
		$stmt->bindvalue(":id_seguro",$objClass->getId());
		$stmt->bindValue(":flag_excluido",1);
		$stmt->execute();

		return 1;
	}

	public function buscar_id(ClsSeguro $objClass)
	{		
        $pdo = Conexao::getConn();
		
		$sql = "SELECT * FROM ".$objClass->tabela." WHERE ".$objClass->keyId." = :id";
		
		$stmt = $pdo->prepare($sql);
		$stmt->bindValue(":id",$objClass->getId());
		$stmt->execute();

		$objResultado = $stmt->fetch(\PDO::FETCH_ASSOC);

		return $objResultado;
	}

	public function ifExist(ClsSeguro $objClass)
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

	public function ifExistId(ClsSeguro $objClass)
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

	public function listar(ClsSeguro $objClass)
	{	
        $pdo = Conexao::getConn();
		
		$sql = "SELECT a.*, b.*, c.*, d.* FROM ".$objClass->tabela." a
			INNER JOIN tbfornecedor b ON (b.id_fornecedor = a.id_fornecedor)
			INNER JOIN tbpagamento_situacao c ON (c.id_situacao = a.id_situacao)
			INNER JOIN tbveiculo d ON (d.id_veiculo = a.id_veiculo)
		WHERE a.id_cliente = ".$_SESSION['id_cliente']." AND a.flag_excluido = 0";
		
		$stmt = $pdo->prepare($sql);
		$stmt->execute();

		$objResultado = $stmt->fetchAll(\PDO::FETCH_ASSOC);
	
		return $objResultado;
	}

	public function listarTodos(ClsSeguro $objClass)
	{	
        $pdo = Conexao::getConn();
		
		$sql = "SELECT a.*, b.*, c.*, d.* FROM ".$objClass->tabela." a
			LEFT JOIN tbfornecedor b ON (b.id_fornecedor = a.id_fornecedor)
			LEFT JOIN tbpagamento_situacao c ON (c.id_situacao = a.id_situacao)
			LEFT JOIN tbveiculo d ON (d.id_veiculo = a.id_veiculo)
		WHERE a.id_cliente = " . $_SESSION['id_cliente'] . " AND a.flag_excluido = 0";
		
		$stmt = $pdo->prepare($sql);
		$stmt->execute();

		$objResultado = $stmt->fetchAll(\PDO::FETCH_ASSOC);

		return $objResultado;
	}

	public function listar_combo(ClsSeguro $objClass)
	{
        $pdo = Conexao::getConn();
		
		$sql = "SELECT id_seguro, name FROM ".$objClass->tabela." WHERE id not in (1) order by name asc;";

		$stmt = $pdo->prepare($sql);
		$stmt->execute();

		return $stmt->fetchAll(\PDO::FETCH_ASSOC);
	}

	public function count(ClsSeguro $objClass)
	{	
        $pdo = Conexao::getConn();
		
		$sql = "SELECT COUNT(*) as Qtd from ".$objClass->tabela.";";

		$stmt = $pdo->prepare($sql);
		$stmt->execute();

		return $stmt->fetchColumn();
	}
}