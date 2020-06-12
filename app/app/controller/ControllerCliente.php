<?php

namespace App\Controller;
session_start();

use Src\classes\ClassRender;
use Src\interfaces\InterfaceView;
# Action 
use App\Action\Acliente;
# Model
use App\model\ClsCliente;
use App\model\DaoCliente;


class ControllerCliente extends ClsCliente
{

    public function __construct()
    {   
        ob_start ();
        $render = new ClassRender();
        $render->setTitle("Sisfuel App - Novo Cliente");
        $render->setDescription("Sisfuel");
        $render->setKeyWords("sisfuel");
        $render->setDir("Registrar_cliente");
        $render->renderLayout();
    }

	function cadastrar(ClsCliente $objClass)
	{
		$objItf = new DaoCliente();
		return $objItf->cadastrar($objClass);		
	}

	function atualizar(ClsCliente $objClass)
	{
		$objItf = new DaoCliente();
		return $objItf->atualizar($objClass);
	}

	function listar(ClsCliente $objClass)
	{
		$objItf = new DaoCliente();
		return $objItf->listar($objClass);
	}

	function deletar(ClsCliente $objClass)
	{
		$objItf = new DaoCliente();
		return $objItf->deletar($objClass);
	}

	function buscarClienteNome(ClsCliente $objClass)
	{
		$objItf = new DaoCliente();
		return $objItf->buscarUsuario($objClass);
	}

	function count(ClsCliente $objClass)
	{
		$objItf = new DaoCliente();
		return $objItf->count($objClass);
	}

	# Actions function

	public function registrar()
	{	
		# Absctract class AmovEntrada method novoAction
		Acliente::registrarAction();
	}

}

?>