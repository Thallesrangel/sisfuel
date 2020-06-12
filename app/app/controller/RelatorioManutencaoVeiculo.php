<?php

namespace App\controller;

use App\Report\ReportManutencaoVeiculo;

if (!isset($_SESSION)) {
	session_start();
}

class RelatorioManutencaoVeiculo
{   
    public function render()
    {   
        new ReportManutencaoVeiculo();
    }
}