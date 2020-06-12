<?php

namespace App\model;

use App\model\Conexao;

abstract class ClsMotorista extends Conexao{

	private $id;
	private $idCliente;
	private $name;
	private $password;
	private $strCampo;
	private $strValor;
	private $cnh;
	private $vencimentoCnh;
	private $cpf;
	private $dataNascimento;
	
	// Paginacao
	private $pagina_inicial;
	private $registo_por_pagina;

	public $tabela = "tbmotorista";
	public $keyId = "id_motorista";
	
    public function getId(){ return $this->id; }
	public function setId($id){ $this->id = $id; }
    
	public function getNome(){ return $this->name; }	
	public function setNome($name){ $this->name = $name; }

	public function getIdCliente(){ return $this->idCliente; }	
	public function setIdCliente($idCliente){ $this->idCliente = $idCliente; }

	public function getCnh(){ return $this->cnh; }	
	public function setCnh($cnh){ $this->cnh = $cnh; }
	
	public function getDataVencimentoCnh(){ return $this->vencimentoCnh; }	
	public function setDataVencimentoCnh($vencimentoCnh){ $this->vencimentoCnh = $vencimentoCnh; }

	public function getCpf(){ return $this->cpf; }	
	public function setCpf($cpf){ $this->cpf = $cpf; }

	public function getDataNascimento(){ return $this->dataNascimento; }	
	public function setDataNascimento($dataNascimento){ $this->dataNascimento = $dataNascimento; }

	// Paginacao 
	public function getPaginaInicial(){ return $this->pagina_inicial; }
	public function setPaginaInicial($pagina_inicial){ $this->pagina_inicial = $pagina_inicial; }

	public function getRegistroPorPagina(){ return $this->registo_por_pagina; }
	public function setRegistroPorPagina($registo_por_pagina) { $this->registo_por_pagina = $registo_por_pagina; }
}

interface itfMotorista
{

	function cadastrar(ClsMotorista $objClass);
	function atualizar(ClsMotorista $objClass);
	function deletar(ClsMotorista $objClass);
	function buscar_id(ClsMotorista $objClass);
	function ifExist(ClsMotorista $objClass);
	function ifExistId(ClsMotorista $objClass);
	function listar(ClsMotorista $objClass);
	function listar_combo(ClsMotorista $objClass);
	function count(ClsMotorista $objClass);
}

class DaoMotorista implements itfMotorista{

	public function cadastrar(ClsMotorista $objClass){
		$pdo = Conexao::getConn();
		
		$sql = " INSERT INTO ".$objClass->tabela." (id_cliente, nome_motorista, cnh, data_vencimento_cnh, cpf, data_nascimento) 
		VALUES (:id_cliente, :nome_motorista, :cnh, :data_vencimento_cnh, :cpf, :data_nascimento);";
		
		$stmt = $pdo->prepare($sql);
		$stmt->bindValue(":id_cliente", $objClass->getIdCliente());
		$stmt->bindValue(":nome_motorista", $objClass->getNome());
		$stmt->bindValue(":cnh", $objClass->getCnh());
		$stmt->bindValue(":data_vencimento_cnh", $objClass->getDataVencimentoCnh());
		$stmt->bindValue(":cpf", $objClass->getCpf());
		$stmt->bindValue(":data_nascimento", $objClass->getDataNascimento());
		$stmt->execute();

		return $pdo->lastInsertId();
	}

	public function atualizar(ClsMotorista $objClass){
		$pdo = Conexao::getConn();
		
		$sql = "UPDATE ".$objClass->tabela." SET ";
		$sql .= "nome_motorista = :nome_motorista, cnh = :cnh, data_vencimento_cnh = :data_vencimento_cnh, cpf = :cpf, data_nascimento = :data_nascimento";		
		$sql .= " WHERE ".$objClass->keyId." = :id_motorista AND id_cliente = ".$_SESSION['id_cliente']." AND flag_excluido = 0";

		$stmt = $pdo->prepare($sql);
		$stmt->bindvalue(":id_motorista",$objClass->getId());
		$stmt->bindValue(":nome_motorista",$objClass->getNome());
		$stmt->bindValue(":cnh",$objClass->getCnh());
		$stmt->bindValue(":data_vencimento_cnh",$objClass->getDataVencimentoCnh());
		$stmt->bindValue(":cpf",$objClass->getCpf());
		$stmt->bindValue(":data_nascimento",$objClass->getDataNascimento());
		$stmt->execute();

		return 1;
	}

	public function deletar(ClsMotorista $objClass){
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

	public function buscar_id(ClsMotorista $objClass){
        $pdo = Conexao::getConn();
		
		$sql = "SELECT * FROM ".$objClass->tabela." WHERE ".$objClass->keyId." = :id";
		
		$stmt = $pdo->prepare($sql);
		$stmt->bindValue(":id",$objClass->getId()); 
		$stmt->execute();

		$objResultado = $stmt->fetch(\PDO::FETCH_ASSOC);

		return $objResultado;
	}

	public function ifExist(ClsMotorista $objClass){

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

	public function ifExistId(ClsMotorista $objClass){
        $pdo = Conexao::getConn();
		
		$sql = "SELECT * ";
		$sql .= "FROM ".$objClass->tabela;
		$sql .= " WHERE ".$objClass->getStrCampo()." = '".$objClass->getStrValor()."';";
		
		$stmt = $pdo->prepare($sql);
		$stmt->execute();

		$objResultado = $stmt->fetchAll(\PDO::FETCH_ASSOC);

		return count($objResultado);
	}

	public function listar(ClsMotorista $objClass){
        $pdo = Conexao::getConn();
		
		$sql = "SELECT * FROM ".$objClass->tabela." WHERE id_cliente = ".$_SESSION['id_cliente']."";
		
		$stmt = $pdo->prepare($sql);
		$stmt->execute();

		$objResultado = $stmt->fetchAll(\PDO::FETCH_ASSOC);

		return $objResultado;
	}

	public function listar_combo(ClsMotorista $objClass){
        $pdo = Conexao::getConn();
		
		$sql = "SELECT id, name from ".$objClass->tabela." WHERE id_motorista NOT in (1) ORDER BY name ASC;";

		$stmt = $pdo->prepare($sql);
		$stmt->execute();

		return $stmt->fetchAll(\PDO::FETCH_ASSOC);
	}

	public function count(ClsMotorista $objClass){
        $pdo = Conexao::getConn();
		
		$sql = "SELECT count(*) AS Qtd FROM ".$objClass->tabela.";";

		$stmt = $pdo->prepare($sql);
		$stmt->execute();

		return $stmt->fetchColumn();
	}
}