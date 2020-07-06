<?php

namespace App\controller;

use Src\classes\ClassRender;
use App\Report\ReportIpva;

if (!isset($_SESSION)) {
	session_start();
}

class RelatorioIpva
{
    public function render()
    {
        new ReportIpva();
    }

    public function form(){
        $breadcrumb = [
			'Início' => '',
			'Relatório IPVA' => 'relatorio-ipva/form',
			'Formulário' => 'false'
		];

        if (isset($_SESSION['id_usuario'])) {
			# Composição
            $render = new ClassRender();
            $render->setTitle("Sisfuel APP - Relatório IPVA");
            $render->setDescription("Relatório IPVA");
			$render->setKeyWords("sisfuel");
			# Pasta na View
			$render->setDir("Relatorio_ipva");
			$render->setBreadCrumb($breadcrumb);
            $render->renderLayout();
        }
    }
}