<?php

namespace App\model;

use App\model\Conexao;

abstract class ClsUsuario extends Conexao{

	private $id;
	private $idCliente;
	private $name;
	private $email;
	private $idAcesso;
	private $password;
	private $permissoes;

	// Paginacao
	private $pagina_inicial;
	private $registo_por_pagina;

	private $strCampo;
	private $strValor;

	public $tabela = "tbusuarios";
	public $keyId = "id_usuario";
	
    public function getId(){ return $this->id; }
	public function setId($id){ $this->id = $id; }
	
	public function getIdCliente (){ return $this->idCliente; }	
	public function setIdCliente($idCliente){ $this->idCliente = $idCliente; }

	public function getEmail(){ return $this->email; }
	public function setEmail($email){ $this->email = $email; }
	
	public function getNome(){ return $this->name; }	
	public function setNome($name){ $this->name = $name; }

	public function getPassword(){ return $this->password; }	
	public function setPassword($password){ $this->password = $password; }

	public function getIdAcesso (){ return $this->idAcesso; }	
	public function setIdAcesso($idAcesso){ $this->idAcesso = $idAcesso; }

	public function getPermissoes(){ return $this->permissoes; }	
	public function setPermissoes($permissoes){$this->permissoes = $permissoes; }

	// Paginacao 
	public function getPaginaInicial(){ return $this->pagina_inicial; }
	public function setPaginaInicial($pagina_inicial){ $this->pagina_inicial = $pagina_inicial; }

	public function getRegistroPorPagina(){ return $this->registo_por_pagina; }
	public function setRegistroPorPagina($registo_por_pagina) { $this->registo_por_pagina = $registo_por_pagina; }
}

interface itfUsuario
{
	function cadastrarExterno(ClsUsuario $objClass);
	function atualizar(ClsUsuario $objClass);
	function deletar(ClsUsuario $objClass);
	function buscarUsuario(ClsUsuario $objClass);
	function cadastrarInterno(ClsUsuario $objClass);
	function ifExist(ClsUsuario $objClass);
	function ifExistId(ClsUsuario $objClass);
	function listar(ClsUsuario $objClass);
	function listarLiberar(ClsUsuario $objClass);
	//function listar_combo(ClsUsuario $objClass);
	function count(ClsUsuario $objClass);
	function definirPermissao(ClsUsuario $objClass);
}

class DaoUsuario implements itfUsuario{

	public function buscarUsuario(ClsUsuario $objClass)
	{
        $pdo = Conexao::getConn();
		
		$sql = "SELECT a.*, b.* FROM " . $objClass->tabela . " a
			LEFT JOIN tbclientes b ON (b.id_cliente = a.id_cliente)
		WHERE a.email = :email";
		$stmt = $pdo->prepare($sql);
		$stmt->bindValue(":email", $objClass->getEmail()); 
		$stmt->execute();
	
		$objResultado = $stmt->fetch(\PDO::FETCH_ASSOC);
		
		return $objResultado;
		
	}

	public function cadastrarExterno(ClsUsuario $objClass)
	{
		$pdo = Conexao::getConn();
		$sql = "INSERT INTO ".$objClass->tabela." (nome_usuario, id_cliente, email, senha, id_acesso) values (:nome_usuario,:id_cliente, :email, :senha, 2);";
		$stmt = $pdo->prepare($sql);
		$stmt->bindValue(":nome_usuario", $objClass->getNome());
		$stmt->bindValue(":id_cliente", $objClass->getIdCliente());
		$stmt->bindValue(":email", $objClass->getEmail());
		$stmt->bindValue(":senha", $objClass->getPassword());
		$stmt->execute();

		return $pdo->lastInsertId();
	}	

