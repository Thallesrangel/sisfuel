<?php

namespace App\controller;

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
}