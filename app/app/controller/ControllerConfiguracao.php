<?php

namespace App\controller;

if (!isset($_SESSION)) {
	session_start();
}
use Src\classes\ClassRender;
use Src\interfaces\InterfaceView;

# Action 
use App\Action\Acliente;
# Model Cliente
use App\model\ClsCliente;
use App\model\DaoCliente;


class ControllerConfiguracao
{
    public function index()
    {      
        $breadcrumb = [
			'Início' => '',
			'Configuração' => 'configuracao/list',
			'Listagem' => ''
		];
        if (isset($_SESSION['id_usuario'])) {
            $render = new ClassRender();
            $render->setTitle("Sisfuel APP - Configuração");
            $render->setDescription("Configuração");
            $render->setKeyWords("sisfuel");
            $render->setDir("Configuracao");
            $render->setBreadCrumb($breadcrumb);
            $render->renderLayout();
        } else {
			die("Você não tem permissão para acessar esta página");
		}
    }

}