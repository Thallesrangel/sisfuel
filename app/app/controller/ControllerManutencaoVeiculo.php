<?php

namespace App\controller;

if (!isset($_SESSION)) {
	session_start();
}

use Src\classes\ClassRender;
use Src\interfaces\InterfaceView;

# Actions
use App\Action\AmanutencaoVeiculo;

# Models
use App\model\ClsManutencaoVeiculo;
use App\model\DaoManutencaoVeiculo;

class ControllerManutencaoVeiculo extends ClsManutencaoVeiculo
{	
	# Retorna o main da view/Motorista
	public function list()
    {   
		$breadcrumb = [
			'Início' => '',
			'Manutenção' => 'manutencao/list',
			'Listagem' => ''
		];

     	if (in_array(9, $_SESSION['permissoes']) OR $_SESSION['nivel'] == 2) {
            $render = new ClassRender();
            $render->setTitle("Sisfuel APP - Controle de Manutenção");
            $render->setDescription("Manuteção");
            $render->setKeyWords("sisfuel");
			$render->setDir("Manutencao_veiculo");
			$render->setBreadCrumb($breadcrumb);
            $render->renderLayout();
        }
	}

    # Retorna o main da view/registrar_manutencao_veiculo
	public function novo()
	{  
		$breadcrumb = [
			'Início' => '',
			'Manutenção' => 'manutencao/',
			'Novo' => ''
		];

		if (in_array(9, $_SESSION['permissoes']) OR $_SESSION['nivel'] == 2) {
			# composição
			$render = new ClassRender();
			$render->setTitle("Sisfuel App - Registrar Manutenção");
			$render->setDescription("Manutenção Veículo");
			$render->setKeyWords("sisfuel");
			# Pasta na view
			$render->setDir("Registrar_manutencao_veiculo");
			$render->setBreadCrumb($breadcrumb);
			$render->renderLayout();
	    }
	}

	# Retorna o main da view/Editar_motorista
	public function editar()
	{  	
		$breadcrumb = [
			'Início' => 'home',
			'Motorista' => 'manutencao/editar',
			'Editar' => ''
		];

		if (in_array(9, $_SESSION['permissoes']) OR $_SESSION['nivel'] == 2) {
			# composição
			$render = new ClassRender();
			$render->setTitle("Sisfuel App - Editar Manutenção");
			$render->setDescription("Editar manutenção veículo");
			$render->setKeyWords("sisfuel");
			# Pasta na view
			$render->setDir("Editar_manutencao_veiculo");
			$render->setBreadCrumb($breadcrumb);
			$render->renderLayout();
		}
	}

	# Controlador padrão

	function cadastrar(ClsManutencaoVeiculo $objClass)
	{
		$objItf = new DaoManutencaoVeiculo();
		return $objItf->cadastrar($objClass);		
	}
	
	function atualizar(ClsManutencaoVeiculo $objClass)
	{
		$objItf = new DaoManutencaoVeiculo();
		return $objItf->atualizar($objClass);
	}

	function listar(ClsManutencaoVeiculo $objClass)
	{
		$objItf = new DaoManutencaoVeiculo();
		return $objItf->listar($objClass);
	}

	function listarTodos(ClsManutencaoVeiculo $objClass)
	{
		$objItf = new DaoManutencaoVeiculo();
		return $objItf->listarTodos($objClass);
	}

	function deletar(ClsManutencaoVeiculo $objClass)
	{
		$objItf = new DaoManutencaoVeiculo();
		return $objItf->deletar($objClass);
	}

	
	function buscar_id(ClsManutencaoVeiculo $objClass)
	{
		$objItf = new DaoManutencaoVeiculo();
		return $objItf->buscar_id($objClass);
	}

	function count(ClsManutencaoVeiculo $objClass)
	{
		$objItf = new ClsManutencaoVeiculo();
		return $objItf->count($objClass);
	}



	# Actions functions

	# Method used in view
	public function excluir($id)
	{	
		# Absctract class AmanutencaoVeiculo method excluirAction
		AmanutencaoVeiculo::excluirAction($id);
	}
	
	public function registrar()
	{	
		# Absctract class AmanutencaoVeiculo method registrarAction
		AmanutencaoVeiculo::registrarAction();
    }
    
	public function alterar($id)
	{	
		# Absctract class AmanutencaoVeiculo method AlterarAction
		AmanutencaoVeiculo::alterarAction($id);
	}
}