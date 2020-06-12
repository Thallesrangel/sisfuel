<?php

namespace App\controller;

use App\Report\ReportMotorista;

if (!isset($_SESSION)) {
	session_start();
}

class RelatorioMotorista
{   
    public function render()
    {   
        new ReportMotorista();
    }
}