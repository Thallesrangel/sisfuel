<?php

namespace App\controller;

use App\Report\ReportIpva;

if (!isset($_SESSION)) {
	session_start();
}

class RelatorioIpva
{
    public function render()
    {
        new ReportIpva();
    }
}