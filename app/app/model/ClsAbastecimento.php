<?php

namespace App\model;

use App\model\Conexao;

abstract class ClsAbastecimento extends Conexao
{
	private $id;
	private $idFornecedor;
	private $idCliente;
	private $quantidade;
	private $dataAbastecimento;
	private $comprovante;
	private $quilometragem;
	private $motorista;
	private $combustivel;
	private $veiculo;
	private	$fornecedor;
	private $data_inicial;
	private $data_final;

	// Paginacao
	private $pagina_inicial;
	private $registo_por_pagina;

	private $strCampo;
	private $strValor;

	public $tabela = "tbabastecimento";
	public $keyId = "id_abastecimento";
	
    public function getId(){ return $this->id; }
	public function setId($id){ $this->id = $id; }
    
	public function getIdCliente(){ return $this->idCliente; }	
	public function setIdCliente($idCliente){ $this->idCliente = $idCliente; }

	public function getFornecedor(){ return $this->idFornecedor; }	
	public function setFornecedor($idFornecedor){ $this->idFornecedor = $idFornecedor; }

	public function getQuantidade(){ return $this->quantidade; }	
	public function setQuantidade($quantidade){ $this->quantidade = $quantidade; }

	public function getDataAbastecimento(){ return $this->dataAbastecimento; }	
	public function setDataAbastecimento($dataAbastecimento){ $this->dataAbastecimento = $dataAbastecimento; }
	
	public function getComprovante(){ return $this->comprovante; }	
	public function setComprovante($comprovante){ $this->comprovante = $comprovante; }

	public function getQuilometragem(){ return $this->quilometragem; }	
	public function setQuilometragem($quilometragem){ $this->quilometragem = $quilometragem; }

	public function getMotorista(){ return $this->motorista; }	
	public function setMotorista($motorista){ $this->motorista = $motorista; }

	public function getCombustivel(){ return $this->combustivel; }	
	public function setCombustivel($combustivel){ $this->combustivel = $combustivel; }

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

interface itfAbastecimento
{
	function cadastrar(ClsAbastecimento $objClass);
	function atualizar(ClsAbastecimento $objClass);
	function deletar(ClsAbastecimento $objClass);
	function buscar_id(ClsAbastecimento $objClass);
	function ifExist(ClsAbastecimento $objClass);
	function ifExistId(ClsAbastecimento $objClass);
	function listar(ClsAbastecimento $objClass);
	function listarTodos(ClsAbastecimento $objClass);
	function selectCombustivel(ClsAbastecimento $objClass);
	function listar_combo(ClsAbastecimento $objClass);
	function count(ClsAbastecimento $objClass);
}

class DaoAbastecimento implements itfAbastecimento
{
    public function cadastrar(ClsAbastecimento $objClass)
    {
		$pdo = Conexao::getConn();
		
		$sql = " INSERT INTO ".$objClass->tabela." (id_cliente, id_fornecedor, quantidade, data_hora, comprovante, km, id_motorista, id_combustivel, id_veiculo)
		values (:id_cliente, :id_fornecedor, :quantidade, :data_hora, :comprovante, :km, :id_motorista, :id_combustivel, :id_veiculo)";
		
		$stmt = $pdo->prepare($sql);

		$stmt->bindValue(":id_cliente", $objClass->getIdCliente());
		$stmt->bindValue(":id_fornecedor", $objClass->getFornecedor());
		$stmt->bindValue(":quantidade", $objClass->getQuantidade());
		$stmt->bindValue(":data_hora", $objClass->getDataAbastecimento());
		$stmt->bindValue(":comprovante", $objClass->getComprovante());
		$stmt->bindValue(":km", $objClass->getQuilometragem());
		$stmt->bindValue(":id_motorista", $objClass->getMotorista());
		$stmt->bindValue(":id_combustivel", $objClass->getCombustivel());
		$stmt->bindValue(":id_veiculo", $objClass->getVeiculo());

		$stmt->execute();

		return $pdo->lastInsertId();
	}

