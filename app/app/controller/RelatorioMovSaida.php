<?php

namespace App\controller;

use Src\classes\ClassRender;
use App\Report\ReportMovSaida;

if (!isset($_SESSION)) {
	session_start();
}

class RelatorioMovSaida
{   
    public function render()
    {
        new ReportMovSaida();
    }

    public function form(){
        $breadcrumb = [
			'Início' => '',
			'Relatório Movimento Saída' => 'ticket/list',
			'Formulário' => 'false'
		];

        if (isset($_SESSION['id_usuario'])) {
			# Composição
            $render = new ClassRender();
            $render->setTitle("Sisfuel APP - Relatório Movimento de Saída");
            $render->setDescription("Relatório Movimento de Saída");
			$render->setKeyWords("sisfuel");
			# Pasta na View
			$render->setDir("Relatorio_mov_saida");
			$render->setBreadCrumb($breadcrumb);
            $render->renderLayout();
        }
    }
}