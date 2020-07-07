<?php

namespace App\controller;

use Src\classes\ClassRender;
use App\Report\ReportVeiculo;

if (!isset($_SESSION)) {
	session_start();
}

class RelatorioVeiculo
{
    public function render()
    {
        new ReportVeiculo();
    }

    public function form(){
        $breadcrumb = [
			'Início' => '',
			'Relatório Veículo' => 'relatorio-veiculo/form',
			'Formulário' => 'false'
		];

        if (isset($_SESSION['id_usuario'])) {
			# Composição
            $render = new ClassRender();
            $render->setTitle("Sisfuel APP - Relatório Veículo");
            $render->setDescription("Relatório Veículo");
			$render->setKeyWords("sisfuel");
			# Pasta na View
			$render->setDir("Relatorio_veiculo");
			$render->setBreadCrumb($breadcrumb);
            $render->renderLayout();
        }
    }
}