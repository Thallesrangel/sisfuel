<?php

namespace App\controller;

use Src\classes\ClassRender;
use App\Report\ReportSeguro;

if (!isset($_SESSION)) {
	session_start();
}

class RelatorioSeguro
{   
    public function render()
    {
        new ReportSeguro();
    }

    public function form(){
        $breadcrumb = [
			'Início' => '',
			'Relatório Seguro' => 'relatorio-seguro/form',
			'Formulário' => 'false'
		];

        if (isset($_SESSION['id_usuario'])) {
			# Composição
            $render = new ClassRender();
            $render->setTitle("Sisfuel APP - Relatório Seguro");
            $render->setDescription("Relatório Seguro");
			$render->setKeyWords("sisfuel");
			# Pasta na View
			$render->setDir("Relatorio_seguro");
			$render->setBreadCrumb($breadcrumb);
            $render->renderLayout();
        }
    }
}