<?php

namespace App\model;

use App\model\Conexao;

abstract class ClsVeiculo extends Conexao
{
	private $id;
	private $idCliente;
	private $placa;
	private $renavam;
	private $cor;
	private $ano_fabricacao;
	private $ano_modelo;
	private $quantidade_tanque;
	private $chassi;
	private $modelo_veiculo;
	private $tipo_combustivel;
	private $categoria_veiculo;
	private $tipo_veiculo;
	private $data_inicial;
	private $data_final;

	private $strCampo;
	private $strValor;	
	
	public $tabela = "tbveiculo";
	public $keyId = "id_veiculo ";
	
    public function getId(){ return $this->id; }
	public function setId($id){ $this->id = $id; }

	public function getIdCliente (){ return $this->idCliente; }	
	public function setIdCliente($idCliente){ $this->idCliente = $idCliente; }
    
	public function getPlaca(){ return $this->placa; }	
	public function setPlaca($placa){ $this->placa = $placa; }

	public function getRenavam(){ return $this->renavam; }	
	public function setRenavam($renavam){ $this->renavam = $renavam; }

	public function getCor(){ return $this->cor; }	
	public function setCor($cor){ $this->cor = $cor; }

	public function getAnoFabricao(){ return $this->ano_fabricacao; }	
	public function setAnoFabricao($ano_fabricacao){ $this->ano_fabricacao = $ano_fabricacao; }

	public function getAnoModelo(){ return $this->ano_modelo; }	
	public function setAnoModelo($ano_modelo){ $this->ano_modelo = $ano_modelo; }

	public function getQuantidadeTanque(){ return $this->quantidade_tanque; }	
	public function setQuantidadeTanque($quantidade_tanque){ $this->quantidade_tanque = $quantidade_tanque; }

	public function getChassi(){ return $this->chassi; }	
	public function setChassi($chassi){ $this->chassi = $chassi; }

	public function getModeloVeiculo(){ return $this->modelo_veiculo; }	
	public function setModeloVeiculo($modelo_veiculo){ $this->modelo_veiculo = $modelo_veiculo; }
	
	public function getCombustivel(){ return $this->tipo_combustivel; }	
	public function setCombustivel($tipo_combustivel){ $this->tipo_combustivel = $tipo_combustivel; }

	public function getCategoriaVeiculo(){ return $this->categoria_veiculo; }	
	public function setCategoriaVeiculo($categoria_veiculo){ $this->categoria_veiculo = $categoria_veiculo; }

	public function getTipoVeiculo(){ return $this->tipo_veiculo; }	
	public function setTipoVeiculo($tipo_veiculo){ $this->tipo_veiculo = $tipo_veiculo; }

	# Usado no formulário do relatório

	public function getDataInicial(){ return $this->data_inicial; }	
	public function setDataInicial($data_inicial){ $this->data_inicial = $data_inicial; }

	public function getDataFinal(){ return $this->data_final; }	
	public function setDataFinal($data_final){ $this->data_final = $data_final; }
}

interface itfVeiculo
{
	function cadastrar(ClsVeiculo $objClass);
	function atualizar(ClsVeiculo $objClass);
	function deletar(ClsVeiculo $objClass);
	function buscar_id(ClsVeiculo $objClass);
	function ifExist(ClsVeiculo $objClass);
	function ifExistId(ClsVeiculo $objClass);
	function listar(ClsVeiculo $objClass);
	function listarTodos(ClsVeiculo $objClass);
	function listar_combo(ClsVeiculo $objClass);
	function count(ClsVeiculo $objClass);
}

class DaoVeiculo implements itfVeiculo
{

	public function cadastrar(ClsVeiculo $objClass)
	{	
		$pdo = Conexao::getConn();
		$sql = " INSERT INTO ".$objClass->tabela." (id_cliente, placa, renavam, cor, ano_fabricacao, ano_modelo, quantidade_tanque, chassi, id_modelo, id_combustivel, id_categoria_veiculo, id_tipo_veiculo)
		 values (:id_cliente, :placa, :renavam, :cor, :ano_fabricacao, :ano_modelo, :quantidade_tanque, :chassi, :id_modelo, :id_combustivel, :id_categoria_veiculo, :id_tipo_veiculo);";

		$stmt = $pdo->prepare($sql);
		$stmt->bindValue(":id_cliente", $objClass->getIdCliente());
		$stmt->bindValue(":placa", $objClass->getPlaca());
		$stmt->bindValue(":renavam", $objClass->getRenavam());
		$stmt->bindValue(":cor", $objClass->getCor());
		$stmt->bindValue(":ano_fabricacao", $objClass->getAnoFabricao());
		$stmt->bindValue(":ano_modelo", $objClass->getAnoModelo());
		$stmt->bindValue(":quantidade_tanque", $objClass->getQuantidadeTanque());
		$stmt->bindValue(":chassi", $objClass->getChassi());
		$stmt->bindValue(":id_modelo", $objClass->getModeloVeiculo());
		$stmt->bindValue(":id_combustivel", $objClass->getCombustivel());
		$stmt->bindValue(":id_categoria_veiculo", $objClass->getCategoriaVeiculo());
		$stmt->bindValue(":id_tipo_veiculo", $objClass->getTipoVeiculo());

		$stmt->execute();

		return $pdo->lastInsertId();
	}

