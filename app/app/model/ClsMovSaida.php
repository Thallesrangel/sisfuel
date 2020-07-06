<?php

namespace App\model;

use App\model\Conexao;

abstract class ClsMovSaida extends Conexao{

	private $id;
	private $idCliente;
	private $quantidade;
	private $tanque;
	private $dataSaida;
	private $motorista;
	private $veiculo;
	private $quilometragem;
	
	// Relatório
	private $data_inicial;
	private $data_final;
	
	// Paginacao
	private $pagina_inicial;
	private $registo_por_pagina;
	

	private $strCampo;
	private $strValor;	
	
	public $tabela = "tbmov_saida";
	public $keyId = "id_saida";
	
    public function getId(){ return $this->id; }
	public function setId($id){ $this->id = $id; }

	public function getIdCliente(){ return $this->idCliente; }	
	public function setIdCliente($idCliente){ $this->idCliente = $idCliente; }

	public function getQuantidade(){ return $this->quantidade; }	
	public function setQuantidade($quantidade){ $this->quantidade = $quantidade; }

	public function getTanque(){ return $this->tanque; }	
	public function setTanque($tanque){ $this->tanque = $tanque; }

	public function getDataSaida(){ return $this->dataSaida; }	
	public function setDataSaida($dataSaida){ $this->dataSaida = $dataSaida; }

	public function getMotorista(){ return $this->motorista; }	
	public function setMotorista($motorista){ $this->motorista = $motorista; }

	public function getVeiculo(){ return $this->veiculo; }	
	public function setVeiculo($veiculo){ $this->veiculo = $veiculo; }

	public function getQuilometragem(){ return $this->quilometragem; }	
	public function setQuilometragem($quilometragem) { $this->quilometragem = $quilometragem; }


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


interface interfaceMovSaida{

	function cadastrar(ClsMovSaida $objClass);
	function atualizar(ClsMovSaida $objClass);
	function deletar(ClsMovSaida $objClass);
	function buscar_id(ClsMovSaida $objClass);
	function ifExist(ClsMovSaida $objClass);
	function ifExistId(ClsMovSaida $objClass);
	function listar(ClsMovSaida $objClass);
	function listarTodos(ClsMovSaida $objClass);
	function quantidadeTotalSaida(ClsMovSaida $objClass);
	function listar_combo(ClsMovSaida $objClass);
	function count(ClsMovSaida $objClass);
}

class DaoMovSaida implements interfaceMovSaida{

	public function cadastrar(ClsMovSaida $objClass){
		
		$pdo = Conexao::getConn();
		
		$sql = " INSERT INTO ".$objClass->tabela." (id_motorista, id_cliente, quantidade, data_hora, id_tanque, id_veiculo, km)
		 values (:id_motorista, :id_cliente, :quantidade, :data_hora, :id_tanque, :id_veiculo, :km);";
		
		$stmt = $pdo->prepare($sql);
		$stmt->bindValue(":id_cliente", $objClass->getIdCliente());
		$stmt->bindValue(":id_motorista", $objClass->getMotorista());
		$stmt->bindValue(":quantidade", $objClass->getQuantidade());
		$stmt->bindValue(":data_hora", $objClass->getDataSaida());
		$stmt->bindValue(":id_tanque", $objClass->getTanque());
		$stmt->bindValue(":id_veiculo", $objClass->getVeiculo());
		$stmt->bindValue(":km", $objClass->getQuilometragem());
		$stmt->execute();

		return $pdo->lastInsertId();
	}

	public function listar(ClsMovSaida $objClass){
		
        $pdo = Conexao::getConn();
		
		$sql = "SELECT *, a.quantidade, a.data_hora FROM ".$objClass->tabela." a
			INNER JOIN tbtanque b ON (b.id_tanque = a.id_tanque)
			INNER JOIN tbmotorista c ON (c.id_motorista = a.id_motorista)
			INNER JOIN tbveiculo d ON (d.id_veiculo = a.id_veiculo)  
			WHERE a.id_cliente = ".$_SESSION['id_cliente']." AND a.flag_excluido = 0 ORDER BY id_saida DESC";
		
		$stmt = $pdo->prepare($sql);
		$stmt->bindValue(':inicial', $objClass->getPaginaInicial(), \PDO::PARAM_INT);
		$stmt->bindValue(':por_pagina', $objClass->getRegistroPorPagina(), \PDO::PARAM_INT);
		$stmt->execute();

		$objResultado = $stmt->fetchAll(\PDO::FETCH_ASSOC);

		return $objResultado;
	}

