<?php

namespace App\controller;

use App\Report\ReportSeguro;

if (!isset($_SESSION)) {
	session_start();
}

class RelatorioSeguro
{   
    public function render()
    {
        new ReportSeguro();
    }
}