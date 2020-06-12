<?php

namespace App\controller;

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
}