	public function atualizar(ClsVeiculo $objClass)
	{
		$pdo = Conexao::getConn();

		$sql = "UPDATE ".$objClass->tabela." SET ";
		$sql .= "nome_modelo = :nome_modelo ";		
		$sql .= "WHERE ".$objClass->keyId." = :id_veiculo";

		$stmt = $pdo->prepare($sql);
		$stmt->bindvalue(":id_veiculo",$objClass->getId());
		$stmt->bindValue(":nome_modelo",$objClass->getPlaca());
		$stmt->execute();
	

		return 1;
	}

	public function deletar(ClsVeiculo $objClass){
		$pdo = Conexao::getConn();

		$sql = "UPDATE ".$objClass->tabela." SET flag_excluido = 1  WHERE ".$objClass->keyId." = :id_veiculo AND id_cliente = :id_cliente";
		$stmt = $pdo->prepare($sql);
		$stmt->bindValue(":id_veiculo",$objClass->getId()); 
		$stmt->bindValue(":id_cliente", $_SESSION['id_cliente']);
		$stmt->execute();
		
		return 1;			
        
		$db->close();
	}

	public function buscar_id(ClsVeiculo $objClass)
	{		
        $pdo = Conexao::getConn();
		
		$sql = "SELECT * FROM ".$objClass->tabela." WHERE ".$objClass->keyId." = :id";
		
		$stmt = $pdo->prepare($sql);
		$stmt->bindValue(":id",$objClass->getId());
		$stmt->execute();

		$objResultado = $stmt->fetch(\PDO::FETCH_ASSOC);

		return $objResultado;
	}

	public function ifExist(ClsVeiculo $objClass)
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

	public function ifExistId(ClsVeiculo $objClass)
	{
        $pdo = Conexao::getConn();
		
		$sql = "select * ";
		$sql .= "from ".$objClass->tabela;
		$sql .= " where ".$objClass->getStrCampo()." = '".$objClass->getStrValor()."';";
		
		$stmt = $pdo->prepare($sql);
		$stmt->execute();//Executa A Query

		$objResultado = $stmt->fetchAll(\PDO::FETCH_ASSOC);

		return count($objResultado);
	}

	public function listar(ClsVeiculo $objClass)
	{	
        $pdo = Conexao::getConn();
		
		$sql = "SELECT * FROM ".$objClass->tabela." a
			LEFT JOIN tbveiculo_modelo b ON (b.id_modelo = a.id_modelo)
			LEFT JOIN tbcategoria_combustivel c ON (c.id_combustivel = a.id_combustivel)
			LEFT JOIN tbveiculo_categoria d ON (d.id_categoria_veiculo = a.id_categoria_veiculo)
		WHERE a.id_cliente = ".$_SESSION['id_cliente']." AND a.flag_excluido = 0";
		
		$stmt = $pdo->prepare($sql);
		$stmt->execute();

		$objResultado = $stmt->fetchAll(\PDO::FETCH_ASSOC);

		return $objResultado;
	}

	public function listarTodos(ClsVeiculo $objClass)
	{	
        $pdo = Conexao::getConn();
		
		$sql = "SELECT a.*, b.*, c.*, d.*, e.* FROM ".$objClass->tabela." a
			INNER JOIN tbveiculo_modelo b ON (b.id_modelo = a.id_modelo)
			INNER JOIN tbcategoria_combustivel c ON (c.id_combustivel = a.id_combustivel)
			INNER JOIN tbveiculo_categoria d ON (d.id_categoria_veiculo = a.id_categoria_veiculo)
			INNER JOIN tbveiculo_fabricante e ON(e.id_fabricante = b.id_fabricante)
		WHERE a.id_cliente = ".$_SESSION['id_cliente']." 

		AND a.id_modelo IN(".implode(',', $objClass->getModeloVeiculo() ).")
		AND a.id_categoria_veiculo IN(".implode(',', $objClass->getCategoriaVeiculo() ).")
		AND a.id_tipo_veiculo IN(".implode(',', $objClass->getTipoVeiculo()).")
		AND a.id_combustivel IN(".implode(',', $objClass->getCombustivel()).") 
		AND a.ano_fabricacao BETWEEN :data_inicial AND :data_final AND a.flag_excluido = 0 ORDER BY a.id_veiculo DESC";
	
		$stmt = $pdo->prepare($sql);	
		$stmt->bindValue(':data_inicial', $objClass->getDataInicial(), \PDO::PARAM_STR);
		$stmt->bindValue(':data_final', $objClass->getDataFinal(), \PDO::PARAM_STR);
		$stmt->execute();

		$objResultado = $stmt->fetchAll(\PDO::FETCH_ASSOC);

		return $objResultado;
	}

	public function listar_combo(ClsVeiculo $objClass)
	{
        $pdo = Conexao::getConn();
		
		$sql = "SELECT id_veiculo, name FROM ".$objClass->tabela." where id not in (1) order by name asc;";

		$stmt = $pdo->prepare($sql);
		$stmt->execute();

		return $stmt->fetchAll(\PDO::FETCH_ASSOC);
	}

	public function count(ClsVeiculo $objClass)
	{	
        $pdo = Conexao::getConn();
		
		$sql = "SELECT COUNT(*) as Qtd from ".$objClass->tabela.";";

		$stmt = $pdo->prepare($sql);
		$stmt->execute();

		return $stmt->fetchColumn();
	}
}