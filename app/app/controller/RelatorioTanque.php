<?php

namespace App\controller;

use App\Report\ReportTanque;

if (!isset($_SESSION)) {
	session_start();
}

class RelatorioTanque
{
    public function render()
    {
        new ReportTanque();
    }
}