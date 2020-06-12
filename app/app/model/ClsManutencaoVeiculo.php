<?php

namespace App\model;

use App\model\Conexao;

abstract class ClsManutencaoVeiculo extends Conexao{

	private $id;
	private $id_cliente;
	private $titulo;
	private $fornecedor;
	private $veiculo;
	private $manutencao_tipo;
	private $data_vencimento;
	private $valor;
	private $descricao;
	private $strCampo;
	private $strValor;

	// Paginacao
	private $pagina_inicial;
	private $registo_por_pagina;

	private $dataNascimento;

	public $tabela = "tbmanutencao_veiculo";
	public $keyId = "id_manutencao";
	
    public function getId(){ return $this->id; }
	public function setId($id){ $this->id = $id; }
	
	public function getIdCliente(){ return $this->id_cliente; }	
	public function setIdCliente($id_cliente){ $this->id_cliente = $id_cliente; }

	public function getTitulo(){ return $this->titulo; }	
	public function setTitulo($titulo){ $this->titulo = $titulo; }

	public function getFornecedor(){ return $this->fornecedor; }	
	public function setFornecedor($fornecedor){ $this->fornecedor = $fornecedor; }

	public function getVeiculo(){ return $this->veiculo; }	
	public function setVeiculo($veiculo){ $this->veiculo = $veiculo; }

	public function getManutencaoTipo(){ return $this->manutencao_tipo; }	
	public function setManutencaoTipo($manutencao_tipo){ $this->manutencao_tipo = $manutencao_tipo; }

	public function getDataVencimento(){ return $this->data_vencimento; }	
	public function setDataVencimento($data_vencimento){ $this->data_vencimento = $data_vencimento; }

	public function getValor(){ return $this->valor; }	
	public function setValor($valor){ $this->valor = $valor; }

	public function getDescricao() { return $this->descricao; }
	public function setDescricao($descricao){ $this->descricao = $descricao; }

	public function getSitucaoPagamento(){ return $this->situacao_pagamento; }	
	public function setSituacaoPagamento($situacao_pagamento){ $this->situacao_pagamento = $situacao_pagamento; }
}

interface itfManutencaoVeiculo
{

	function cadastrar(ClsManutencaoVeiculo $objClass);
	function atualizar(ClsManutencaoVeiculo $objClass);
	function deletar(ClsManutencaoVeiculo $objClass);
	function buscar_id(ClsManutencaoVeiculo $objClass);
	function ifExist(ClsManutencaoVeiculo $objClass);
	function ifExistId(ClsManutencaoVeiculo $objClass);
	function listar(ClsManutencaoVeiculo $objClass);
	function listarTodos(ClsManutencaoVeiculo $objClass);
	function listar_combo(ClsManutencaoVeiculo $objClass);
	function count(ClsManutencaoVeiculo $objClass);
}

class DaoManutencaoVeiculo implements itfManutencaoVeiculo{

	public function cadastrar(ClsManutencaoVeiculo $objClass){
		$pdo = Conexao::getConn();
		
		$sql = " INSERT INTO ".$objClass->tabela." (id_cliente, titulo, id_fornecedor, id_veiculo, id_manutencao_tipo, data_vencimento, valor, descricao, id_situacao) 
		VALUES (:id_cliente, :titulo, :id_fornecedor, :id_veiculo, :id_manutencao_tipo, :data_vencimento, :valor, :descricao, :id_situacao);";
		
		$stmt = $pdo->prepare($sql);
		$stmt->bindValue(":id_cliente", $objClass->getIdCliente());
		$stmt->bindValue(":titulo", $objClass->getTitulo());
		$stmt->bindValue(":id_fornecedor", $objClass->getFornecedor());
		$stmt->bindValue(":id_veiculo", $objClass->getVeiculo());
		$stmt->bindValue(":id_manutencao_tipo", $objClass->getManutencaoTipo());
		$stmt->bindValue(":data_vencimento", $objClass->getDataVencimento());

		$stmt->bindValue(":valor", $objClass->getValor());
		$stmt->bindValue(":descricao", $objClass->getDescricao());
		$stmt->bindValue(":id_situacao", $objClass->getSitucaoPagamento());
		$stmt->execute();

		return $pdo->lastInsertId();
	}

	public function atualizar(ClsManutencaoVeiculo $objClass){
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

	public function deletar(ClsManutencaoVeiculo $objClass)
	{
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

	public function buscar_id(ClsManutencaoVeiculo $objClass)
	{
        $pdo = Conexao::getConn();
		
		$sql = "SELECT * FROM ".$objClass->tabela." WHERE ".$objClass->keyId." = :id";
		
		$stmt = $pdo->prepare($sql);
		$stmt->bindValue(":id",$objClass->getId()); 
		$stmt->execute();

		$objResultado = $stmt->fetch(\PDO::FETCH_ASSOC);

		return $objResultado;
	}

	public function ifExist(ClsManutencaoVeiculo $objClass)
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

	public function ifExistId(ClsManutencaoVeiculo $objClass)
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



	public function listar(ClsManutencaoVeiculo $objClass)
	{
        $pdo = Conexao::getConn();
		
		$sql = "SELECT a.*, b.*, c.*, d.*, e.* FROM ".$objClass->tabela." a
			INNER JOIN tbveiculo b ON (b.id_veiculo = a.id_veiculo)
			INNER JOIN tbfornecedor c ON (c.id_fornecedor = a.id_fornecedor) 
			INNER JOIN tbmanutencao_tipo d ON (d.id_manutencao_tipo = a.id_manutencao_tipo)
			INNER JOIN tbpagamento_situacao e ON (e.id_situacao = a.id_situacao)
		WHERE a.id_cliente = ".$_SESSION['id_cliente']." AND a.flag_excluido = 0";
		
		$stmt = $pdo->prepare($sql);
		$stmt->execute();

		$objResultado = $stmt->fetchAll(\PDO::FETCH_ASSOC);

		return $objResultado;
	}

	public function listarTodos(ClsManutencaoVeiculo $objClass)
	{
        $pdo = Conexao::getConn();
		
		$sql = "SELECT a.*, b.*, c.*, d.*, e.* FROM ".$objClass->tabela." a
			INNER JOIN tbveiculo b ON (b.id_veiculo = a.id_veiculo)
			INNER JOIN tbfornecedor c ON (c.id_fornecedor = a.id_fornecedor) 
			INNER JOIN tbmanutencao_tipo d ON (d.id_manutencao_tipo = a.id_manutencao_tipo)
			INNER JOIN tbpagamento_situacao e ON (e.id_situacao = a.id_situacao)
		WHERE a.id_cliente = ".$_SESSION['id_cliente']." AND a.flag_excluido = 0";
		
		$stmt = $pdo->prepare($sql);
		$stmt->execute();

		$objResultado = $stmt->fetchAll(\PDO::FETCH_ASSOC);

		return $objResultado;
	}

	public function listar_combo(ClsManutencaoVeiculo $objClass)
	{
        $pdo = Conexao::getConn();
		
		$sql = "SELECT id, name from ".$objClass->tabela." WHERE id_motorista NOT in (1) ORDER BY name ASC;";

		$stmt = $pdo->prepare($sql);
		$stmt->execute();

		return $stmt->fetchAll(\PDO::FETCH_ASSOC);
	}

	public function count(ClsManutencaoVeiculo $objClass)
	{
        $pdo = Conexao::getConn();
		
		$sql = "SELECT count(*) AS Qtd FROM ".$objClass->tabela.";";

		$stmt = $pdo->prepare($sql);
		$stmt->execute();

		return $stmt->fetchColumn();
	}
}