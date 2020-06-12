<?php
namespace App\Controller;

if (!isset($_SESSION)) {
	session_start();
}

use Src\classes\ClassRender;
use Src\interfaces\InterfaceView;
# Action
use App\Action\AmovSaida;

# Model
use App\model\ClsMovSaida;
use App\model\DaoMovSaida;


class ControllerMovSaida extends ClsMovSaida{
	

	# Retorna o main da view/mov_saida
	public function list()
	{  	
		$breadcrumb = [
			'Início' => '',
			'Movimento de Saída' => 'movimento_saida/list',
			'Listagem' => ''
		];

		if (in_array(2, $_SESSION['permissoes']) OR $_SESSION['nivel'] == 2) {
			# composição
			$render = new ClassRender();
			$render->setTitle("Sisfuel App - Saída de combustível");
			$render->setDescription("Saída de combustível");
			$render->setKeyWords("sisfuel");
			# Pasta na view
			$render->setDir("Mov_saida");
			$render->setBreadCrumb($breadcrumb);
			$render->renderLayout();
		} else {
			die("Você não tem permissão para acessar esta página");
		}
	}

	# Retorna o main da view/registrar_saida
	public function novo()
	{  
		$breadcrumb = [
			'Início' => '',
			'Movimento de Saída' => 'movimento_saida/',
			'Novo' => ''
		];

		if (in_array(2, $_SESSION['permissoes']) OR $_SESSION['nivel'] == 2) {
			# composição
			$render = new ClassRender();
			$render->setTitle("Sisfuel App - Registrar Saída de Combustível");
			$render->setDescription("Registrar Saída de Combustível");
			$render->setKeyWords("sisfuel");
			# Pasta na view
			$render->setDir("registrar_saida");
			$render->setBreadCrumb($breadcrumb);
			$render->renderLayout();
	    } else {
			die("Você não tem permissão para acessar esta página");
		}
	}

	# Retorna o main da view/Editar_motorista
	public function editar()
	{  	
		$breadcrumb = [
			'Início' => '',
			'Movimento de Saída' => 'movimento_saida/',
			'Editar' => ''
		];

		if (in_array(2, $_SESSION['permissoes']) OR $_SESSION['nivel'] == 2) {
			# composição
			$render = new ClassRender();
			$render->setTitle("Sisfuel App - Editar Movimento de Entrada");
			$render->setDescription("Editar movimento de entrada");
			$render->setKeyWords("movim");
			# Pasta na view
			$render->setDir("Editar_mov_saida");
			$render->setBreadCrumb($breadcrumb);
			$render->renderLayout();
		} else {
			die("Você não tem permissão para acessar esta página");
		}
	}

	function cadastrar(ClsMovSaida $objClass)
	{
		$objItf = new DaoMovSaida();
		return $objItf->cadastrar($objClass);		
	}
	
	function atualizar(ClsMovSaida $objClass)
	{
		$objItf = new DaoMovSaida();
		return $objItf->atualizar($objClass);
	}

	# Usado para listar no index com paginação
	function listar(ClsMovSaida $objClass)
	{
		$objItf = new DaoMovSaida();
		return $objItf->listar($objClass);
	}

	# Usado nos relatórios para exibir todos as saidas de combustíveis
	function listarTodos(ClsMovSaida $objClass)
	{
		$objItf = new DaoMovSaida();
		return $objItf->listarTodos($objClass);
	}


	# Retornar a quantidade de total (SOMA) de combustivel de determinado tanque
	function quantidadeTotalSaida(ClsMovSaida $objClass)
	{
		$objItf = new DaoMovSaida();
		return $objItf->quantidadeTotalSaida($objClass);
	}

	function deletar(ClsMovSaida $objClass)
	{
		$objItf = new DaoMovSaida();
		return $objItf->deletar($objClass);
	}

	
	function count(ClsMovSaida $objClass)
	{
		$objItf = new DaoMovSaida();
		return $objItf->count($objClass);
	}

	
	# Actions function

	# Method used in view
	public function excluir($id)
	{	
		# Absctract class AmovEntrada method excluirAction
		AmovSaida::excluirAction($id);
	}

	public function registrar()
	{	
		# Absctract class AmovEntrada method novoAction
		AmovSaida::registrarAction();
	}
}

?>