	/*
	*	Usado para gerar o relatório em "Relatórios Abastecimentos"
	*/
	public function listarTodos(ClsMovSaida $objClass){
		
        $pdo = Conexao::getConn();
		
		$sql = "SELECT *, a.quantidade, a.data_hora FROM ".$objClass->tabela." a
				INNER JOIN tbtanque b ON (b.id_tanque = a.id_tanque)
				INNER JOIN tbmotorista c ON (c.id_motorista = a.id_motorista)
				INNER JOIN tbveiculo d ON (d.id_veiculo = a.id_veiculo)  
			WHERE a.id_cliente = ".$_SESSION['id_cliente']."
			AND a.id_tanque IN(".implode(',', $objClass->getTanque() ).") 
			AND a.id_motorista IN(".implode(',', $objClass->getMotorista()).")
			AND a.id_veiculo IN(".implode(',', $objClass->getVeiculo()).") 
			AND a.data_hora BETWEEN :data_inicial AND :data_final AND a.flag_excluido = 0 ORDER BY a.id_saida DESC";
		
		$stmt = $pdo->prepare($sql);	
		$stmt->bindValue(':data_inicial', $objClass->getDataInicial(), \PDO::PARAM_STR);
        $stmt->bindValue(':data_final', $objClass->getDataFinal(), \PDO::PARAM_STR);
		$stmt->execute();
		
		$objResultado = $stmt->fetchAll(\PDO::FETCH_ASSOC);

		return $objResultado;
	}

	public function atualizar(ClsMovSaida $objClass){
		$pdo = Conexao::getConn();
		
		$sql = "UPDATE ".$objClass->tabela." SET ";
		$sql .= "nome_modelo = :nome_modelo ";		
		$sql .= " WHERE ".$objClass->keyId." = :id_veiculo";

		$stmt = $pdo->prepare($sql);
		$stmt->bindvalue(":id_veiculo",$objClass->getId());
		$stmt->bindValue(":nome_modelo",$objClass->getVeiculo());
		$stmt->execute();

		return 1;
	}

	public function deletar(ClsMovSaida $objClass){
		$pdo = Conexao::getConn();
		
		$sql = "UPDATE ".$objClass->tabela." SET ";
		$sql .= "flag_excluido = :flag_excluido ";		
		$sql .= " WHERE ".$objClass->keyId." = :id_saida";

		$stmt = $pdo->prepare($sql);
		$stmt->bindvalue(":id_saida",$objClass->getId());
		$stmt->bindValue(":flag_excluido",1);
		$stmt->execute();

		return 1;
	}

	public function buscar_id(ClsMovSaida $objClass)
	{
        $pdo = Conexao::getConn();
		
		$sql = "SELECT * FROM ".$objClass->tabela." WHERE ".$objClass->keyId." = :id";
		
		$stmt = $pdo->prepare($sql);
		$stmt->bindValue(":id",$objClass->getId());
		$stmt->execute();

		$objResultado = $stmt->fetch(\PDO::FETCH_ASSOC);

		return $objResultado;
	}

	public function ifExist(ClsMovSaida $objClass)
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

	public function ifExistId(ClsMovSaida $objClass)
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
	
	public function quantidadeTotalSaida(ClsMovSaida $objClass)
	{	
        $pdo = Conexao::getConn();
		
		$sql = "SELECT SUM(quantidade) as quantidade FROM ".$objClass->tabela."
		WHERE id_tanque = :id_tanque AND id_cliente = ".$_SESSION['id_cliente']." AND flag_excluido = 0";
		$stmt = $pdo->prepare($sql);
		$stmt->bindValue(":id_tanque",$objClass->getTanque()); 
		$stmt->execute();

		$objResultado = $stmt->fetchAll(\PDO::FETCH_ASSOC);

		return $objResultado;
	}

	public function listar_combo(ClsMovSaida $objClass)
	{
        $pdo = Conexao::getConn();
		
		$sql = "SELECT id_veiculo, name FROM ".$objClass->tabela." where id not in (1) order by name asc;";

		$stmt = $pdo->prepare($sql);
		$stmt->execute();

		return $stmt->fetchAll(\PDO::FETCH_ASSOC);
	}

	public function count(ClsMovSaida $objClass):int
	{
        $pdo = Conexao::getConn();
		
		$sql = "SELECT COUNT(id_saida) as num_result from ".$objClass->tabela." WHERE id_cliente = ".$_SESSION['id_cliente']."";
		$stmt = $pdo->prepare($sql);
		$stmt->execute();

		return $stmt->fetchColumn();
	}
}

?>