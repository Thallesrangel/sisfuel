<?php
namespace App\controller;

if (!isset($_SESSION)) {
	session_start();
}

use Src\classes\ClassRender;
use Src\interfaces\InterfaceView;
# Action
use App\Action\AmovTransito;
# Model
use App\model\ClsMovTransito;
use App\model\DaoMovTransito;

class ControllerMovTransito extends ClsMovTransito
{
	public function list()
	{  	
		$breadcrumb = [
			'Início' => '',
			'Movimento em Trânsito' => 'movimento-transito/list',
			'Listagem' => 'false'
		];

		if (in_array(3, $_SESSION['permissoes']) OR $_SESSION['nivel'] == 2) {
			# composição
			$render = new ClassRender();
			$render->setTitle("Sisfuel App - Movimento em Trânsito");
			$render->setDescription("Abastecimento");
			$render->setKeyWords("sisfuel");
			# Pasta na view
			$render->setDir("Mov_transito");
			$render->setBreadCrumb($breadcrumb);
			$render->renderLayout();
		} else {
			die("Você não tem permissão para acessar esta página");
		}
    }

    # Retorna o main da view/Registrar_mov_transito
	public function novo()
	{  	
		$breadcrumb = [
			'Início' => 'home',
			'Movimento em Trânsito' => 'movimento-transito/list',
			'Novo' => 'false'
		];

		if (in_array(3, $_SESSION['permissoes']) OR $_SESSION['nivel'] == 2) {
			# composição
			$render = new ClassRender();
			$render->setTitle("Sisfuel App - Registrar Abastecimento");
			$render->setDescription("Registrar Abastecimento");
			$render->setKeyWords("sisfuel");
			# Pasta na view
			$render->setDir("Registrar_transito");
			$render->setBreadCrumb($breadcrumb);
			$render->renderLayout();
	    } else {
			die("Você não tem permissão para acessar esta página");
		}
	}

	# Retorna o main da view/Editar_mov_transito
	public function editar()
	{  	
		$breadcrumb = [
			'Início' => 'home',
			'Movimento em Trânsito' => 'movimento-transito/list',
			'Editar' => ''
		];

		if (in_array(3, $_SESSION['permissoes']) OR $_SESSION['nivel'] == 2) {
			# composição
			$render = new ClassRender();
			$render->setTitle("Sisfuel App - Movimento em Trânsito");
			$render->setDescription("Editar Movimento Transito");
			$render->setKeyWords("sisfuel");
			# Pasta na view
			$render->setDir("Editar_mov_transito");
			$render->setBreadCrumb($breadcrumb);
			$render->renderLayout();
		} else {
			die("Você não tem permissão para acessar esta página");
		}
	}

	function cadastrar(ClsMovTransito $objClass){
		$objItf = new DaoMovTransito();
		return $objItf->cadastrar($objClass);		
	}
	
	function atualizar(ClsMovTransito $objClass){
		$objItf = new DaoMovTransito();
		return $objItf->atualizar($objClass);
	}

	function listar(ClsMovTransito $objClass){
		$objItf = new DaoMovTransito();
		return $objItf->listar($objClass);
	}

	# Usado nos relatórios para exibir todos as saidas de combustíveis
	function listarTodos(ClsMovTransito $objClass)
	{
		$objItf = new DaoMovTransito();
		return $objItf->listarTodos($objClass);
	}

	function deletar(ClsMovTransito $objClass){
		$objItf = new DaoMovTransito();
		return $objItf->deletar($objClass);
	}

	# Actions function

	# Method used in view
	public function excluir($id)
	{	
		# Absctract class AmovTransito method excluirAction
		AmovTransito::excluirAction($id);
	}

	public function registrar()
	{	
		# Absctract class AmovTransito method novoAction
		AmovTransito::registrarAction();
	}

	public function alterar($id)
	{	
		# Absctract class AmovTransito method novoAction
		AmovTransito::alterarAction($id);
	}

}