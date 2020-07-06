<?php

namespace App\model;

use App\model\Conexao;

abstract class ClsMovTransito extends Conexao{

	private $id;
	private $idCliente;
	private $fornecedor;
	private $quantidade;
	private $data_entrada;
	private $comprovante;
	private $motorista;
	private $placa;
	private $tipo_combustivel;
	private $valorUnitario;
	private $valorTotal;
	private $quilometragem;

	# Formulário Relatório
	private $data_inicial;
	private $data_final;

	private $strCampo;
	private $strValor;	
	
	public $tabela = "tbmov_transito";
	public $keyId = "id_transito";
	
    public function getId(){ return $this->id; }
	public function setId($id){ $this->id = $id; }
	
	public function getIdCliente(){ return $this->idCliente; }	
	public function setIdCliente($idCliente){ $this->idCliente = $idCliente; }

	public function getFornecedor(){ return $this->fornecedor; }	
	public function setFornecedor($fornecedor){ $this->fornecedor = $fornecedor; }

	public function getQuantidade(){ return $this->quantidade; }	
	public function setQuantidade($quantidade){ $this->quantidade = $quantidade; }

	public function getDataTransito(){ return $this->data_entrada; }	
	public function setDataTransito($data_entrada){ $this->data_entrada = $data_entrada; }
	
	public function getComprovante(){ return $this->comprovante; }	
	public function setComprovante($comprovante){ $this->comprovante = $comprovante; }

	public function getQuilometragem(){ return $this->quilometragem; }	
	public function setQuilometragem($quilometragem){ $this->quilometragem = $quilometragem; }	

	public function getMotorista(){ return $this->motorista; }	
	public function setMotorista($motorista){ $this->motorista = $motorista; }

	public function getTipoCombustivel(){ return $this->tipo_combustivel; }	
	public function setTipoCombustivel($tipo_combustivel){ $this->tipo_combustivel = $tipo_combustivel; }	

	public function getVeiculo(){ return $this->placa; }	
	public function setVeiculo($placa){ $this->placa = $placa; }

	public function getValorUnitario(){ return $this->valor_unitario; }	
	public function setValorUnitario($valor_unitario){ $this->valor_unitario = $valor_unitario; }

	public function getValorTotal(){ return $this->valor_total; }	
	public function setValorTotal($valor_total){ $this->valor_total = $valor_total; }

	# Usado no formulário do relatório

	public function getDataInicial(){ return $this->data_inicial; }	
	public function setDataInicial($data_inicial){ $this->data_inicial = $data_inicial; }

	public function getDataFinal(){ return $this->data_final; }	
	public function setDataFinal($data_final){ $this->data_final = $data_final; }
}

interface interfaceMovTransito{

	function cadastrar(ClsMovTransito $objClass);
	function atualizar(ClsMovTransito $objClass);
	function deletar(ClsMovTransito $objClass);
	function buscar_id(ClsMovTransito $objClass);
	function ifExist(ClsMovTransito $objClass);
	function ifExistId(ClsMovTransito $objClass);
	function listar(ClsMovTransito $objClass);
	function quantidadeTotalEntrada(ClsMovTransito $objClass);
	function listarTodos(ClsMovTransito $objClass);
}

class DaoMovTransito implements interfaceMovTransito{

	public function cadastrar(ClsMovTransito $objClass)
	{	
		$pdo = Conexao::getConn();
		
		$sql = " INSERT INTO ".$objClass->tabela." (id_cliente, id_fornecedor, quantidade, data_hora, comprovante, km, id_motorista, id_combustivel, id_veiculo, valor_unitario, valor_total)
		 values (:id_cliente, :id_fornecedor, :quantidade, :data_hora, :comprovante, :km, :id_motorista, :id_combustivel, :id_veiculo, :valor_unitario, :valor_total);";
		
		$stmt = $pdo->prepare($sql);
		$stmt->bindValue(":id_cliente", $objClass->getIdCliente());
		$stmt->bindValue(":id_fornecedor", $objClass->getFornecedor());
		$stmt->bindValue(":quantidade", $objClass->getQuantidade());
		$stmt->bindValue(":data_hora", $objClass->getDataTransito());
		$stmt->bindValue(":comprovante", $objClass->getComprovante());
		$stmt->bindValue(":km", $objClass->getQuilometragem());
		$stmt->bindValue(":id_motorista", $objClass->getMotorista());
		$stmt->bindValue(":id_combustivel", $objClass->getTipoCombustivel());
		$stmt->bindValue(":id_veiculo", $objClass->getVeiculo());
		$stmt->bindValue(":valor_unitario", $objClass->getValorUnitario());
		$stmt->bindValue(":valor_total", $objClass->getValorTotal());
		$stmt->execute();

		return $pdo->lastInsertId();
	}

	public function atualizar(ClsMovTransito $objClass)
	{	
		$pdo = Conexao::getConn();
		
		$sql = "UPDATE ".$objClass->tabela." SET ";
		$sql .= "nota_fiscal = :nota_fiscal, quantidade = :quantidade, id_fornecedor = :id_fornecedor, id_tanque = :id_tanque, motorista = :motorista, data_entrada = :data_entrada, placa = :placa, valor_unitario = :valor_unitario, valor_total = :valor_total";		
		$sql .= " WHERE ".$objClass->keyId." = :id_entrada AND id_cliente = ".$_SESSION['id_cliente']."";

		$stmt = $pdo->prepare($sql);
		$stmt->bindvalue(":id_entrada",$objClass->getId());
		$stmt->bindValue(":nota_fiscal", $objClass->getNotaFiscal());
		$stmt->bindValue(":quantidade", $objClass->getQuantidade());
		$stmt->bindValue(":id_fornecedor", $objClass->getFornecedor());
		$stmt->bindValue(":id_tanque", $objClass->getTanque());
		$stmt->bindValue(":motorista", $objClass->getMotorista());
		$stmt->bindValue(":data_entrada", $objClass->getDataEntrada());
		$stmt->bindValue(":placa", $objClass->getPlaca());
		$stmt->bindValue(":valor_unitario", $objClass->getValorUnitario());
		$stmt->bindValue(":valor_total", $objClass->getValorTotal());
		$stmt->execute();
		
		return 1;
	}


