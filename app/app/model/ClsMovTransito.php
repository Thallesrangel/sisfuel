<?php

namespace App\model;

use App\model\Conexao;

abstract class ClsMovTransito extends Conexao{

	private $id;
	private $idCliente;
	private $fornecedor;
	private $quantidade;
	private $tanque;
	private $dataEntrada;
	private $notaFiscal;
	private $motorista;
	private $placa;
	private $valorUnitario;
	private $valorTotal;

	# Formulário Relatório
	private $dataInicial;
	private $dataFinal;

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

	public function getTanque(){ return $this->tanque; }	
	public function setTanque($tanque){ $this->tanque = $tanque; }

	public function getDataEntrada(){ return $this->dataEntrada; }	
	public function setDataEntrada($dataEntrada){ $this->dataEntrada = $dataEntrada; }
	
	public function getNotaFiscal(){ return $this->notaFiscal; }	
	public function setNotaFiscal($notaFiscal){ $this->notaFiscal = $notaFiscal; }

	public function getMotorista(){ return $this->motorista; }	
	public function setMotorista($motorista){ $this->motorista = $motorista; }

	public function getPlaca(){ return $this->placa; }	
	public function setPlaca($placa){ $this->placa = $placa; }

	public function getValorUnitario(){ return $this->valorUnitario; }	
	public function setValorUnitario($valorUnitario){ $this->valorUnitario = $valorUnitario; }

	public function getValorTotal(){ return $this->valorTotal; }	
	public function setValorTotal($valorTotal){ $this->valorTotal = $valorTotal; }	
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
		
		$sql = " INSERT INTO ".$objClass->tabela." (nota_fiscal, id_cliente, motorista, quantidade, data_entrada, id_fornecedor, id_tanque, placa, valor_unitario, valor_total)
		 values (:nota_fiscal, :id_cliente, :motorista, :quantidade, :data_entrada, :id_fornecedor, :id_tanque, :placa, :valor_unitario, :valor_total);";
		
		$stmt = $pdo->prepare($sql);
		$stmt->bindValue(":id_cliente", $objClass->getIdCliente());
		$stmt->bindValue(":nota_fiscal", $objClass->getNotaFiscal());
		$stmt->bindValue(":motorista", $objClass->getMotorista());
		$stmt->bindValue(":quantidade", $objClass->getQuantidade());
		$stmt->bindValue(":data_entrada", $objClass->getDataEntrada());
		$stmt->bindValue(":id_fornecedor", $objClass->getFornecedor());
		$stmt->bindValue(":id_tanque", $objClass->getTanque());
		$stmt->bindValue(":placa", $objClass->getPlaca());
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
		
		$sql = "SELECT a.*, b.*, c.*, d.* FROM ".$objClass->tabela." a
            INNER JOIN tbclientes b ON (b.id_cliente = a.id_cliente)
            INNER JOIN tbfornecedor c ON (c.id_fornecedor = a.id_fornecedor) 
            INNER JOIN tbmotorista d ON (d.id_motorista = a.id_motorista)
            INNER JOIN tbcategoria_combustivel e ON (a.id_combustivel = a.id_combustivel)
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
		
		$sql = "SELECT *, a.quantidade, a.data_entrada, b.*, c.*, d.* FROM ".$objClass->tabela." a
			INNER JOIN tbtanque b ON (b.id_tanque = a.id_tanque)
			INNER JOIN tbunidade_medida c ON (c.id_medida = b.id_medida) 
			INNER JOIN tbfornecedor d ON (d.id_fornecedor = a.id_fornecedor) 
		WHERE a.id_cliente = ".$_SESSION['id_cliente']." AND a.flag_excluido = 0 AND a.data_entrada BETWEEN :data_inicial AND :data_final ORDER BY id_entrada DESC";
		
		$stmt = $pdo->prepare($sql);
		$stmt->bindValue(':data_inicial', $objClass->getDataInicial(), \PDO::PARAM_STR);
		$stmt->bindValue(':data_final', $objClass->getDataFinal(), \PDO::PARAM_STR);
		$stmt->execute();

		$objResultado = $stmt->fetchAll(\PDO::FETCH_ASSOC);

		return $objResultado;
	}
}

?>