	public function atualizar(ClsAbastecimento $objClass)
	{
		$pdo = Conexao::getConn();
		
		$sql = "UPDATE ".$objClass->tabela." SET ";
		$sql .= "id_fornecedor = :id_fornecedor, quantidade = :quantidade, data_hora = :data_hora, comprovante = :comprovante, km = :km, id_motorista = :id_motorista, id_combustivel = :id_combustivel, id_veiculo = :id_veiculo";		
		$sql .= " WHERE ".$objClass->keyId." = :id_abastecimento";

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

		public function deletar(ClsAbastecimento $objClass)
	{
		$pdo = Conexao::getConn();

		if (intval($objClass->getId()) == 1) {
			return 0;	
		} else {
			$sql = "DELETE FROM ".$objClass->tabela." WHERE ".$objClass->keyId." = :id_abastecimento AND ".$objClass->keyId." >= 1";
			$stmt = $pdo->prepare($sql);
			$stmt->bindValue(":id_abastecimento",$objClass->getId()); 
			$stmt->execute();
			
			return 1;			
        }
		$db->close();
	}

	public function buscar_id(ClsAbastecimento $objClass)
	{
        $pdo = Conexao::getConn();
		
		$sql = "SELECT * FROM ".$objClass->tabela." WHERE ".$objClass->keyId." = :id";
		
		$stmt = $pdo->prepare($sql);
		$stmt->bindValue(":id",$objClass->getId());
		$stmt->execute();

		$objResultado = $stmt->fetch(\PDO::FETCH_ASSOC);

		return $objResultado;
	}

	public function ifExist(ClsAbastecimento $objClass)
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

	public function ifExistId(ClsAbastecimento $objClass)
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

	public function listar(ClsAbastecimento $objClass)
	{
        $pdo = Conexao::getConn();
		
		$sql = "SELECT *, b.* FROM ".$objClass->tabela." a
			INNER JOIN tbfornecedor b ON (b.id_fornecedor = a.id_fornecedor)
			INNER JOIN tbmotorista c ON (c.id_motorista = a.id_motorista) 
			INNER JOIN tbcategoria_combustivel d ON (d.id_combustivel = a.id_combustivel) 
			INNER JOIN tbveiculo e ON (e.id_veiculo = a.id_veiculo) 
		WHERE a.id_cliente = ".$_SESSION['id_cliente']." AND a.flag_excluido = 0";
		
		$stmt = $pdo->prepare($sql);
		$stmt->execute();//Executa A Query

		$objResultado = $stmt->fetchAll(\PDO::FETCH_ASSOC);

		return $objResultado;
	}


	public function listarTodos(ClsAbastecimento $objClass)
	{
        $pdo = Conexao::getConn();
		
		$sql = "SELECT *, b.* FROM ".$objClass->tabela." a
			INNER JOIN tbfornecedor b ON (b.id_fornecedor = a.id_fornecedor)
			INNER JOIN tbmotorista c ON (c.id_motorista = a.id_motorista) 
			INNER JOIN tbcategoria_combustivel d ON (d.id_combustivel = a.id_combustivel) 
			INNER JOIN tbveiculo e ON (e.id_veiculo = a.id_veiculo) 
		WHERE a.id_cliente = ".$_SESSION['id_cliente']."
		AND a.id_fornecedor IN(".implode(',', $objClass->getFornecedor()).") 
		AND a.id_veiculo IN(".implode(',', $objClass->getVeiculo()).") 
		AND a.id_motorista IN(".implode(',', $objClass->getMotorista()).")
		AND a.id_combustivel IN(".implode(',', $objClass->getCombustivel()).") 
		AND a.data_hora BETWEEN :data_inicial AND :data_final AND a.flag_excluido = 0 ORDER BY a.id_abastecimento DESC";
		
		$stmt = $pdo->prepare($sql);
		$stmt->bindValue(':data_inicial', $objClass->getDataInicial(), \PDO::PARAM_STR);
        $stmt->bindValue(':data_final', $objClass->getDataFinal(), \PDO::PARAM_STR);
		$stmt->execute();

		$objResultado = $stmt->fetchAll(\PDO::FETCH_ASSOC);

		return $objResultado;
	}
	public function selectCombustivel(ClsAbastecimento $objClass)
	{
        $pdo = Conexao::getConn();
		
		$sql = "SELECT * FROM ".$objClass->tabela.";";
		
		$stmt = $pdo->prepare($sql);
		$stmt->execute();

		$objResultado = $stmt->fetchAll(\PDO::FETCH_ASSOC);

		return $objResultado;
	}

	public function listar_combo(ClsAbastecimento $objClass)
	{
        $pdo = Conexao::getConn();
		
		$sql = "select id, name from ".$objClass->tabela." where id not in (1) order by name asc;";

		$stmt = $pdo->prepare($sql);
		$stmt->execute();

		return $stmt->fetchAll(\PDO::FETCH_ASSOC);
	}

	public function count(ClsAbastecimento $objClass)
	{
        $pdo = Conexao::getConn();
		
		$sql = "SELET count(*) as Qtd from ".$objClass->tabela.";";

		$stmt = $pdo->prepare($sql);
		$stmt->execute();

		return $stmt->fetchColumn();
	}
}