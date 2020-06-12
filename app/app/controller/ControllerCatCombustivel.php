<?php

namespace App\Controller;

if (!isset($_SESSION)) {
	session_start();
}

use Src\classes\ClassRender;
use Src\interfaces\InterfaceView;
# Action 
use App\Action\AcategoriaCombustivel;
# Model
use App\model\ClsCatCombustivel;
use App\model\DaoCatCombustivel;

class ControllerCatCombustivel extends ClsCatCombustivel
{
	public function list()
	{  
		$breadcrumb = [
			'Início' => '',
			'Ipva' => 'categoria_combustivel/list',
			'Listagem' => ''
		];

		if(isset($_SESSION['id_usuario']))	{
			# composição
			$render = new ClassRender();
            $render->setTitle("Sisfuel APP - Categoria Combustível");
            $render->setDescription("Categoria Combustível");
            $render->setKeyWords("sisfuel");
			# Pasta na view
			$render->setDir("Categoria_combustivel");
			$render->setBreadCrumb($breadcrumb);
			$render->renderLayout();
	    }  else {
			die("Você não tem permissão para acessar esta página");
		}
	}

	function cadastrar(ClsCatCombustivel $objClass)
	{
		$objItf = new DaoCatCombustivel();
		return $objItf->cadastrar($objClass);		
	}
	
	function atualizar(ClsCatCombustivel $objClass)
	{
		$objItf = new DaoCatCombustivel();
		return $objItf->atualizar($objClass);
	}

	function listar(ClsCatCombustivel $objClass)
	{
		$objItf = new DaoCatCombustivel();
		return $objItf->listar($objClass);
	}

	function selectCombustivel(ClsCatCombustivel $objClass)
	{
		$objItf = new DaoCatCombustivel();
		return $objItf->selectCombustivel($objClass);
	}

	function deletar(ClsCatCombustivel $objClass)
	{
		$objItf = new DaoCatCombustivel();
		return $objItf->deletar($objClass);
	}

	
	function buscar_id(ClsCatCombustivel $objClass)
	{
		$objItf = new DaoCatCombustivel();
		return $objItf->buscar_id($objClass);
	}

	function count(ClsCatCombustivel $objClass)
	{
		$objItf = new DaoCatCombustivel();
		return $objItf->count($objClass);
	}
}