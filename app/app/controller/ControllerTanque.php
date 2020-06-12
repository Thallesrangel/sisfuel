<?php

namespace App\controller;

if (!isset($_SESSION)) {
	session_start();
}

use Src\classes\ClassRender;
use Src\interfaces\InterfaceView;

# Actions
use App\Action\Atanque;

# Models
use App\model\ClsTanque;
use App\model\DaoTanque;

class ControllerTanque extends ClsTanque{
	
	public function list()
    {   
		$breadcrumb = [
			'Início' => '',
			'Tanque' => 'tanque/list',
			'Novo' => ''
		];

        if (isset($_SESSION['id_usuario'])) {
            $render = new ClassRender();
            $render->setTitle("Sisfuel APP - Tanque");
            $render->setDescription("tanque");
            $render->setKeyWords("sisfuel");
			$render->setDir("Tanque");
			$render->setBreadCrumb($breadcrumb);
            $render->renderLayout();
        } else {
			die("Você não tem permissão para acessar esta página");
		}
	}

	function cadastrar(ClsTanque $objClass)
	{
		$objItf = new DaoTanque();
		return $objItf->cadastrar($objClass);		
	}
	
	# Retorna a capacidade do tanque definido por parametro
	function capacidadeCombustivelPorTanque(ClsTanque $objClass)
	{
		$objItf = new DaoTanque();
		return $objItf->capacidadeCombustivelPorTanque($objClass);		
	}
	
	function atualizar(ClsTanque $objClass)
	{
		$objItf = new DaoTanque();
		return $objItf->atualizar($objClass);
	}

	function listar(ClsTanque $objClass)
	{
		$objItf = new DaoTanque();
		return $objItf->listar($objClass);
	}

	function listarTodos(ClsTanque $objClass)
	{
		$objItf = new DaoTanque();
		return $objItf->listarTodos($objClass);
	}

	function deletar(ClsTanque $objClass)
	{
		$objItf = new DaoTanque();
		return $objItf->deletar($objClass);
	}

	function buscar_id(ClsTanque $objClass)
	{
		$objItf = new DaoTanque();
		return $objItf->buscar_id($objClass);
	}


	function count(ClsTanque $objClass)
	{
		$objItf = new DaoTanque();
		return $objItf->count($objClass);
	}
	
	
	# Acões acessadas da view que executam um metodo do controlador que chama uma action (regra) dentro da pasta Action

	# Actions acessadas pela view ----------------------------------------------------------------------------------------
	
	public function excluir($request)
	{
		$retorno = Atanque::excluirAction($request);
	}

	public function novo($request)
	{
		$retorno = Atanque::novoAction($request);
	}

	// public function alterar(){
	// 	$retorno = Atanque::alterarAction();
	// 	if ($retorno) {
	// 		header("Location: ".$_SERVER['HTTP_REFERER']."");
	// 	} else {
	// 		die('ocorreu um erro ao alterar registro do tanque');
	// 	}
	// }
}