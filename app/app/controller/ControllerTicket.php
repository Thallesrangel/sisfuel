<?php

namespace App\Controller;

if (!isset($_SESSION)) {
	session_start();
}

use Src\classes\ClassRender;
use Src\interfaces\InterfaceView;
#Action
use App\Action\AticketCombustivel;
# Model
use App\model\ClsTicket;
use App\model\DaoTicket;

class ControllerTicket extends ClsTicket
{
	# Retorna o main da view/Ticket
	public function list()
    {   
		$breadcrumb = [
			'Início' => '',
			'Ticket' => 'ticket/list',
			'Listagem' => 'false'
		];

        if (in_array(5, $_SESSION['permissoes']) OR $_SESSION['nivel'] == 2) {
			# Composição
            $render = new ClassRender();
            $render->setTitle("Sisfuel APP - Ticket");
            $render->setDescription("ticket");
			$render->setKeyWords("sisfuel");
			# Pasta na View
			$render->setDir("Ticket");
			$render->setBreadCrumb($breadcrumb);
            $render->renderLayout();
        } else {
			die("Você não tem permissão para acessar esta página");
		}
	}
	
	# Retorna o main da View/Registrar_ticket
	public function novo()
	{  
		$breadcrumb = [
			'Início' => '',
			'Ticket ' => 'ticket/list',
			'Novo' => 'false'
		];
		
		if (in_array(5, $_SESSION['permissoes']) OR $_SESSION['nivel'] == 2) {
			# Composição
			$render = new ClassRender();
			$render->setTitle("Sisfuel App - Novo ticket");
			$render->setDescription("Novo ticket");
			$render->setKeyWords("sisfuel");
			# Pasta na view
			$render->setDir("Registrar_ticket");
			$render->setBreadCrumb($breadcrumb);
			$render->renderLayout();
		} else {
			die("Você não tem permissão para acessar esta página");
		}
	}

	# Retorna o main da View/Registrar_ticket
	public function editar()
	{  	
		$breadcrumb = [
			'Início' => 'home',
			'Ticket' => 'ticket/index',
			'Editar' => ''
		];

		if (in_array(5, $_SESSION['permissoes']) OR $_SESSION['nivel'] == 2) {
			# Composição
			$render = new ClassRender();
			$render->setTitle("Sisfuel App - Editar ticket");
			$render->setDescription("Editar ticket");
			$render->setKeyWords("sisfuel");
			# Pasta na view
			$render->setDir("Editar_ticket");
			$render->setBreadCrumb($breadcrumb);
			$render->renderLayout();
		} else {
			die("Você não tem permissão para acessar esta página");
		}
	}

	function cadastrar(ClsTicket $objClass)
	{
		$objItf = new DaoTicket();
		return $objItf->cadastrar($objClass);		
	}
	
	function atualizar(ClsTicket $objClass)
	{
		$objItf = new DaoTicket();
		return $objItf->atualizar($objClass);
	}

	function listar(ClsTicket $objClass)
	{
		$objItf = new DaoTicket();
		return $objItf->listar($objClass);
	}

	function listarTodos(ClsTicket $objClass)
	{
		$objItf = new DaoTicket();
		return $objItf->listarTodos($objClass);
	}

	function deletar(ClsTicket $objClass)
	{
		$objItf = new DaoTicket();
		return $objItf->deletar($objClass);
	}
	
	function buscar_id(ClsTicket $objClass)
	{
		$objItf = new DaoTicket();
		return $objItf->buscar_id($objClass);
	}

	function count(ClsTicket $objClass)
	{
		$objItf = new DaoTicket();
		return $objItf->count($objClass);
	}


	# Actions function

	# Method used in view
	public function excluir($id)
	{	
		# Absctract class AticketCombustivel method excluirAction
		AticketCombustivel::excluirAction($id);
	}

	public function registrar()
	{	
		# Absctract class AticketCombustivel method novoAction
		AticketCombustivel::registrarAction();
	}

}