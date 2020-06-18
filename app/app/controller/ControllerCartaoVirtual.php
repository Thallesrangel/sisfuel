<?php

namespace App\controller;

if (!isset($_SESSION)) {
	session_start();
}

use Src\classes\ClassRender;
use Src\interfaces\InterfaceView;
# Action
use App\Action\AcartaoVirtual;
# Model
use App\model\ClsCartaoVirtual;
use App\model\DaoCartaoVirtual;

class ControllerCartaoVirtual extends ClsCartaoVirtual
{
    # Retorna o main da view/abastecimento
	public function list()
	{  	
		$breadcrumb = [
			'Início' => '',
			'Cartão Virtual' => 'cartao-virtual/list',
			'Listagem' => 'false'
		];

		if (in_array(6, $_SESSION['permissoes']) OR $_SESSION['nivel'] == 2) {
			# composição
			$render = new ClassRender();
			$render->setTitle("Sisfuel App - Cartão Virtual");
			$render->setDescription("Cartão Virtual");
			$render->setKeyWords("sisfuel");
			# Pasta na view
			$render->setDir("Cartao_virtual");
			$render->setBreadCrumb($breadcrumb);
			$render->renderLayout();
	    }
    }


	# Retorna o main da view/registrar_cartao_virtual
	public function novo()
	{  
		$breadcrumb = [
			'Início' => '',
			'Cartão Virtual' => 'cartao-virtual/list',
			'Novo' => 'false'
		];

		if (in_array(6, $_SESSION['permissoes']) OR $_SESSION['nivel'] == 2) {
			# composição
			$render = new ClassRender();
			$render->setTitle("Sisfuel App - Registrar Cartão Virtual");
			$render->setDescription("Cartão Virtual");
			$render->setKeyWords("sisfuel");
			# Pasta na view
			$render->setDir("Registrar_cartao_virtual");
			$render->setBreadCrumb($breadcrumb);
			$render->renderLayout();
		}
	}

	# Retorna o main da view/Cartao_virtual_acesso_externo - PARA ACESSO EXTERNO DOS MOTORISTAS
	public function externo()
	{  
		if (isset($_SESSION['id_usuario'])) {
			# composição
			$render = new ClassRender();
			$render->setTitle("Sisfuel App - Cartão Virtual | Acesso Externo");
			$render->setDescription("Cartão Virtual Acesso Externo");
			$render->setKeyWords("sisfuel");
			# Pasta na view
			$render->setDir("Cartao_virtual_acesso_externo");
			$render->renderLayout();
		}
	}

	# Retorna o main da view/Cartao_virtual_registro_externo - PARA REGISTRAR MOV EXTERNO DE COMBUSTÍVEL DOS MOTORISTAS
	public function registro_externo()
	{  
		# composição
		$render = new ClassRender();
		$render->setTitle("Sisfuel App - Cartão Virtual | Acesso Externo");
		$render->setDescription("Cartão Virtual Acesso Externo");
		$render->setKeyWords("sisfuel");
		# Pasta na view
		$render->setDir("Cartao_virtual_registro_externo");
		$render->renderLayout();
		
	}

    # Controlador padrão -- métodos

	function cadastrar(ClsCartaoVirtual $objClass)
	{
		$objItf = new DaoCartaoVirtual();
		return $objItf->cadastrar($objClass);		
	}
	
	function atualizar(ClsCartaoVirtual $objClass)
	{
		$objItf = new DaoCartaoVirtual();
		return $objItf->atualizar($objClass);
	}

	function listar(ClsCartaoVirtual $objClass)
	{
		$objItf = new DaoCartaoVirtual();
		return $objItf->listar($objClass);
	}

	function listarTodos(ClsCartaoVirtual $objClass)
	{
		$objItf = new DaoCartaoVirtual();
		return $objItf->listarTodos($objClass);
	}

	function deletar(ClsCartaoVirtual $objClass)
	{
		$objItf = new DaoCartaoVirtual();
		return $objItf->deletar($objClass);
	}

	function buscar_id(ClsCartaoVirtual $objClass)
	{
		$objItf = new DaoCartaoVirtual();
		return $objItf->buscar_id($objClass);
	}
	
	function count(ClsCartaoVirtual $objClass)
	{
		$objItf = new DaoCartaoVirtual();
		return $objItf->count($objClass);
	}

	# Actions functions

	# Method used in view
	public function excluir($id)
	{	
		# Absctract class AcartaoVirtual method excluirAction
		AcartaoVirtual::excluirAction($id);
	}
	
	public function registrar()
	{	
		# Absctract class AcartaoVirtual method registrarAction
		AcartaoVirtual::registrarAction();
    }
    
	public function alterar($id)
	{	
		# Absctract class AcartaoVirtual method AlterarAction
		AcartaoVirtual::alterarAction($id);
	}
}