<?php

namespace App\controller;

if (!isset($_SESSION)) {
	session_start();
}

use Src\classes\ClassRender;
use App\Report\ReportMovEntrada;

if (!isset($_SESSION)) {
	session_start();
}

class RelatorioMovEntrada
{   
    public function render()
    {
        new ReportMovEntrada();
    }
    public function form(){
        $breadcrumb = [
			'Início' => '',
			'Relatório Movimento Entrada' => 'ticket/list',
			'Listagem' => ''
		];

        if (isset($_SESSION['id_usuario'])) {
			# Composição
            $render = new ClassRender();
            $render->setTitle("Sisfuel APP - Relatório Movimento de Entrada");
            $render->setDescription("Relatório Movimento de Entrada");
			$render->setKeyWords("sisfuel");
			# Pasta na View
			$render->setDir("Relatorio_mov_entrada");
			$render->setBreadCrumb($breadcrumb);
            $render->renderLayout();
        }
    }
}