<?php

namespace App\model;

use App\model\Conexao;

abstract class ClsFornecedor extends Conexao{

	private $id;
	private $idCliente;
	private $name;
	private $cnpj;
	private $areaAtuacao;

	// Paginacao
	private $pagina_inicial;
	private $registo_por_pagina;

	private $strCampo;
	private $strValor;

	public $tabela = "tbfornecedor";
	public $keyId = "id_fornecedor";
	 
    public function getId(){ return $this->id; }
	public function setId($id){ $this->id = $id; }

	public function getIdCliente(){ return $this->idCliente; }	
	public function setIdCliente($idCliente){ $this->idCliente = $idCliente; }
    
	public function getNome(){ return $this->name; }	
	public function setNome($name){ $this->name = $name; }

	public function getCnpj(){ return $this->cnpj; }	
	public function setCnpj($cnpj){ $this->cnpj = $cnpj; }

	public function getAreaAtuacao(){ return $this->areaAtuacao; }
	public function setAreaAtuacao($areaAtuacao){ $this->areaAtuacao = $areaAtuacao; }

	// Paginacao 
	public function getPaginaInicial(){ return $this->pagina_inicial; }
	public function setPaginaInicial($pagina_inicial){ $this->pagina_inicial = $pagina_inicial; }

	public function getRegistroPorPagina(){ return $this->registo_por_pagina; }
	public function setRegistroPorPagina($registo_por_pagina) { $this->registo_por_pagina = $registo_por_pagina; }

	
}

interface interfaceFornecedor{

	function cadastrar(ClsFornecedor $objClass);
	function atualizar(ClsFornecedor $objClass);
	function deletar(ClsFornecedor $objClass);
	function buscar_id(ClsFornecedor $objClass);
	function ifExist(ClsFornecedor $objClass);
	function ifExistId(ClsFornecedor $objClass);
	function listar(ClsFornecedor $objClass);
	function listarTodos(ClsFornecedor $objClass);
	function listarSeguradoras(ClsFornecedor $objClass);
	function listar_combo(ClsFornecedor $objClass);
	function count(ClsFornecedor $objClass);
}

class DaoFornecedor implements interfaceFornecedor{

	public function cadastrar(ClsFornecedor $objClass){
		$pdo = Conexao::getConn();
		
		$sql = " INSERT INTO ".$objClass->tabela." (id_cliente, razao_social, cnpj, id_area_atuacao)
		VALUES (:id_cliente, :razao_social, :cnpj, :id_area_atuacao);";
		
		$stmt = $pdo->prepare($sql);
		$stmt->bindValue(":id_cliente", $objClass->getIdCliente());
		$stmt->bindValue(":razao_social", $objClass->getNome());
		$stmt->bindValue(":cnpj", $objClass->getCnpj());
		$stmt->bindValue(":id_area_atuacao", $objClass->getAreaAtuacao());
		$stmt->execute();

		return $pdo->lastInsertId();
	}

	public function atualizar(ClsFornecedor $objClass){
		$pdo = Conexao::getConn();
		
		$sql = "UPDATE ".$objClass->tabela." SET ";
		$sql .= "nome_motorista = :nome_motorista";		
		$sql .= " WHERE ".$objClass->keyId." = :id_motorista";

		$stmt = $pdo->prepare($sql);
		$stmt->bindvalue(":id_motorista",$objClass->getId());
		$stmt->bindValue(":nome_motorista",$objClass->getNome());
		$stmt->execute();

		return 1;
	}

	public function deletar(ClsFornecedor $objClass){
		$pdo = Conexao::getConn();

		$sql = "UPDATE ".$objClass->tabela." SET flag_excluido = 1  WHERE ".$objClass->keyId." = :id_fornecedor AND id_cliente = :id_cliente";
		$stmt = $pdo->prepare($sql);
		$stmt->bindValue(":id_fornecedor",$objClass->getId()); 
		$stmt->bindValue(":id_cliente", $_SESSION['id_cliente']);
		$stmt->execute();
		
		return 1;			
        
		$db->close();
	}

	public function buscar_id(ClsFornecedor $objClass){
        $pdo = Conexao::getConn();
		
		$sql = "SELECT * FROM ".$objClass->tabela." WHERE ".$objClass->keyId." = :id";
		
		$stmt = $pdo->prepare($sql);
		$stmt->bindValue(":id",$objClass->getId()); 
		$stmt->execute();

		$objResultado = $stmt->fetch(\PDO::FETCH_ASSOC);

		return $objResultado;
	}

	public function ifExist(ClsFornecedor $objClass){

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

	public function ifExistId(ClsFornecedor $objClass){
        $pdo = Conexao::getConn();
		
		$sql = "SELECT * ";
		$sql .= "FROM ".$objClass->tabela;
		$sql .= " WHERE ".$objClass->getStrCampo()." = '".$objClass->getStrValor()."';";
		
		$stmt = $pdo->prepare($sql);
		$stmt->execute();

		$objResultado = $stmt->fetchAll(\PDO::FETCH_ASSOC);

		return count($objResultado);
	}

	public function listar(ClsFornecedor $objClass){
        $pdo = Conexao::getConn();
		
		$sql = "SELECT *, b.* FROM ".$objClass->tabela." a
			INNER JOIN tbfornecedor_atuacao b ON (b.id_area_atuacao = a.id_area_atuacao)
		WHERE id_cliente = ".$_SESSION['id_cliente']." AND flag_excluido = 0";
		
		$stmt = $pdo->prepare($sql);
		$stmt->execute();

		$objResultado = $stmt->fetchAll(\PDO::FETCH_ASSOC);

		return $objResultado;
	}

	public function listarTodos(ClsFornecedor $objClass){
        $pdo = Conexao::getConn();
		
		$sql = "SELECT *, b.* FROM ".$objClass->tabela." a
			INNER JOIN tbfornecedor_atuacao b ON (b.id_area_atuacao = a.id_area_atuacao)
		WHERE id_cliente = ".$_SESSION['id_cliente']." AND flag_excluido = 0";
		
		$stmt = $pdo->prepare($sql);
		$stmt->execute();

		$objResultado = $stmt->fetchAll(\PDO::FETCH_ASSOC);

		return $objResultado;
	}

	
	public function listarSeguradoras(ClsFornecedor $objClass){
        $pdo = Conexao::getConn();
		
		$sql = "SELECT *, b.* FROM ".$objClass->tabela." a
			INNER JOIN tbfornecedor_atuacao b ON (b.id_area_atuacao = a.id_area_atuacao)
		WHERE id_cliente = ".$_SESSION['id_cliente']." AND b.id_area_atuacao = 2";
		
		$stmt = $pdo->prepare($sql);
		$stmt->execute();

		$objResultado = $stmt->fetchAll(\PDO::FETCH_ASSOC);

		return $objResultado;
	}
	
	public function listar_combo(ClsFornecedor $objClass){
        $pdo = Conexao::getConn();
		
		$sql = "SELECT id, name from ".$objClass->tabela." WHERE id_motorista NOT in (1) ORDER BY name ASC;";

		$stmt = $pdo->prepare($sql);
		$stmt->execute();

		return $stmt->fetchAll(\PDO::FETCH_ASSOC);
	}

	public function count(ClsFornecedor $objClass){
        $pdo = Conexao::getConn();
		
		$sql = "SELECT count(*) AS Qtd FROM ".$objClass->tabela.";";

		$stmt = $pdo->prepare($sql);
		$stmt->execute();

		return $stmt->fetchColumn();
	}
}

?>