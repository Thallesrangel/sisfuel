<?php

namespace App\Controller;

if (!isset($_SESSION)) {
	session_start();
}

use Src\classes\ClassRender;
use Src\interfaces\InterfaceView;

# Model
use App\model\ClsFabricante;
use App\model\DaoFabricante;

class ControllerFabricante extends ClsFabricante
{	
	public function list()
	{  	
		$breadcrumb = [
			'Início' => '',
			'Fabricante' => 'fabricante/list',
			'Listagem' => ''
		];

		if(isset($_SESSION['id_usuario'])) {
			# composição
			$render = new ClassRender();
			$render->setTitle("Sisfuel App - Fabricante de veículos");
			$render->setDescription("Página inicial");
			$render->setKeyWords("sisfuel");
			$render->setDir("Fabricante_veiculo");
			$render->setBreadCrumb($breadcrumb);
			$render->renderLayout();
	    }  else {
			die("Você não tem permissão para acessar esta página");
		}
	}

	function cadastrar(ClsFabricante $objClass)
	{
		$objItf = new DaoFabricante();
		return $objItf->cadastrar($objClass);		
	}
	
	function atualizar(ClsFabricante $objClass)
	{
		$objItf = new DaoFabricante();
		return $objItf->atualizar($objClass);
	}

	function listar(ClsFabricante $objClass)
	{
		$objItf = new DaoFabricante();
		return $objItf->listar($objClass);
	}

	function deletar(ClsFabricante $objClass)
	{
		$objItf = new DaoFabricante();
		return $objItf->deletar($objClass);
	}

	
	function buscar_id(ClsFabricante $objClass)
	{
		$objItf = new DaoFabricante();
		return $objItf->buscar_id($objClass);
	}

	function count(ClsFabricante $objClass)
	{
		$objItf = new DaoFabricante();
		return $objItf->count($objClass);
	}

/* FIM PADRÃO CONTROLLER */


	function cadastrarmodelo()
	{
		if(isset($_POST['name'])){
			$nome = trim($_POST['name']);
		  } else {
			$nome = "";
		  }
		
			$init = new ControllerCatModelo(); 
			$init->setNome($nome);
			$cadastrar = $init->cadastrar($init);
		
			if ($cadastrar) {
		
			  $_SESSION["mensagem"] = "registrado";
			  header("Location: fabricante");
		
			} else {
		
			  $_SESSION["mensagem"] = "erro_registrar";
			  header("Location: fabricante");
			}
	}
}	


?>