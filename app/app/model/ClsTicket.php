<?php

namespace App\model;

use App\model\Conexao;


abstract class ClsTicket extends Conexao
{
	public $tabela = "tbticket";
	public $keyId = "id_ticket";

	private $id;
	private $idCliente;
	private $fornecedor;
	private $combustivel;
	private $quantidade;
	private $dataEntrada;
	private $motorista;
	private $veiculo;
	private $data_inicial;
	private $data_final;

	// Paginacao
	private $pagina_inicial;
	private $registo_por_pagina;

	private $strCampo;
	private $strValor;	
	
    public function getId(){ return $this->id; }
	public function setId($id){ $this->id = $id; }
	
	public function getIdCliente (){ return $this->idCliente; }	
	public function setIdCliente($idCliente){ $this->idCliente = $idCliente; }
    
	public function getFornecedor(){ return $this->fornecedor; }	
	public function setFornecedor($fornecedor){ $this->fornecedor = $fornecedor; }

	public function getQuantidade(){ return $this->quantidade; }	
	public function setQuantidade($quantidade){ $this->quantidade = $quantidade; }

	public function getDataEntrada(){ return $this->dataEntrada; }	
	public function setDataEntrada($dataEntrada){ $this->dataEntrada = $dataEntrada; }

	public function getCombustivel(){ return $this->combustivel; }	
	public function setCombustivel($combustivel){ $this->combustivel = $combustivel; }

	public function getMotorista(){ return $this->motorista; }	
	public function setMotorista($motorista){ $this->motorista = $motorista; }

	public function getVeiculo(){ return $this->veiculo; }	
	public function setVeiculo($veiculo){ $this->veiculo = $veiculo; }

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

interface itfTicket
{
	function cadastrar(ClsTicket $objClass);
	function atualizar(ClsTicket $objClass);
	function deletar(ClsTicket $objClass);
	function buscar_id(ClsTicket $objClass);
	function ifExist(ClsTicket $objClass);
	function ifExistId(ClsTicket $objClass);
	function listar(ClsTicket $objClass);
	function listarTodos(ClsTicket $objClass);
	function count(ClsTicket $objClass);
}

class DaoTicket implements itfTicket
{
	public function cadastrar(ClsTicket $objClass)
	{	
		$pdo = Conexao::getConn();
		
		$sql = " INSERT INTO ".$objClass->tabela." (id_motorista, id_cliente, quantidade, data_entrada, id_combustivel, id_fornecedor, id_veiculo)
		 VALUES (:id_motorista, :id_cliente, :quantidade, :data_entrada, :id_combustivel, :id_fornecedor, :id_veiculo);";
		
		$stmt = $pdo->prepare($sql);

		$stmt->bindValue(":id_motorista", $objClass->getMotorista());
		$stmt->bindValue(":id_cliente", $objClass->getIdCliente());
		$stmt->bindValue(":quantidade", $objClass->getQuantidade());
		$stmt->bindValue(":data_entrada", $objClass->getDataEntrada());
		$stmt->bindValue(":id_combustivel", $objClass->getCombustivel());
		$stmt->bindValue(":id_fornecedor", $objClass->getFornecedor());
		$stmt->bindValue(":id_veiculo", $objClass->getVeiculo());
		$stmt->execute();

		return $pdo->lastInsertId();
	}

	public function atualizar(ClsTicket $objClass)
	{
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

	public function deletar(ClsTicket $objClass)
	{
		$pdo = Conexao::getConn();
		
		$sql = "UPDATE ".$objClass->tabela." SET ";
		$sql .= "flag_excluido = :flag_excluido ";		
		$sql .= " WHERE ".$objClass->keyId." = :id_ticket";

		$stmt = $pdo->prepare($sql);
		$stmt->bindvalue(":id_ticket",$objClass->getId());
		$stmt->bindValue(":flag_excluido",1);
		$stmt->execute();

		return 1;
	}


	public function buscar_id(ClsTicket $objClass)
	{
        $pdo = Conexao::getConn();
		
		$sql = "SELECT * FROM ".$objClass->tabela." WHERE ".$objClass->keyId." = :id";
		
		$stmt = $pdo->prepare($sql);
		$stmt->bindValue(":id",$objClass->getId());
		$stmt->execute();

		$objResultado = $stmt->fetch(\PDO::FETCH_ASSOC);

		return $objResultado;
	}

	public function ifExist(ClsTicket $objClass)
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

	public function ifExistId(ClsTicket $objClass)
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

	public function listar(ClsTicket $objClass)
	{	
        $pdo = Conexao::getConn();
		
		$sql = "SELECT * FROM ".$objClass->tabela. " a 
			LEFT JOIN tbfornecedor b ON (b.id_fornecedor = a.id_fornecedor)
			LEFT JOIN tbveiculo c ON (c.id_veiculo = a.id_veiculo)
			LEFT JOIN tbcategoria_combustivel d ON (d.id_combustivel = a.id_combustivel)
			LEFT JOIN tbmotorista e ON (e.id_motorista = a.id_motorista)
		WHERE a.id_cliente = ".$_SESSION['id_cliente']." AND a.flag_excluido = 0";
		
		$stmt = $pdo->prepare($sql);
		$stmt->execute();

		$objResultado = $stmt->fetchAll(\PDO::FETCH_ASSOC);

		return $objResultado;
	}

	public function listarTodos(ClsTicket $objClass)
	{	
        $pdo = Conexao::getConn();
		
		$sql = "SELECT * FROM ".$objClass->tabela. " a 
			INNER JOIN tbfornecedor b ON (b.id_fornecedor = a.id_fornecedor)
			INNER JOIN tbveiculo c ON (c.id_veiculo = a.id_veiculo)
			INNER JOIN tbcategoria_combustivel d ON (d.id_combustivel = a.id_combustivel)
			INNER JOIN tbmotorista e ON (e.id_motorista = a.id_motorista)
		WHERE a.id_cliente = ".$_SESSION['id_cliente']."
			
		AND a.id_fornecedor IN(".implode(',', $objClass->getFornecedor() ).") 
		AND a.id_motorista IN(".implode(',', $objClass->getMotorista()).")
		AND a.id_veiculo IN(".implode(',', $objClass->getVeiculo()).") 
		AND a.data_entrada BETWEEN :data_inicial AND :data_final AND a.flag_excluido = 0 ORDER BY a.id_ticket DESC";
	
		$stmt = $pdo->prepare($sql);
		$stmt->bindValue(':data_inicial', $objClass->getDataInicial(), \PDO::PARAM_STR);
        $stmt->bindValue(':data_final', $objClass->getDataFinal(), \PDO::PARAM_STR);
		$stmt->execute();

		$objResultado = $stmt->fetchAll(\PDO::FETCH_ASSOC);

		return $objResultado;
	}

	public function count(ClsTicket $objClass)
	{
        $pdo = Conexao::getConn();
		
		$sql = "SELECT COUNT(*) as Qtd from ".$objClass->tabela.";";

		$stmt = $pdo->prepare($sql);
		$stmt->execute();

		return $stmt->fetchColumn();
	}
}