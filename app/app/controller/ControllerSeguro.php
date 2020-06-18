<?php

namespace App\controller;

if (!isset($_SESSION)) {
	session_start();
}

use Src\classes\ClassRender;
use Src\interfaces\InterfaceView;
# Action
use App\Action\Aseguro;
# Model
use App\model\ClsSeguro;
use App\model\DaoSeguro;

class ControllerSeguro extends ClsSeguro{
   
    # Retorna o main da view/Seguro
	public function list()
	{  	
		$breadcrumb = [
			'Início' => '',
			'Seguro' => 'seguro/list',
			'Listagem' => 'false'
		];

		if (in_array(7, $_SESSION['permissoes']) OR $_SESSION['nivel'] == 2) {
			# composição
			$render = new ClassRender();
			$render->setTitle("Sisfuel App - Seguros");
			$render->setDescription("Seguros");
			$render->setKeyWords("sisfuel");
			# Pasta na view
			$render->setDir("Seguro");
			$render->setBreadCrumb($breadcrumb);
			$render->renderLayout();
	    }  else {
			die("Você não tem permissão para acessar esta página");
		}
    }

    # Retorna o main da view/Registrar_seguro
	public function novo()
	{  
		$breadcrumb = [
			'Início' => '',
			'Seguro' => 'seguro/list',
			'Novo' => 'false'
		];

		if (in_array(7, $_SESSION['permissoes']) OR $_SESSION['nivel'] == 2) {
			# composição
			$render = new ClassRender();
			$render->setTitle("Sisfuel App - Registrar Seguro");
			$render->setDescription("Registrar Seguro");
			$render->setKeyWords("sisfuel");
			# Pasta na view
			$render->setDir("Registrar_seguro");
			$render->setBreadCrumb($breadcrumb);
			$render->renderLayout();
	    } else {
			die("Você não tem permissão para acessar esta página");
		}
	}

	# Retorna o main da view/Editar_seguro
	public function editar()
	{  	
		$breadcrumb = [
			'Início' => '',
			'Seguro' => 'seguro/',
			'Editar' => ''
		];
		
		if (in_array(7, $_SESSION['permissoes']) OR $_SESSION['nivel'] == 2) {
			# composição
			$render = new ClassRender();
			$render->setTitle("Sisfuel App - Editar Seguro");
			$render->setDescription("Editar Seguro");
			$render->setKeyWords("sisfuel");
			# Pasta na view
			$render->setDir("Editar_seguro");
			$render->setBreadCrumb($breadcrumb);
			$render->renderLayout();
		} else {
			die("Você não tem permissão para acessar esta página");
		}
	}

	function cadastrar(ClsSeguro $objClass)
	{
		$objItf = new DaoSeguro();
		return $objItf->cadastrar($objClass);		
	}
	
	function atualizar(ClsSeguro $objClass)
	{
		$objItf = new DaoSeguro();
		return $objItf->atualizar($objClass);
	}

	function listar(ClsSeguro $objClass)
	{
		$objItf = new DaoSeguro();
		return $objItf->listar($objClass);
	}

	function listarTodos(ClsSeguro $objClass)
	{
		$objItf = new DaoSeguro();
		return $objItf->listarTodos($objClass);
	}

	function deletar(ClsSeguro $objClass)
	{
		$objItf = new DaoSeguro();
		return $objItf->deletar($objClass);
	}

	
	function buscar_id(ClsSeguro $objClass)
	{
		$objItf = new DaoSeguro();
		return $objItf->buscar_id($objClass);
	}

	function count(ClsSeguro $objClass)
	{
		$objItf = new DaoSeguro();
		return $objItf->count($objClass);
	}


	# Actions function

	# Method used in view
	public function excluir($id)
	{	
		# Absctract class Aseguro method excluirAction
		Aseguro::excluirAction($id);
	}

	public function registrar()
	{	
		# Absctract class Aseguro method novoAction
		Aseguro::registrarAction();
	}

	public function alterar($id)
	{	
		# Absctract class Aseguro method novoAction
		Aseguro::alterarAction($id);
	}

}