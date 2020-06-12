<?php

namespace App\model;

abstract class ClsCliente extends Conexao
{
	private $id;
	private $nome;
	private $cliente;
	private $plano;
	private $flag_tanque;
	private $documento;

	// Paginacao
	private $pagina_inicial;
	private $registo_por_pagina;

	private $strCampo;
	private $strValor;

	public $tabela = "tbclientes";
	public $keyId = "id_cliente";
	
    public function getId(){ return $this->id; }
	public function setId($id){ $this->id = $id; }
	
	public function getNome(){ return $this->nome; }	
	public function setNome($nome){ $this->nome = $nome; }

	public function getEmail(){ return $this->email; }
	public function setEmail($email){ $this->email = $email; }

	public function getTipoCliente(){ return $this->cliente; }
	public function setTipoCliente($cliente){ $this->cliente = $cliente; }

	public function getFlagTanque(){ return $this->flag_tanque; }
	public function setFlagTanque($flag_tanque){ $this->flag_tanque = $flag_tanque; }

	public function getPlano(){ return $this->plano; }
	public function setPlano($plano){ $this->plano = $plano; }

	public function getDocumento(){ return $this->documento; }
	public function setDocumento($documento){ $this->documento = $documento;}

	// Paginacao 
	public function getPaginaInicial(){ return $this->pagina_inicial; }
	public function setPaginaInicial($pagina_inicial){ $this->pagina_inicial = $pagina_inicial; }

	public function getRegistroPorPagina(){ return $this->registo_por_pagina; }
	public function setRegistroPorPagina($registo_por_pagina) { $this->registo_por_pagina = $registo_por_pagina; }

}

interface itfCliente{
	function cadastrar(ClsCliente $objClass);
	function buscarClienteNome(ClsCliente $objClass);
	function atualizar(ClsCliente $objClass);
	function deletar(ClsCliente $objClass);
	function listar(ClsCliente $objClass);
}

class DaoCliente implements itfCliente{

	public function cadastrar(ClsCliente $objClass)
	{
		$pdo = Conexao::getConn();
		
		$sql = " INSERT INTO ".$objClass->tabela." (id_plano, id_tipo, razao_social, email, documento, flag_tanque) 
		values (:id_plano, :id_tipo, :razao_social, :email, :documento, :flag_tanque);";
		
		$stmt = $pdo->prepare($sql);
		$stmt->bindValue(":id_plano", $objClass->getPlano());
		$stmt->bindValue(":id_tipo", $objClass->getTipoCliente());
		$stmt->bindValue(":razao_social", $objClass->getNome());
		$stmt->bindValue(":email", $objClass->getEmail());
		$stmt->bindValue(":documento", $objClass->getDocumento());
		$stmt->bindValue(":flag_tanque", $objClass->getFlagTanque());
	
		$stmt->execute();

		return $pdo->lastInsertId();
		
	}

	public function buscarClienteNome(ClsCliente $objClass)
	{
        $pdo = Conexao::getConn();
		
		$sql = "SELECT * FROM " . $objClass->tabela . " WHERE razao_social = :razao_social";
		$stmt = $pdo->prepare($sql);
		$stmt->bindValue(":razao_social", $objClass->getEmail()); 
		$stmt->execute();
	
		$objResultado = $stmt->fetch(\PDO::FETCH_ASSOC);
		
		return $objResultado;
		
	}

	public function atualizar(ClsCliente $objClass)
	{
		$pdo = Conexao::getConn();
		
		$sql = "UPDATE ".$objClass->tabela." SET ";
		$sql .= "razao_social = :razao_social";		
		$sql .= " WHERE ".$objClass->keyId." = :id_cliente";

		$stmt = $pdo->prepare($sql);
		$stmt->bindvalue(":id_cliente",$objClass->getId());
		$stmt->bindValue(":razao_social",$objClass->getNome());
		$stmt->execute();

		return 1;
	}

	public function deletar(ClsCliente $objClass)
	{
		$pdo = Conexao::getConn();

		if (intval($objClass->getId()) == 1) {
			return 0;	
		} else {
			
			$sql = "DELETE FROM ".$objClass->tabela." WHERE ".$objClass->keyId." = :id_cliente AND ".$objClass->keyId." > 0s";
		
			$stmt = $pdo->prepare($sql);
			$stmt->bindValue(":id_cliente",$objClass->getId()); 
			$stmt->execute();
			
			return 1;			
        }
		$db->close();
	}


	public function listar(ClsCliente $objClass)
	{	
        $pdo = Conexao::getConn();
		
		$sql = "SELECT * FROM ".$objClass->tabela." a
		LEFT JOIN tbclientes_tipo b ON (b.id_tipo = a.id_tipo)";
		
		$stmt = $pdo->prepare($sql);
		$stmt->execute();

		$objResultado = $stmt->fetchAll(\PDO::FETCH_ASSOC);

		return $objResultado;
	}
}