	public function cadastrarInterno(ClsUsuario $objClass)
	{
		$pdo = Conexao::getConn();
		$sql = "INSERT INTO ".$objClass->tabela." (nome_usuario, id_cliente, email, senha, id_acesso, permissoes) values (:nome_usuario,:id_cliente, :email, :senha, :id_acesso, :permissoes);";
		$stmt = $pdo->prepare($sql);
		$stmt->bindValue(":nome_usuario", $objClass->getNome());
		$stmt->bindValue(":id_cliente", $objClass->getIdCliente());
		$stmt->bindValue(":email", $objClass->getEmail());
		$stmt->bindValue(":senha", $objClass->getPassword());
		$stmt->bindValue(":id_acesso", $objClass->getIdAcesso());
		$stmt->bindValue(":permissoes", $objClass->getPermissoes());
		$stmt->execute();

		return $pdo->lastInsertId();
	}	

	public function atualizar(ClsUsuario $objClass)
	{
		$pdo = Conexao::getConn();
		
		$sql = "UPDATE ".$objClass->tabela." SET ";
		$sql .= "categoria_veiculo = :categoria_veiculo";		
		$sql .= " WHERE ".$objClass->keyId." = :id_categoria_veiculo";

		$stmt = $pdo->prepare($sql);
		$stmt->bindvalue(":id_categoria_veiculo",$objClass->getId());
		$stmt->bindValue(":categoria_veiculo",$objClass->getNome());
		$stmt->execute();

		return 1;
	}

	public function definirPermissao(ClsUsuario $objClass)
	{
		$pdo = Conexao::getConn();
		
		$sql = "UPDATE ".$objClass->tabela." SET ";
		$sql .= "id_acesso = :id_acesso";		
		$sql .= " WHERE ".$objClass->keyId." = :id_usuario";

		$stmt = $pdo->prepare($sql);
		$stmt->bindvalue(":id_usuario",$objClass->getId());
		$stmt->bindValue(":id_acesso",$objClass->getIdAcesso());
		$stmt->execute();

		return 1;
	}

	public function deletar(ClsUsuario $objClass)
	{
		$pdo = Conexao::getConn();

		if (intval($objClass->getId()) == 1) {
			return 0;	
		} else {
			
			$sql = "DELETE FROM ".$objClass->tabela." WHERE ".$objClass->keyId." = :id_categoria_veiculo AND ".$objClass->keyId." > ";
		
			$stmt = $pdo->prepare($sql);
			$stmt->bindValue(":id_categoria_veiculo",$objClass->getId()); 
			$stmt->execute();
			
			return 1;			
        }
		$db->close();
	}

	public function ifExist(ClsUsuario $objClass)
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
	
	public function ifExistId(ClsUsuario $objClass)
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

	public function listar(ClsUsuario $objClass)
	{	
        $pdo = Conexao::getConn();
		
		$sql = "SELECT * FROM ".$objClass->tabela." a
			LEFT JOIN tbnivel_acesso b ON (b.id_acesso = a.id_acesso) WHERE a.id_cliente = ".$_SESSION['id_cliente']."";
		
		$stmt = $pdo->prepare($sql);
		$stmt->execute();

		$objResultado = $stmt->fetchAll(\PDO::FETCH_ASSOC);

		return $objResultado;
	}

	public function listarLiberar(ClsUsuario $objClass)
	{	
        $pdo = Conexao::getConn();
		
		$sql = "SELECT * FROM ".$objClass->tabela." a 
			LEFT JOIN tbnivel_acesso b ON (b.id_acesso = a.id_acesso) WHERE b.id_acesso = 3";
		
		$stmt = $pdo->prepare($sql);
		$stmt->execute();

		$objResultado = $stmt->fetchAll(\PDO::FETCH_ASSOC);

		return $objResultado;
	}

	// public function listar_combo(ClsUsuario $objClass){
	// 	// Cria o objeto PDO
    //     $pdo = Conexao::getConn();
		
	// 	$sql = "SELECT id, name FROM ".$objClass->tabela." WHERE id not in (1) ORDER BY name asc;";

	// 	$stmt = $pdo->prepare($sql);
	// 	$stmt->execute();

	// 	return $stmt->fetchAll(PDO::FETCH_ASSOC);
	// }

	public function count(ClsUsuario $objClass)
	{
        $pdo = Conexao::getConn();
		
		$sql = "SELECT count(*) AS Qtd FROM ".$objClass->tabela.";";

		$stmt = $pdo->prepare($sql);
		$stmt->execute();

		return $stmt->fetchColumn();
	}
}