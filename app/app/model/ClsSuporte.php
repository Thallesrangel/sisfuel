<?php

namespace App\model;

use App\model\Conexao;

abstract class ClsSuporte extends Conexao{

	private $id;
	private $idCliente;
	private $requerente;
	private $titulo;
	private $descricao;
	private $arquivo;
	private $resposta;
	private $idSituacaoSuporte;

	// Paginacao
	private $pagina_inicial;
	private $registo_por_pagina;

	private $strCampo;
	private $strValor;

	public $tabela = "tbsuporte";
	public $keyId = "id_suporte";
	
    public function getId(){ return $this->id; }
	public function setId($id){ $this->id = $id; }
	
	public function getIdCliente(){ return $this->idCliente; }	
	public function setIdCliente($idCliente){ $this->idCliente = $idCliente; }

	public function getRequerente(){ return $this->requerente; }	
	public function setRequerente($requerente){ $this->requerente = $requerente; }

	public function getTitulo(){ return $this->titulo; }	
	public function setTitulo($titulo){ $this->titulo = $titulo; }

	public function getDescricao(){ return $this->descricao; }	
	public function setDescricao($descricao){ $this->descricao = $descricao; }

	public function getArquivo(){ return $this->arquivo; }	
	public function setArquivo($arquivo){ $this->arquivo = $arquivo; }

	public function getResposta(){ return $this->resposta; }	
	public function setResposta($resposta){ $this->resposta = $resposta; }

	public function getIdSituacaoSuporte(){ return $this->idSituacaoSuporte; }	
	public function setIdSituacaoSuporte($idSituacaoSuporte){ $this->idSituacaoSuporte = $idSituacaoSuporte; }

	// Paginacao 
	public function getPaginaInicial(){ return $this->pagina_inicial; }
	public function setPaginaInicial($pagina_inicial){ $this->pagina_inicial = $pagina_inicial; }

	public function getRegistroPorPagina(){ return $this->registo_por_pagina; }
	public function setRegistroPorPagina($registo_por_pagina) { $this->registo_por_pagina = $registo_por_pagina; }

}

interface itfSuporte
{
	function cadastrar(ClsSuporte $objClass);
	function atualizar(ClsSuporte $objClass);
	function deletar(ClsSuporte $objClass);
	function buscar_id(ClsSuporte $objClass);
	function ifExist(ClsSuporte $objClass);
	function ifExistId(ClsSuporte $objClass);
	function listar(ClsSuporte $objClass);
	function listar_combo(ClsSuporte $objClass);
	function count(ClsSuporte $objClass);
}

class DaoSuporte implements itfSuporte
{
	public function cadastrar(ClsSuporte $objClass)
	{	
		$pdo = Conexao::getConn();
		
		$sql = " INSERT INTO ".$objClass->tabela." (id_cliente, requerente, titulo, descricao)
		 values (:id_cliente, :requerente, :titulo, :descricao );";
		
		$stmt = $pdo->prepare($sql);
		$stmt->bindValue(":id_cliente", $objClass->getIdCliente());
		$stmt->bindValue(":requerente", $objClass->getRequerente());
		$stmt->bindValue(":titulo", $objClass->getTitulo());
		$stmt->bindValue(":descricao", $objClass->getDescricao());
		$stmt->execute();

		return $pdo->lastInsertId();
	}

	public function atualizar(ClsSuporte $objClass)
	{
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

	public function deletar(ClsSuporte $objClass)
	{
		$pdo = Conexao::getConn();

		if (intval($objClass->getId()) == 1) {
			return 0;	
		} else {
			
			$sql = "DELETE FROM ".$objClass->tabela." WHERE ".$objClass->keyId." = :id_combustivel AND ".$objClass->keyId." <> 1";
		
			$stmt = $pdo->prepare($sql);
			$stmt->bindValue(":id_combustivel",$objClass->getId()); 
			$stmt->execute();
			
			return 1;			
        }
		$db->close();
	}

	public function buscar_id(ClsSuporte $objClass)
	{
        $pdo = Conexao::getConn();
		
		$sql = "SELECT * FROM ".$objClass->tabela." WHERE ".$objClass->keyId." = :id";
		
		$stmt = $pdo->prepare($sql);
		$stmt->bindValue(":id",$objClass->getId());
		$stmt->execute();

		$objResultado = $stmt->fetch(\PDO::FETCH_ASSOC);

		return $objResultado;
	}

	public function ifExist(ClsSuporte $objClass)
	{
		$pdo = Conexao::getConn();
		
		$sql = "SELECT * ";
		$sql .= "FROM" . $objClass->tabela;
		$sql .= "WHERE" . $objClass->getStrCampo()." = '".$objClass->getStrValor()."'";
		if (trim($objClass->getId()) != "") {
			$sql .= " AND ".$objClass->keyId." <> ".$objClass->getId().";";
		}
		
		$stmt = $pdo->prepare($sql);
		$stmt->execute();

		$objResultado = $stmt->fetchAll(\PDO::FETCH_ASSOC);

		return count($objResultado);
	}

	public function ifExistId(ClsSuporte $objClass)
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

	public function listar(ClsSuporte $objClass)
	{
		
        $pdo = Conexao::getConn();

		$sql = "SELECT *, b.situacao FROM ".$objClass->tabela." a
			INNER JOIN tbsuporte_situacao b ON (b.id_suporte_situacao = a.id_suporte_situacao)
			WHERE a.id_cliente = ".$_SESSION['id_cliente']." AND flag_excluido = 0";

		
		$stmt = $pdo->prepare($sql);
		$stmt->execute();

		$objResultado = $stmt->fetchAll(\PDO::FETCH_ASSOC);

		return $objResultado;
	}

	public function selectCombustivel(ClsSuporte $objClass)
	{
        $pdo = Conexao::getConn();
		
		$sql = "SELECT * FROM ".$objClass->tabela.";";
		
		$stmt = $pdo->prepare($sql);
		$stmt->execute();

		$objResultado = $stmt->fetchAll(\PDO::FETCH_ASSOC);

		return $objResultado;
	}

	public function listar_combo(ClsSuporte $objClass)
	{
        $pdo = Conexao::getConn();
		
		$sql = "SELECT id, name FROM ".$objClass->tabela." WHERE id not in (1) order by name asc;";

		$stmt = $pdo->prepare($sql);
		$stmt->execute();

		return $stmt->fetchAll(\PDO::FETCH_ASSOC);
	}

	public function count(ClsSuporte $objClass)
	{
        $pdo = Conexao::getConn();
		
		$sql = "SELECT count(*) AS Qtd FROM ".$objClass->tabela.";";

		$stmt = $pdo->prepare($sql);
		$stmt->execute();

		return $stmt->fetchColumn();
	}
}

?>