<?php

namespace App\controller;

if (!isset($_SESSION)) {
	session_start();
}

use Src\classes\ClassRender;
use Src\interfaces\InterfaceView;
# Action
use App\Action\Afornecedor;
# Model
use App\model\ClsFornecedor;
use App\model\DaoFornecedor;

class ControllerFornecedor extends ClsFornecedor{

	# Retorna a listagem inicial dos fornecedores
	public function list()
    {   
		$breadcrumb = [
			'Início' => '',
			'Fornecedor' => 'fornecedor/list',
			'Listagem' => ''
		];

        if(isset($_SESSION['id_usuario'])){
            $render = new ClassRender();
            $render->setTitle("Sisfuel APP - Fornecedor");
            $render->setDescription("fornecedor");
            $render->setKeyWords("sisfuel");
			$render->setDir("Fornecedor");
			$render->setBreadCrumb($breadcrumb);
			$render->renderLayout();
        }  else {
			die("Você não tem permissão para acessar esta página");
		}
	}

	function cadastrar(ClsFornecedor $objClass)
	{
		$objItf = new DaoFornecedor();
		return $objItf->cadastrar($objClass);		
	}
	
	function atualizar(ClsFornecedor $objClass)
	{
		$objItf = new DaoFornecedor();
		return $objItf->atualizar($objClass);
	}

	function listar(ClsFornecedor $objClass)
	{
		$objItf = new DaoFornecedor();
		return $objItf->listar($objClass);
	}

	function listarTodos(ClsFornecedor $objClass)
	{
		$objItf = new DaoFornecedor();
		return $objItf->listarTodos($objClass);
	}

	# Lista fornecedores com id = 2 que corresponde as seguradoras
	function listarSeguradoras(ClsFornecedor $objClass)
	{
		$objItf = new DaoFornecedor();
		return $objItf->listarSeguradoras($objClass);
	}

	function deletar(ClsFornecedor $objClass)
	{
		$objItf = new DaoFornecedor();
		return $objItf->deletar($objClass);
	}

	
	function buscar_id(ClsFornecedor $objClass)
	{
		$objItf = new DaoFornecedor();
		return $objItf->buscar_id($objClass);
	}

	function count(ClsFornecedor $objClass)
	{
		$objItf = new DaoFornecedor();
		return $objItf->count($objClass);
	}

	# Actions acessadas pela view ----------------------------------------------------------------------------------------

	// o nome desse metodo é acessado na URL.. ele acessa o excluirAction dentro de Action/Afornecedor.. e la ele instancia essa classe Fornecedor
	public function excluir($id)
	{
		$retorno = Afornecedor::excluirAction($id);
		if ($retorno) {
			header("Location: ".$_SERVER['HTTP_REFERER']."");
		} else {
			die('ocorreu um erro ao excluir fornecedor');
		}
	}

	public function novo()
	{
		$retorno = Afornecedor::novoAction();
		if ($retorno) {
			header("Location: ".$_SERVER['HTTP_REFERER']."");
		} else {
			die('ocorreu um erro ao cadastrar fornecedor');
		}
	}

	public function alterar()
	{
		$retorno = Afornecedor::alterarAction();
		if ($retorno) {
			header("Location: ".$_SERVER['HTTP_REFERER']."");
		} else {
			die('ocorreu um erro ao alterar registro do fornecedor');
		}
	}
}