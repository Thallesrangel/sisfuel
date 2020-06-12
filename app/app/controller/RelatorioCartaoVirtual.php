<?php

namespace App\controller;

use App\Report\ReportCartaoVirtual;

if (!isset($_SESSION)) {
	session_start();
}

class RelatorioCartaoVirtual
{
    public function render()
    {
        new ReportCartaoVirtual();
    }
}