	public function deletar(ClsMovTransito $objClass){
		$pdo = Conexao::getConn();
		
		$sql = "UPDATE ".$objClass->tabela." SET ";
		$sql .= "flag_excluido = :flag_excluido ";		
		$sql .= " WHERE ".$objClass->keyId." = :id_entrada";

		$stmt = $pdo->prepare($sql);
		$stmt->bindvalue(":id_entrada",$objClass->getId());
		$stmt->bindValue(":flag_excluido",1);
		$stmt->execute();

		return 1;
	}

	public function buscar_id(ClsMovTransito $objClass)
	{
        $pdo = Conexao::getConn();
		
		$sql = "SELECT * FROM ".$objClass->tabela." WHERE ".$objClass->keyId." = :id";
		
		$stmt = $pdo->prepare($sql);
		$stmt->bindValue(":id",$objClass->getId());
		$stmt->execute();

		$objResultado = $stmt->fetch(\PDO::FETCH_ASSOC);

		return $objResultado;
	}

	public function ifExist(ClsMovTransito $objClass)
	{
		$pdo = Conexao::getConn();
		
		$sql = "SELECT * ";
		$sql .= "FROM ".$objClass->tabela;
		$sql .= " WHERE ".$objClass->getStrCampo()." = '".$objClass->getStrValor()."'";
		if (trim($objClass->getId()) != "") {
			$sql .= " and ".$objClass->keyId." <> ".$objClass->getId().";";
		}
		
		$stmt = $pdo->prepare($sql);
		$stmt->execute();

		$objResultado = $stmt->fetchAll(\PDO::FETCH_ASSOC);

		return count($objResultado);
	}

	public function ifExistId(ClsMovTransito $objClass)
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
	
	public function quantidadeTotalEntrada(ClsMovTransito $objClass)
	{
        $pdo = Conexao::getConn();
		
		$sql = "SELECT SUM(quantidade) AS quantidade FROM ".$objClass->tabela."
		WHERE id_tanque = :id_tanque AND id_cliente = ".$_SESSION['id_cliente']." AND flag_excluido = 0";
		$stmt = $pdo->prepare($sql);
		$stmt->bindValue(":id_tanque",$objClass->getTanque()); 
		$stmt->execute();

		$objResultado = $stmt->fetchAll(\PDO::FETCH_ASSOC);

		return $objResultado;
	}

	public function listar(ClsMovTransito $objClass)
	{
        $pdo = Conexao::getConn();
		
		$sql = "SELECT a.*, b.*, c.*, d.*, e.*, f.* FROM ".$objClass->tabela." a
            INNER JOIN tbclientes b ON (b.id_cliente = a.id_cliente)
            INNER JOIN tbfornecedor c ON (c.id_fornecedor = a.id_fornecedor) 
            INNER JOIN tbmotorista d ON (d.id_motorista = a.id_motorista)
            INNER JOIN tbcategoria_combustivel e ON (e.id_combustivel = a.id_combustivel)
            INNER JOIN tbveiculo f ON (f.id_veiculo = a.id_veiculo)
		WHERE a.id_cliente = ".$_SESSION['id_cliente']." AND a.flag_excluido = 0 ORDER BY id_transito DESC";
		
		$stmt = $pdo->prepare($sql);
		$stmt->execute(); 

		$objResultado = $stmt->fetchAll(\PDO::FETCH_ASSOC);

		return $objResultado;
	}

	public function listarTodos(ClsMovTransito $objClass)
	{
        $pdo = Conexao::getConn();
		
		$sql = "SELECT *, a.quantidade, a.data_hora, b.*, c.*, d.*, e.* FROM ".$objClass->tabela." a
			INNER JOIN tbfornecedor b ON (b.id_fornecedor = a.id_fornecedor)
			INNER JOIN tbmotorista c ON (c.id_motorista = a.id_motorista)
			INNER JOIN tbveiculo d ON (d.id_veiculo = a.id_veiculo)
			INNER JOIN tbcategoria_combustivel e ON (e.id_combustivel = a.id_combustivel)
			
		WHERE a.id_cliente = ".$_SESSION['id_cliente']." 
		AND a.id_fornecedor IN(".implode(',', $objClass->getFornecedor()).") 
		AND a.id_motorista IN(".implode(',', $objClass->getMotorista()).")
		AND a.id_veiculo IN(".implode(',', $objClass->getVeiculo()).")
		AND a.flag_excluido = 0 AND a.data_hora BETWEEN :data_inicial AND :data_final ORDER BY a.id_transito DESC";
		
		$stmt = $pdo->prepare($sql);
		$stmt->bindValue(':data_inicial', $objClass->getDataInicial(), \PDO::PARAM_STR);
		$stmt->bindValue(':data_final', $objClass->getDataFinal(), \PDO::PARAM_STR);
		$stmt->execute();

		$objResultado = $stmt->fetchAll(\PDO::FETCH_ASSOC);

		return $objResultado;
	}
}

?>