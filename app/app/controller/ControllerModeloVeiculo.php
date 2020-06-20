<?php

namespace App\Controller;

if (!isset($_SESSION)) {
	session_start();
}

use Src\classes\ClassRender;
use Src\interfaces\InterfaceView;
# Action 
use App\Action\AmodeloVeiculo;
# Model
use App\model\ClsModeloVeiculo;
use App\model\DaoModeloVeiculo;

class ControllerModeloVeiculo extends ClsModeloVeiculo
{
	public function list()
	{  
		$breadcrumb = [
			'Início' => '',
			'Modelo Veículo' => 'modelo-veiculo/list',
			'Listagem' => 'false'
		];

		if(isset($_SESSION['id_usuario']))	{
			# composição
			$render = new ClassRender();
            $render->setTitle("Sisfuel APP - Modelo do Veículo");
            $render->setDescription("Modelo do Veículo");
            $render->setKeyWords("sisfuel");
			# Pasta na view
			$render->setDir("ModeloVeiculo");
			$render->setBreadCrumb($breadcrumb);
			$render->renderLayout();
	    }  else {
			die("Você não tem permissão para acessar esta página");
		}
	}

	function cadastrar(ClsModeloVeiculo $objClass)
	{
		$objItf = new DaoModeloVeiculo();
		return $objItf->cadastrar($objClass);		
	}
	
	function atualizar(ClsModeloVeiculo $objClass)
	{
		$objItf = new DaoModeloVeiculo();
		return $objItf->atualizar($objClass);
	}

	function listar(ClsModeloVeiculo $objClass)
	{
		$objItf = new DaoModeloVeiculo();
		return $objItf->listar($objClass);
	}

	function deletar(ClsModeloVeiculo $objClass)
	{
		$objItf = new DaoModeloVeiculo();
		return $objItf->deletar($objClass);
	}

	# Method used in view
	public function excluir($id)
	{	
		# Absctract class AmanutencaoVeiculo method excluirAction
		AmodeloVeiculo::excluirAction($id);
	}
		

	public function registrar()
	{	
		# Absctract class AmodeloVeiculo method novoAction
		AmodeloVeiculo::registrarAction();
	}

}