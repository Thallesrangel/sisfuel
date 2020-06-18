<?php
namespace App\Controller;

if (!isset($_SESSION)) {
	session_start();
}

use Src\classes\ClassRender;
use Src\interfaces\InterfaceView;
# Action
use App\Action\AmovEntrada;

# Model
use App\model\ClsMovEntrada;
use App\model\DaoMovEntrada;

class ControllerMovEntrada extends ClsMovEntrada{
	
	# Retorna o main da view/mov_entrada
	public function list()
	{  	
		$breadcrumb = [
			'Início' => '',
			'Movimento de Entrada' => 'movimento_entrada/list',
			'Listagem' => 'false'
		];

		if (in_array(1, $_SESSION['permissoes']) OR $_SESSION['nivel'] == 2) {
			# composição
			$render = new ClassRender();
			$render->setTitle("Sisfuel App - Entrada de combustível");
			$render->setDescription("Entrada combustível");
			$render->setKeyWords("sisfuel");
			# Pasta na view
			$render->setDir("Mov_entrada");
			$render->setBreadCrumb($breadcrumb);
			$render->renderLayout();
	    } else {
			die("Você não tem permissão para acessar esta página");
		}
	}
	
	# Retorna o main da view/registrar_entrada
	public function novo()
	{  
		$breadcrumb = [
			'Início' => '',
			'Movimento de Entrada' => 'movimento_entrada/',
			'Novo' => ''
		];

		if (in_array(1, $_SESSION['permissoes']) OR $_SESSION['nivel'] == 2) {
			# composição
			$render = new ClassRender();
			$render->setTitle("Sisfuel App - Registrar Entrada de combustível");
			$render->setDescription("Entrada combustível");
			$render->setKeyWords("sisfuel");
			# Pasta na view
			$render->setDir("Registrar_entrada");
			$render->setBreadCrumb($breadcrumb);
			$render->renderLayout();
	    } else {
			die("Você não tem permissão para acessar esta página");
		}
	}

	# Retorna o main da view/Editar_motorista
	public function editar()
	{  	
		$breadcrumb = [
			'Início' => '',
			'Movimento de Entrada' => 'motorista/',
			'Editar' => ''
		];

		if (in_array(1, $_SESSION['permissoes']) OR $_SESSION['nivel'] == 2) {
			# composição
			$render = new ClassRender();
			$render->setTitle("Sisfuel App - Editar Movimento de Entrada");
			$render->setDescription("Editar movimento de entrada");
			$render->setKeyWords("movim");
			# Pasta na view
			$render->setDir("Editar_mov_entrada");
			$render->setBreadCrumb($breadcrumb);
			$render->renderLayout();
		} else {
			die("Você não tem permissão para acessar esta página");
		}
	}

	function cadastrar(ClsMovEntrada $objClass)
	{
		$objItf = new DaoMovEntrada();
		return $objItf->cadastrar($objClass);		
	}
	
	function atualizar(ClsMovEntrada $objClass)
	{
		$objItf = new DaoMovEntrada();
		return $objItf->atualizar($objClass);
	}

	function listar(ClsMovEntrada $objClass)
	{
		$objItf = new DaoMovEntrada();
		return $objItf->listar($objClass);
	}

	function listarTodos(ClsMovEntrada $objClass)
	{
		$objItf = new DaoMovEntrada();
		return $objItf->listarTodos($objClass);
	}

	# Retornar a quantidade de total (SOMA) de combustivel de determinado tanque
	function quantidadeTotalEntrada(ClsMovEntrada $objClass)
	{
		$objItf = new DaoMovEntrada();
		return $objItf->quantidadeTotalEntrada($objClass);
	}

	function deletar(ClsMovEntrada $objClass)
	{
		$objItf = new DaoMovEntrada();
		return $objItf->deletar($objClass);
	}

	
	function buscar_id(ClsMovEntrada $objClass)
	{
		$objItf = new DaoMovEntrada();
		return $objItf->buscar_id($objClass);
	}

	function count(ClsMovEntrada $objClass)
	{
		$objItf = new DaoMovEntrada();
		return $objItf->count($objClass);
	}


	# Actions function

	# Method used in view
	public function excluir($id)
	{	
		# Absctract class AmovEntrada method excluirAction
		AmovEntrada::excluirAction($id);
	}

	public function registrar()
	{	
		# Absctract class AmovEntrada method novoAction
		AmovEntrada::registrarAction();
	}

	public function alterar($id)
	{	# Abstract class AmovEntrada method alterar
		AmovEntrada::alterarAction($id);
	}
}