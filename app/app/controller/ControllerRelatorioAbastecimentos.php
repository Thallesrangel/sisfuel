<?php

namespace App\Controller;

session_start();

use Src\classes\ClassRender;
use Src\interfaces\InterfaceView;

class ControllerRelatorioAbastecimentos
{
	public function list()
	{  
		$breadcrumb = [
			'Início' => '',
			'Relatorios Abastecimentos' => 'false',
		];

		if (isset($_SESSION['id_usuario'])) {
			# composição
			$render = new ClassRender();
			$render->setTitle("Sisfuel App - Relatórios Abastecimentos");
			$render->setDescription("Página inicial");
			$render->setKeyWords("sisfuel");
			# Pasta na view
			$render->setDir("Relatorio_abastecimentos");
			$render->setBreadCrumb($breadcrumb);
			$render->renderLayout();
        }
    }
}