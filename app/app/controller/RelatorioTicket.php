<?php

namespace App\controller;

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
}