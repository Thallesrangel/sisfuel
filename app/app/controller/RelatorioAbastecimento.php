<?php

namespace App\controller;

use App\Report\ReportAbastecimento;

if (!isset($_SESSION)) {
	session_start();
}

class RelatorioAbastecimento
{   
    public function render()
    {   
        new ReportAbastecimento();
    }
}