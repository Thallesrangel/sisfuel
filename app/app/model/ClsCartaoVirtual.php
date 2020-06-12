<?php

namespace App\model;

use App\model\Conexao;

abstract class ClsCartaoVirtual extends Conexao
{
	private $id;
	private $id_usuario;
	private $id_cliente;
	private $quantidade;
	private $dataRegistro;
	private $motorista;
	private $valor_limite;
	private $id_situacao;
	private $id_renovacao;

	// Paginacao
	private $pagina_inicial;
	private $registo_por_pagina;

	private $strCampo;
	private $strValor;

	public $tabela = "tbcartao_virtual";
	public $keyId = "id_cartao";
	
    public function getId(){ return $this->id; }
	public function setId($id){ $this->id = $id; }

	public function getIdCliente(){ return $this->id_cliente; }	
	public function setIdCliente($id_cliente){ $this->id_cliente = $id_cliente; }

	public function getIdUsuario() { return $this->id_usuario; }
	public function setIdUsuario($id_usuario){ $this->id_usuario = $id_usuario; }

	public function getValorLimite(){ return $this->valor_limite; }	
	public function setValorLimite($valor_limite){ $this->valor_limite = $valor_limite; }

	public function getDataValidade(){ return $this->dataRegistro; }	
	public function setDataValidade($dataRegistro){ $this->dataRegistro = $dataRegistro; }

	public function getMotorista(){ return $this->motorista; }	
	public function setMotorista($motorista){ $this->motorista = $motorista; }

	public function getIdSituacao(){ return $this->id_situacao; }	
	public function setIdSituacao($id_situacao){ $this->id_situacao = $id_situacao; }

	public function getIdRenovacao(){ return $this->id_renovacao; }	
	public function setIdRenovacao($id_renovacao){ $this->id_renovacao = $id_renovacao; }

	// Paginacao 
	public function getPaginaInicial(){ return $this->pagina_inicial; }
	public function setPaginaInicial($pagina_inicial){ $this->pagina_inicial = $pagina_inicial; }

	public function getRegistroPorPagina(){ return $this->registo_por_pagina; }
	public function setRegistroPorPagina($registo_por_pagina) { $this->registo_por_pagina = $registo_por_pagina; }
}

interface itfCartaoVirtual
{
	function cadastrar(ClsCartaoVirtual $objClass);
	function atualizar(ClsCartaoVirtual $objClass);
	function deletar(ClsCartaoVirtual $objClass);
	function buscar_id(ClsCartaoVirtual $objClass);
	function ifExist(ClsCartaoVirtual $objClass);
	function ifExistId(ClsCartaoVirtual $objClass);
	function listar(ClsCartaoVirtual $objClass);
	function listarTodos(ClsCartaoVirtual $objClass);
	function selectCombustivel(ClsCartaoVirtual $objClass);
	function listar_combo(ClsCartaoVirtual $objClass);
	function count(ClsCartaoVirtual $objClass);
}

class DaoCartaoVirtual implements itfCartaoVirtual
{
    public function cadastrar(ClsCartaoVirtual $objClass)
    {
		$pdo = Conexao::getConn();
		
		$sql = " INSERT INTO ".$objClass->tabela." (id_cliente, id_usuario, valor_limite, data_validade, id_motorista, id_cartao_situacao, id_cartao_renovacao)
		values (:id_cliente, :id_usuario, :valor_limite, :data_validade, :id_motorista, :id_cartao_situacao, :id_cartao_renovacao)";
		
		$stmt = $pdo->prepare($sql);

		$stmt->bindValue(":id_cliente", $objClass->getIdCliente());
		$stmt->bindValue(":id_usuario", $objClass->getIdUsuario());
		$stmt->bindValue(":valor_limite", $objClass->getValorLimite());
		$stmt->bindValue(":data_validade", $objClass->getDataValidade());
		$stmt->bindValue(":id_motorista", $objClass->getMotorista());
		$stmt->bindValue(":id_cartao_situacao", $objClass->getIdSituacao());
		$stmt->bindValue(":id_cartao_renovacao", $objClass->getIdRenovacao());
	
		$stmt->execute();

		return $pdo->lastInsertId();
	}

	public function atualizar(ClsCartaoVirtual $objClass)
	{
		$pdo = Conexao::getConn();
		
		$sql = "UPDATE ".$objClass->tabela." SET ";
		$sql .= "id_fornecedor = :id_fornecedor, quantidade = :quantidade, data_hora = :data_hora, comprovante = :comprovante, km = :km, id_motorista = :id_motorista, id_combustivel = :id_combustivel, id_veiculo = :id_veiculo";		
		$sql .= " WHERE ".$objClass->keyId." = :id_cartao";

		$stmt = $pdo->prepare($sql);
		$stmt->bindvalue(":id_abastecimento",$objClass->getId());
		$stmt->bindValue(":id_fornecedor", $objClass->getFornecedor());
		$stmt->bindValue(":quantidade", $objClass->getQuantidade());
		$stmt->bindValue(":data_hora", $objClass->getDataAbastecimento());
		$stmt->bindValue(":comprovante", $objClass->getComprovante());
		$stmt->bindValue(":km", $objClass->getQuilometragem());
		$stmt->bindValue(":id_motorista", $objClass->getMotorista());
		$stmt->bindValue(":id_combustivel", $objClass->getCombustivel());
		$stmt->bindValue(":id_veiculo", $objClass->getVeiculo());
		$stmt->execute();
	
		return 1;
	}
	
