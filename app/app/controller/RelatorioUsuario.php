<?php

namespace App\controller;

use App\Report\ReportUsuario;

if (!isset($_SESSION)) {
	session_start();
}

class RelatorioUsuario
{
    public function render()
    {
        ReportUsuario::relatorioCompletoUSuario();
    }
}