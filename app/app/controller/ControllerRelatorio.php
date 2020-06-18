<?php

namespace App\Controller;

session_start();

use Src\classes\ClassRender;
use Src\interfaces\InterfaceView;

class ControllerRelatorio
{
	public function list()
	{  
		$breadcrumb = [
			'Início' => '',
			'Relatorio' => 'false',
		];

		if (isset($_SESSION['id_usuario'])) {
			# composição
			$render = new ClassRender();
			$render->setTitle("Sisfuel App - Relatórios");
			$render->setDescription("Página inicial");
			$render->setKeyWords("sisfuel");
			# Pasta na view
			$render->setDir("Relatorio");
			$render->setBreadCrumb($breadcrumb);
			$render->renderLayout();
        }
    }
}