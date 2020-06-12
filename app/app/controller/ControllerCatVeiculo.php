<?php


namespace App\Controller;
session_start();
use Src\classes\ClassRender;
use Src\interfaces\InterfaceView;
# Action 
use App\Action\AcategoriaVeiculo;
# Model
use App\model\ClsCatVeiculo;
use App\model\DaoCatVeiculo;

class ControllerCatVeiculo extends ClsCatVeiculo
{
	public function list()
	{  
		$breadcrumb = [
			'Início' => '',
			'Categoria Veículos' => 'categoria_veiculo/list',
			'Listagem' => 'categoria_veiculo/list'
		];

		if (isset($_SESSION['id_usuario'])) {
			# composição
			$render = new ClassRender();
			$render->setTitle("Sisfuel App - Categoria veículo");
			$render->setDescription("Página inicial");
			$render->setKeyWords("sisfuel");
			# Pasta na view
			$render->setDir("Categoria_veiculo");
			$render->setBreadCrumb($breadcrumb);
			$render->renderLayout();
	    }  else {
			die("Você não tem permissão para acessar esta página");
		}
	}

	function cadastrar(ClsCatVeiculo $objClass){
		$objItf = new DaoCatVeiculo();
		return $objItf->cadastrar($objClass);		
	}
	
	function atualizar(ClsCatVeiculo $objClass){
		$objItf = new DaoCatVeiculo();
		return $objItf->atualizar($objClass);
	}

	function listar(ClsCatVeiculo $objClass){
		$objItf = new DaoCatVeiculo();
		return $objItf->listar($objClass);
	}

	function deletar(ClsCatVeiculo $objClass){
		$objItf = new DaoCatVeiculo();
		return $objItf->deletar($objClass);
	}

	
	function buscar_id(ClsCatVeiculo $objClass){
		$objItf = new DaoCatVeiculo();
		return $objItf->buscar_id($objClass);
	}

	function count(ClsCatVeiculo $objClass)
	{
		$objItf = new DaoCatVeiculo();
		return $objItf->count($objClass);
	}



	
	# Actions acessadas pela view ----------------------------------------------------------------------------------------

	// O nome desse metodo é acessado na URL.. ele acessa o excluirAction dentro de Action/AcategoriaVeiculo.. e la ele instancia essa classe ControllerCatVeiculo
	public function excluir($id){
		AcategoriaVeiculo::excluirAction($id);
	}

	public function novo(){
		AcategoriaVeiculo::novoAction();
	}
}
