<?php

namespace App\controller;

if (!isset($_SESSION)) {
	session_start();
}

use Src\classes\ClassRender;
use Src\interfaces\InterfaceView;

# Actions
use App\Action\Amotorista;

# Models
use App\model\ClsMotorista;
use App\model\DaoMotorista;

class ControllerMotorista extends ClsMotorista
{	
	# Retorna o main da view/Motorista
	public function list()
    {   
		$breadcrumb = [
			'Início' => '',
			'Motorista' => 'motorista/list',
			'Listagem' => 'false'
		];

        if (isset($_SESSION['id_usuario'])) {
            $render = new ClassRender();
            $render->setTitle("Sisfuel APP - Motoristas");
            $render->setDescription("motorista");
            $render->setKeyWords("sisfuel");
			$render->setDir("Motorista");
			$render->setBreadCrumb($breadcrumb);
            $render->renderLayout();
        }  else {
			die("Você não tem permissão para acessar esta página");
		}
	}

	# Retorna o main da view/Editar_motorista
	public function editar()
	{  	
		$breadcrumb = [
			'Início' => '',
			'Motorista' => 'motorista/',
			'Editar' => ''
		];

		if (isset($_SESSION['id_usuario']))	{
			# composição
			$render = new ClassRender();
			$render->setTitle("Sisfuel App - Editar motorista");
			$render->setDescription("Editar motorista");
			$render->setKeyWords("sisfuel");
			# Pasta na view
			$render->setDir("Editar_motorista");
			$render->setBreadCrumb($breadcrumb);
			$render->renderLayout();
		}  else {
			die("Você não tem permissão para acessar esta página");
		}
	}

	# Controlador padrão

	function cadastrar(ClsMotorista $objClass)
	{
		$objItf = new DaoMotorista();
		return $objItf->cadastrar($objClass);		
	}
	
	function atualizar(ClsMotorista $objClass)
	{
		$objItf = new DaoMotorista();
		return $objItf->atualizar($objClass);
	}

	function listar(ClsMotorista $objClass)
	{
		$objItf = new DaoMotorista();
		return $objItf->listar($objClass);
	}

	function deletar(ClsMotorista $objClass)
	{
		$objItf = new DaoMotorista();
		return $objItf->deletar($objClass);
	}

	
	function buscar_id(ClsMotorista $objClass)
	{
		$objItf = new DaoMotorista();
		return $objItf->buscar_id($objClass);
	}

	function count(ClsMotorista $objClass)
	{
		$objItf = new DaoMotorista();
		return $objItf->count($objClass);
	}



	# Actions functions

	# Method used in view
	public function excluir($id)
	{	
		# Absctract class Amotorista method excluirAction
		Amotorista::excluirAction($id);
	}

	public function novo()
	{	
		# Absctract class Amotorista method novoAction
		Amotorista::novoAction();
	}

	public function alterar($id)
	{	
		# Absctract class Amotorista method AlterarAction
		Amotorista::alterarAction($id);
	}
}