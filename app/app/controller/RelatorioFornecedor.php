<?php

namespace App\controller;


use Src\classes\ClassRender;
use App\Report\ReportFornecedor;

if (!isset($_SESSION)) {
	session_start();
}

class RelatorioFornecedor
{   
    public function render()
    {   
        new ReportFornecedor();
    }

    public function form(){
        $breadcrumb = [
			'Início' => '',
			'Relatório Fornecedor' => 'relatorio-fornecedor/form',
			'Formulário' => 'false'
		];

        if (isset($_SESSION['id_usuario'])) {
			# Composição
            $render = new ClassRender();
            $render->setTitle("Sisfuel APP - Relatório Fornecedor");
            $render->setDescription("Relatório Fornecedor");
			$render->setKeyWords("sisfuel");
			# Pasta na View
			$render->setDir("Relatorio_fornecedor");
			$render->setBreadCrumb($breadcrumb);
            $render->renderLayout();
        }
    }
}