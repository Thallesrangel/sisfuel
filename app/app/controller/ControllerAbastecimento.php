<?php
namespace App\controller;

if (!isset($_SESSION)) {
	session_start();
}

use Src\classes\ClassRender;
use Src\interfaces\InterfaceView;
# Action
use App\Action\Aabastecimento;
# Model
use App\model\ClsAbastecimento;
use App\model\DaoAbastecimento;

class ControllerAbastecimento extends ClsAbastecimento{
   
    # Retorna o main da view/abastecimento
	public function list()
	{  	
		$breadcrumb = [
			'Início' => '',
			'Abastecimento' => 'abastecimento/list',
			'Listagem' => 'false'
		];

		if (in_array(3, $_SESSION['permissoes']) OR $_SESSION['nivel'] == 2) {
			# composição
			$render = new ClassRender();
			$render->setTitle("Sisfuel App - Abastecimento");
			$render->setDescription("Abastecimento");
			$render->setKeyWords("sisfuel");
			# Pasta na view
			$render->setDir("Abastecimento");
			$render->setBreadCrumb($breadcrumb);
			$render->renderLayout();
		} else {
			die("Você não tem permissão para acessar esta página");
		}
    }

    # Retorna o main da view/registrar_abastecimento
	public function novo()
	{  	
		$breadcrumb = [
			'Início' => 'home',
			'Abastecimento' => 'abastecimento/list',
			'Novo' => 'false'
		];

		if (in_array(3, $_SESSION['permissoes']) OR $_SESSION['nivel'] == 2) {
			# composição
			$render = new ClassRender();
			$render->setTitle("Sisfuel App - Registrar Abastecimento");
			$render->setDescription("Registrar Abastecimento");
			$render->setKeyWords("sisfuel");
			# Pasta na view
			$render->setDir("Registrar_abastecimento");
			$render->setBreadCrumb($breadcrumb);
			$render->renderLayout();
	    } else {
			die("Você não tem permissão para acessar esta página");
		}
	}

	# Retorna o main da view/Editar_abastecimento
	public function editar()
	{  	
		$breadcrumb = [
			'Início' => 'home',
			'Abastecimento' => 'movimento_saida/list',
			'Editar' => 'false'
		];

		if (in_array(3, $_SESSION['permissoes']) OR $_SESSION['nivel'] == 2) {
			# composição
			$render = new ClassRender();
			$render->setTitle("Sisfuel App - Editar Abastecimento");
			$render->setDescription("Editar Abastecimento");
			$render->setKeyWords("sisfuel");
			# Pasta na view
			$render->setDir("Editar_abastecimento");
			$render->setBreadCrumb($breadcrumb);
			$render->renderLayout();
		} else {
			die("Você não tem permissão para acessar esta página");
		}
	}

	function cadastrar(ClsAbastecimento $objClass){
		$objItf = new DaoAbastecimento();
		return $objItf->cadastrar($objClass);		
	}
	
	function atualizar(ClsAbastecimento $objClass){
		$objItf = new DaoAbastecimento();
		return $objItf->atualizar($objClass);
	}

	function listar(ClsAbastecimento $objClass){
		$objItf = new DaoAbastecimento();
		return $objItf->listar($objClass);
	}

	function listarTodos(ClsAbastecimento $objClass){
		$objItf = new DaoAbastecimento();
		return $objItf->listarTodos($objClass);
	}

	function selectCombustivel(ClsAbastecimento $objClass){
		$objItf = new DaoAbastecimento();
		return $objItf->selectCombustivel($objClass);
	}

	function deletar(ClsAbastecimento $objClass){
		$objItf = new DaoAbastecimento();
		return $objItf->deletar($objClass);
	}

	function buscar_id(ClsAbastecimento $objClass){
		$objItf = new DaoAbastecimento();
		return $objItf->buscar_id($objClass);
	}

	function count(ClsAbastecimento $objClass)
	{
		$objItf = new DaoAbastecimento();
		return $objItf->count($objClass);
	}

	# Actions function

	# Method used in view
	public function excluir($id)
	{	
		# Absctract class AmovEntrada method excluirAction
		Aabastecimento::excluirAction($id);
	}

	public function registrar()
	{	
		# Absctract class AmovEntrada method novoAction
		Aabastecimento::registrarAction();
	}

	public function alterar($id)
	{	
		# Absctract class Aabastecimento method novoAction
		Aabastecimento::alterarAction($id);
	}

}