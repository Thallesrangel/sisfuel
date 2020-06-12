<?php

namespace App\controller;

if (!isset($_SESSION)) {
	session_start();
}

use Src\classes\ClassRender;
use Src\interfaces\InterfaceView;

# Actions
use App\Action\Aipva;

# Models
use App\model\ClsIpva;
use App\model\DaoIpva;

class ControllerIpva extends ClsIpva
{
	public function list()
    {   
		$breadcrumb = [
			'Início' => '',
			'Ipva' => 'ipva/list',
			'Listagem' => 'ipva/list'
		];

        if (in_array(8, $_SESSION['permissoes']) OR $_SESSION['nivel'] == 2) {
            $render = new ClassRender();
            $render->setTitle("Sisfuel APP - IPVA");
            $render->setDescription("IPVA");
            $render->setKeyWords("sisfuel");
			$render->setDir("Ipva");
			$render->setBreadCrumb($breadcrumb);
            $render->renderLayout();
        }
	}

	# Retorna o main da view/registrar_ipva
	public function novo()
	{  
		$breadcrumb = [
			'Início' => 'home',
			'IPVA' => 'ipva/',
			'Novo' => ''
		];

		if (in_array(8, $_SESSION['permissoes']) OR $_SESSION['nivel'] == 2) {
			# composição
			$render = new ClassRender();
			$render->setTitle("Sisfuel App - Registrar IPVA");
			$render->setDescription("IPVA");
			$render->setKeyWords("sisfuel");
			# Pasta na view
			$render->setDir("Registrar_ipva");
			$render->setBreadCrumb($breadcrumb);
			$render->renderLayout();
		}
	}
	

	function cadastrar(ClsIpva $objClass)
	{
		$objItf = new DaoIpva();
		return $objItf->cadastrar($objClass);		
	}
	
	function atualizar(ClsIpva $objClass)
	{
		$objItf = new DaoIpva();
		return $objItf->atualizar($objClass);
	}

	function listar(ClsIpva $objClass)
	{
		$objItf = new DaoIpva();
		return $objItf->listar($objClass);
	}

	function listarTodos(ClsIpva $objClass)
	{
		$objItf = new DaoIpva();
		return $objItf->listarTodos($objClass);
	}

	function deletar(ClsIPva $objClass)
	{
		$objItf = new DaoIpva();
		return $objItf->deletar($objClass);
	}

	function buscar_id(ClsIpva $objClass)
	{
		$objItf = new DaoIpva();
		return $objItf->buscar_id($objClass);
	}

	function count(ClsIpva $objClass)
	{
		$objItf = new DaoIpva();
		return $objItf->count($objClass);
	}

	
	# Actions functions

	# Method used in view
	public function excluir($id)
	{	
		# Absctract class Aipva method excluirAction
		Aipva::excluirAction($id);
	}

	public function registrar()
	{	
		# Absctract class Aipva method novoAction
		Aipva::registrarAction();
	}
}