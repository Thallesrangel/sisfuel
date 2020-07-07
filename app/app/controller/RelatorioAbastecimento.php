<?php

namespace App\controller;

use Src\classes\ClassRender;
use App\Report\ReportAbastecimento;

if (!isset($_SESSION)) {
	session_start();
}

class RelatorioAbastecimento
{   
    public function render()
    {   
        new ReportAbastecimento();
    }

    public function form(){
        $breadcrumb = [
			'Início' => '',
			'Relatório Abastecimento' => 'relatorio-abastecimento/form',
			'Formulário' => 'false'
		];

        if (isset($_SESSION['id_usuario'])) {
			# Composição
            $render = new ClassRender();
            $render->setTitle("Sisfuel APP - Relatório Abastecimento");
            $render->setDescription("Relatório Abastecimento");
			$render->setKeyWords("sisfuel");
			# Pasta na View
			$render->setDir("Relatorio_abastecimento");
			$render->setBreadCrumb($breadcrumb);
            $render->renderLayout();
        }
    }
}