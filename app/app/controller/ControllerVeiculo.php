<?php

namespace App\controller;

if (!isset($_SESSION)) {
	session_start();
}

use Src\classes\ClassRender;
//use Src\interfaces\InterfaceView;

# Actions
use App\Action\Aveiculo;

# Models
use App\model\ClsVeiculo;
use App\model\DaoVeiculo;

class ControllerVeiculo extends ClsVeiculo
{
	public function list()
    {   
		$breadcrumb = [
			'Início' => '',
			'Veículo' => 'veiculo/list',
			'Novo' => 'false'
		];
		
        if (isset($_SESSION['id_usuario'])) {
            $render = new ClassRender();
            $render->setTitle("Sisfuel APP - Veículo");
            $render->setDescription("veículo");
            $render->setKeyWords("sisfuel");
			$render->setDir("Veiculo");
			$render->setBreadCrumb($breadcrumb);
            $render->renderLayout();
        } else {
			die("Você não tem permissão para acessar esta página");
		}
	}

	# Retorna o main da view/Editar_veiculo
	public function editar()
	{  	
		$breadcrumb = [
			'Início' => '',
			'Veículo' => 'veiculo/list',
			'Editar' => 'false'
		];

		if(isset($_SESSION['id_usuario']))	{
			# composição
			$render = new ClassRender();
			$render->setTitle("Sisfuel App - Editar Veículo");
			$render->setDescription("Editar Veículo");
			$render->setKeyWords("sisfuel");
			# Pasta na view
			$render->setDir("Editar_veiculo");
			$render->setBreadCrumb($breadcrumb);
			$render->renderLayout();
		} else {
			die("Você não tem permissão para acessar esta página");
		}
	}

	function cadastrar(ClsVeiculo $objClass)
	{
		$objItf = new DaoVeiculo();
		return $objItf->cadastrar($objClass);		
	}
	
	function atualizar(ClsVeiculo $objClass)
	{
		$objItf = new DaoVeiculo();
		return $objItf->atualizar($objClass);
	}

	function listar(ClsVeiculo $objClass){
		$objItf = new DaoVeiculo();
		return $objItf->listar($objClass);
	}

	function listarTodos(ClsVeiculo $objClass){
		$objItf  = new DaoVeiculo();
		return $objItf->listarTodos($objClass);
	}

	function deletar(ClsVeiculo $objClass)
	{
		$objItf = new DaoVeiculo();
		return $objItf->deletar($objClass);
	}

	function buscar_id(ClsVeiculo $objClass)
	{
		$objItf = new DaoVeiculo();
		return $objItf->buscar_id($objClass);
	}

	function count(ClsVeiculo $objClass)
	{
		$objItf = new DaoVeiculo();
		return $objItf->count($objClass);
	}
	
	# Actions functions

	# Method used in view
	public function excluir($id)
	{	
		# Absctract class Aveiculo method excluirAction
		Aveiculo::excluirAction($id);
	}

	public function alterar($id)
	{	
		# Absctract class Aveiculo method alterarAction
		Aveiculo::alterarAction($id);
	}

	public function registrar()
	{	
		# Absctract class Aveiculo method novoAction
		Aveiculo::registrarAction();
	}
}