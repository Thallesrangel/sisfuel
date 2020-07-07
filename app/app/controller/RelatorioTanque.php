<?php

namespace App\controller;

use Src\classes\ClassRender;
use App\Report\ReportTanque;

if (!isset($_SESSION)) {
	session_start();
}

class RelatorioTanque
{
    public function render()
    {
        new ReportTanque();
    }

    public function form(){
        $breadcrumb = [
			'Início' => '',
			'Relatório Tanque' => 'relatorio-tanque/form',
			'Formulário' => 'false'
		];

        if (isset($_SESSION['id_usuario'])) {
			# Composição
            $render = new ClassRender();
            $render->setTitle("Sisfuel APP - Relatório Tanque");
            $render->setDescription("Relatório Tanque");
			$render->setKeyWords("sisfuel");
			# Pasta na View
			$render->setDir("Relatorio_tanque");
			$render->setBreadCrumb($breadcrumb);
            $render->renderLayout();
        }
    }
}