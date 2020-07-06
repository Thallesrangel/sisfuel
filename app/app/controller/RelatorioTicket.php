<?php

namespace App\controller;

use Src\classes\ClassRender;
use App\Report\ReportTicket;
use App\Report\ReportGerarTicket;

if (!isset($_SESSION)) {
	session_start();
}

class RelatorioTicket
{
    public function render()
    {
        new ReportTicket();
    }

    # Gerar ticket de abastecimento para impressão
    public function gerar(int $idTicket)
    {
        $reportTicket = new ReportGerarTicket();
        $reportTicket->gerarTicket($idTicket);
    }

    public function form(){
        $breadcrumb = [
			'Início' => '',
            'Relatório Ticket' => 'relatorio-ticket-abastecimento/form',
			'Formulário' => 'false'
		];

        if (isset($_SESSION['id_usuario'])) {
			# Composição
            $render = new ClassRender();
            $render->setTitle("Sisfuel APP - Relatório Ticket Abastecimento");
            $render->setDescription("Relatório Movimento Ticket Abastecimento");
			$render->setKeyWords("sisfuel");
			# Pasta na View
			$render->setDir("Relatorio_ticket");
			$render->setBreadCrumb($breadcrumb);
            $render->renderLayout();
        }
    }
}