<?php

namespace App\Report;

use App\controller\ControllerCartaoVirtual;
use App\fpdf\fpdf;

class ReportCartaoVirtual extends FPDF
{   
    function header()
    {
        $this->SetTitle(iconv('UTF-8', 'ISO-8859-1',"Sisvel - Cartão Virtual"));
        $this->Image(DIRIMG."/logo.png",10,6);
        $this->SetFont('Arial','',12);
        $this->Cell(276,5,"Relatório Cartão Virtual",0,0,'C');
        $this->Ln();
        $this->setFont('Arial','',10);
        $this->Cell(276,10,'Software para gestão de combustíveis');
        $this->Ln(15);
    }
    function footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial','',8);
        $this->Cell(0,10,'Página '.$this->PageNo().'/{nb}',0,0,'C');
        $this->Cell(0,5,"Usuário: ".$_SESSION['nome_usuario'],0,0,'R');
        $this->Cell(0,15,"Emitido em: ".date("d/m/Y H:i:s"),0,0,'R');
    }

    function headerTable()
    { 
        $this->SetFont('Arial', 'B', 8);
        $this->Cell(20,8,'ID',1,0,'L');
        $this->Cell(40,8,'Motorista',1,0,'L');
        $this->Cell(20,8,'Valor Limite',1,0,'L');
        $this->Cell(30,8,'Data Validade',1,0,'L');
        $this->Cell(30,8,'Situação',1,0,'L');
        $this->Cell(30,8,'Renovação',1,0,'L');
        $this->Ln();
    }

    function viewTable()
    {
        $this->SetFont('Arial', '', 7);
        $usuario = new ControllerCartaoVirtual();
        $usuarios = $usuario->listar($usuario);

        foreach ($usuarios as $value) {
            $this->Cell(20,7, $value['id_cartao'],1,0,'L');
            $this->Cell(40,7,$value['nome_motorista'],1,0,'L');
            $this->Cell(20,7,$value['valor_limite'],1,0,'L');
            $this->Cell(30,7,date("d/m/Y", strtotime($value['data_validade'])),1,0,'L');
            $this->Cell(30,7,$value['cartao_situacao'],1,0,'L');
            $this->Cell(30,7,$value['cartao_renovacao'],1,0,'L');
            $this->Ln();
        }
        
    }
}

$pdf = new ReportCartaoVirtual();
$pdf->AliasNbPages();
$pdf->AddPage('P','A4',0);
$pdf->headerTable();
$pdf->viewTable();
$pdf->Output();