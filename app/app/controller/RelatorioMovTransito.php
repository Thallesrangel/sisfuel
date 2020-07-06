<?php

namespace App\controller;

use Src\classes\ClassRender;
use App\Report\ReportMovTransito;

if (!isset($_SESSION)) {
	session_start();
}

class RelatorioMovTransito
{   
    public function render()
    {
        new ReportMovTransito();
    }

    public function form(){
        $breadcrumb = [
			'Início' => '',
			'Relatório Movimento em Trânsito' => 'relatorio-movimento-transito/form',
			'Formulário' => 'false'
		];

        if (isset($_SESSION['id_usuario'])) {
			# Composição
            $render = new ClassRender();
            $render->setTitle("Sisfuel APP - Relatório Movimento em Trânsito");
            $render->setDescription("Relatório Movimento em Trânsito");
			$render->setKeyWords("sisfuel");
			# Pasta na View
			$render->setDir("Relatorio_mov_transito");
			$render->setBreadCrumb($breadcrumb);
            $render->renderLayout();
        }
    }
}