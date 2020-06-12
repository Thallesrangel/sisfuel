<?php

namespace App\model;

use App\model\Conexao;

abstract class ClsModeloVeiculo extends Conexao{

	private $id;
	private $idCliente;
	private $modelo;
	private $id_fabricante;

	// Paginacao
	private $pagina_inicial;
	private $registo_por_pagina;

	private $strCampo;
	private $strValor;

	public $tabela = "tbmodelo_veiculo";
	public $keyId = "id_modelo";
	
    public function getId(){ return $this->id; }
	public function setId($id){ $this->id = $id; }

	public function getIdCliente(){ return $this->idCliente; }	
	public function setIdCliente($idCliente){ $this->idCliente = $idCliente; }
    
	public function getModelo(){ return $this->modelo; }	
    public function setModelo($modelo){ $this->modelo = $modelo; }
    
    public function getFabricante(){ return $this->id_fabricante; }	
	public function setFabricante($id_fabricante){ $this->id_fabricante = $id_fabricante; }

	// Paginacao 
	public function getPaginaInicial(){ return $this->pagina_inicial; }
	public function setPaginaInicial($pagina_inicial){ $this->pagina_inicial = $pagina_inicial; }

	public function getRegistroPorPagina(){ return $this->registo_por_pagina; }
	public function setRegistroPorPagina($registo_por_pagina) { $this->registo_por_pagina = $registo_por_pagina; }
}

interface itfModeloVeiculo{

	function cadastrar(ClsModeloVeiculo $objClass);
	function atualizar(ClsModeloVeiculo $objClass);
	function deletar(ClsModeloVeiculo $objClass);
	function listar(ClsModeloVeiculo $objClass);
}

class DaoModeloVeiculo implements itfModeloVeiculo{

	public function cadastrar(ClsModeloVeiculo $objClass)
	{
		// Cria o objeto PDO
		$pdo = Conexao::getConn();
		
		$sql = " INSERT INTO ".$objClass->tabela." (id_cliente, modelo_veiculo, id_fabricante) values (:id_cliente, :modelo_veiculo, :id_fabricante);";
		
		$stmt = $pdo->prepare($sql);
		$stmt->bindValue(":id_cliente", $objClass->getIdCliente());
		$stmt->bindValue(":modelo_veiculo", $objClass->getModelo());
		$stmt->bindValue(":id_fabricante", $objClass->getFabricante());	
		$stmt->execute();

		return $pdo->lastInsertId();
	}

	public function atualizar(ClsModeloVeiculo $objClass){
		$pdo = Conexao::getConn();
		
		$sql = "UPDATE ".$objClass->tabela." SET ";
		$sql .= "categoria_combustivel = :categoria_combustivel ";		
		$sql .= " WHERE ".$objClass->keyId." = :id_combustivel";

		$stmt = $pdo->prepare($sql);
		$stmt->bindvalue(":id_combustivel",$objClass->getId());
		$stmt->bindValue(":categoria_combustivel",$objClass->getNome());
		$stmt->execute();
	
		return 1;
	}

	public function deletar(ClsModeloVeiculo $objClass){
		$pdo = Conexao::getConn();

		$sql = "DELETE FROM ".$objClass->tabela." WHERE ".$objClass->keyId." = :id_modelo";
	
		$stmt = $pdo->prepare($sql);
		$stmt->bindValue(":id_modelo",$objClass->getId()); 
		$stmt->execute();
		
		return 1;			
        
		$db->close();
	}

	public function listar(ClsModeloVeiculo $objClass){
		
		// Cria o objeto PDO
        $pdo = Conexao::getConn();
		
        $sql = "SELECT a.*, b.* FROM ".$objClass->tabela." a
            INNER JOIN tbfabricante_veiculo b ON (b.id_fabricante = a.id_fabricante)
        WHERE flag_excluido = 0;";
		
		$stmt = $pdo->prepare($sql);
		$stmt->execute();//Executa A Query

		$objResultado = $stmt->fetchAll(\PDO::FETCH_ASSOC);

		return $objResultado;
	}
}