	public function deletar(ClsCartaoVirtual $objClass)
	{
		$pdo = Conexao::getConn();
		
		$sql = "UPDATE ".$objClass->tabela." SET ";
		$sql .= "flag_excluido = :flag_excluido ";		
		$sql .= " WHERE ".$objClass->keyId." = :id_cartao";

		$stmt = $pdo->prepare($sql);
		$stmt->bindvalue(":id_cartao",$objClass->getId());
		$stmt->bindValue(":flag_excluido",1);
		$stmt->execute();

		return 1;
	}

	public function buscar_id(ClsCartaoVirtual $objClass)
	{
        $pdo = Conexao::getConn();
		
		$sql = "SELECT a.*, b.*, c.* FROM ".$objClass->tabela." a
			INNER JOIN tbcartao_virtual_situacao b ON (b.id_cartao_situacao = a.id_cartao_situacao)
			INNER JOIN tbmotorista c ON (c.id_motorista = a.id_motorista)
		WHERE ".$objClass->keyId." = :id_cartao";
		
		$stmt = $pdo->prepare($sql);
		$stmt->bindValue(":id_cartao",$objClass->getId());
		$stmt->execute();

		$objResultado = $stmt->fetch(\PDO::FETCH_ASSOC);

		return $objResultado;
	}

	public function ifExist(ClsCartaoVirtual $objClass)
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

	public function ifExistId(ClsCartaoVirtual $objClass)
	{
        $pdo = Conexao::getConn();
		
		$sql = "SELECT * ";
		$sql .= "from ".$objClass->tabela;
		$sql .= " where ".$objClass->getStrCampo()." = '".$objClass->getStrValor()."';";
		$stmt = $pdo->prepare($sql);
		$stmt->execute();

		$objResultado = $stmt->fetchAll(\PDO::FETCH_ASSOC);

		return count($objResultado);
	}

	public function listar(ClsCartaoVirtual $objClass)
	{
        $pdo = Conexao::getConn();
		
		$sql = "SELECT *, b.*, c.*, d.* FROM ".$objClass->tabela." a
			INNER JOIN tbmotorista b ON (b.id_motorista = a.id_motorista)
			INNER JOIN tbcartao_virtual_situacao c ON (c.id_cartao_situacao = a.id_cartao_situacao) 
			INNER JOIN tbcartao_virtual_renovacao d ON (d.id_cartao_renovacao = a.id_cartao_renovacao)
		WHERE a.id_cliente = ".$_SESSION['id_cliente']." AND a.flag_excluido = 0";
		
		$stmt = $pdo->prepare($sql);
		$stmt->execute();//Executa A Query

		$objResultado = $stmt->fetchAll(\PDO::FETCH_ASSOC);

		return $objResultado;
	}

	public function listarTodos(ClsCartaoVirtual $objClass)
	{
        $pdo = Conexao::getConn();
		
		$sql = "SELECT *, b.*, c.*, d.* FROM ".$objClass->tabela." a
			INNER JOIN tbmotorista b ON (b.id_motorista = a.id_motorista)
			INNER JOIN tbcartao_virtual_situacao c ON (c.id_cartao_situacao = a.id_cartao_situacao) 
			INNER JOIN tbcartao_virtual_renovacao d ON (d.id_cartao_renovacao = a.id_cartao_renovacao)
		WHERE a.id_cliente = ".$_SESSION['id_cliente']." AND a.flag_excluido = 0";
		
		$stmt = $pdo->prepare($sql);
		$stmt->execute();//Executa A Query

		$objResultado = $stmt->fetchAll(\PDO::FETCH_ASSOC);

		return $objResultado;
	}

	public function selectCombustivel(ClsCartaoVirtual $objClass)
	{
        $pdo = Conexao::getConn();
		
		$sql = "SELECT * FROM ".$objClass->tabela.";";
		
		$stmt = $pdo->prepare($sql);
		$stmt->execute();

		$objResultado = $stmt->fetchAll(\PDO::FETCH_ASSOC);

		return $objResultado;
	}

	public function listar_combo(ClsCartaoVirtual $objClass)
	{
        $pdo = Conexao::getConn();
		
		$sql = "select id, name from ".$objClass->tabela." where id not in (1) order by name asc;";

		$stmt = $pdo->prepare($sql);
		$stmt->execute();

		return $stmt->fetchAll(\PDO::FETCH_ASSOC);
	}

	public function count(ClsCartaoVirtual $objClass)
	{
        $pdo = Conexao::getConn();
		
		$sql = "SELET count(*) as Qtd from ".$objClass->tabela.";";

		$stmt = $pdo->prepare($sql);
		$stmt->execute();

		return $stmt->fetchColumn();
	}
}