<?php

namespace App\controller;

use App\Report\ReportFornecedor;

if (!isset($_SESSION)) {
	session_start();
}

class RelatorioFornecedor
{   
    public function render()
    {   
        new ReportFornecedor();
    }
}