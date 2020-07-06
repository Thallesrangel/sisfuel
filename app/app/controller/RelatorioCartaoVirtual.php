<?php

namespace App\controller;

use Src\classes\ClassRender;
use App\Report\ReportCartaoVirtual;

if (!isset($_SESSION)) {
	session_start();
}

class RelatorioCartaoVirtual
{
    public function render()
    {
        new ReportCartaoVirtual();
    }

    public function form(){
        $breadcrumb = [
			'Início' => '',
			'Relatório Cartão Virtual' => 'relatorio-cartao-virtual/form',
			'Formulário' => 'false'
		];

        if (isset($_SESSION['id_usuario'])) {
			# Composição
            $render = new ClassRender();
            $render->setTitle("Sisfuel APP - Relatório Cartão Virtual");
            $render->setDescription("Relatório Cartão Virtual");
			$render->setKeyWords("sisfuel");
			# Pasta na View
			$render->setDir("Relatorio_cartao_virtual");
			$render->setBreadCrumb($breadcrumb);
            $render->renderLayout();
        }
    }
}