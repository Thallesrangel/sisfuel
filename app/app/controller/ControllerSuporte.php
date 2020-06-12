<?php
namespace App\Controller;

if (!isset($_SESSION)) {
	session_start();
}

use Src\classes\ClassRender;
use Src\interfaces\InterfaceView;
# Action
use App\Action\Asuporte;
# Model
use App\model\ClsSuporte;
use App\model\DaoSuporte;


class ControllerSuporte extends ClsSuporte{
	
	# Retorna o main da view/mov_entrada
	public function list()
	{  	
		$breadcrumb = [
			'Início' => '',
			'Suporte' => 'suporte/list',
			'Listagem' => ''
		];

		if (isset($_SESSION['id_usuario'])) {
			# composição
			$render = new ClassRender();
			$render->setTitle("Sisfuel App - Lista de Suporte");
			$render->setDescription("Lista de Suporte");
			$render->setKeyWords("sisfuel");
			# Pasta na view
			$render->setDir("Suporte");
			$render->setBreadCrumb($breadcrumb);
			$render->renderLayout();
	    } else {
			die("Você não tem permissão para acessar esta página");
		}
	}

	# Retorna o main da view/registrar_entrada
	public function novo()
	{  
		$breadcrumb = [
			'Início' => '',
			'Suporte' => 'suporte/',
			'Novo' => ''
		];

		if(isset($_SESSION['id_usuario']))	{
			# composição
			$render = new ClassRender();
			$render->setTitle("Sisfuel App - Registrar Suporte");
			$render->setDescription("Registrar Suporte");
			$render->setKeyWords("sisfuel");
			# Pasta na view
			$render->setDir("Registrar_suporte");
			$render->setBreadCrumb($breadcrumb);
			$render->renderLayout();
		} else {
			die("Você não tem permissão para acessar esta página");
		}
	}

	function cadastrar(ClsSuporte $objClass)
	{
		$objItf = new DaoSuporte();
		return $objItf->cadastrar($objClass);		
	}
	
	function atualizar(ClsSuporte $objClass)
	{
		$objItf = new DaoSuporte();
		return $objItf->atualizar($objClass);
	}

	function listar(ClsSuporte $objClass)
	{
		$objItf = new DaoSuporte();
		return $objItf->listar($objClass);
	}

	function deletar(ClsSuporte $objClass)
	{
		$objItf = new DaoSuporte();
		return $objItf->deletar($objClass);
	}

	
	function buscar_id(ClsSuporte $objClass)
	{
		$objItf = new DaoSuporte();
		return $objItf->buscar_id($objClass);
	}
	

	function count(ClsSuporte $objClass)
	{
		$objItf = new DaoSuporte();
		return $objItf->count($objClass);
	}

	# Actions function

	# Method used in view
	public function excluir($id)
	{	
		# Absctract class Asuporte method excluirAction
		Asuporte::excluirAction($id);
	}

	public function registrar()
	{	
		# Absctract class Asuporte method novoAction
		Asuporte::registrarAction();
	}

}