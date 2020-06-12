<?php

namespace App\Report;

use App\controller\ControllerVeiculo;
use App\fpdf\fpdf;

class ReportVeiculo extends FPDF
{   
    function header(){
        $this->SetTitle("Sisvel - Veiculos");
        $this->Image(DIRIMG."/logo.png",10,6);
        $this->SetFont('Arial','',12);
        $this->Cell(276,5,"Relatório de Veículos",0,0,'C');
        $this->Ln();
        $this->setFont('Arial','',10);
        $this->Cell(276,10,'Software para gestão de combustíveis');
        $this->Ln(15);
    }
    function footer(){
        $this->SetY(-15);
        $this->SetFont('Arial','',8);
        $this->Cell(0,10,'Página '.$this->PageNo().'/{nb}',0,0,'C');
        $this->Cell(0,5,"Usuário: ".$_SESSION['nome_usuario'],0,0,'R');
        $this->Cell(0,15,"Emitido em: ".date("d/m/Y H:i:s"),0,0,'R');
    }

    function headerTable() { 
        $this->SetFont('Arial', 'B', 8);
        $this->Cell(20,8,'ID',1,0,'L');
        $this->Cell(20,8,'Veículo',1,0,'L');
        $this->Cell(30,8,'Renavam',1,0,'L');
        $this->Cell(35,8,'Fabricante',1,0,'L');
        $this->Cell(30,8,'Combustível',1,0,'L');
         $this->Cell(30,8,'Categoria',1,0,'L');
        $this->Ln();
    }

    function viewTable(){

        $this->SetFont('Arial', '', 7);
        $veiculo = new ControllerVeiculo();
        $veiculo = $veiculo->listarTodos($veiculo);

        foreach($veiculo as $value) {
            $this->Cell(20,7, $value['id_veiculo'],1,0,'L');
            $this->Cell(20,7,$value['placa'],1,0,'L');
            $this->Cell(30,7,$value['renavam'],1,0,'L');
            $this->Cell(35,7,$value['nome_fabricante'],1,0,'L');
            $this->Cell(30,7,$value['categoria_combustivel'],1,0,'L');
            $this->Cell(30,7,$value['categoria_veiculo'],1,0,'L');
            $this->Ln();
        }
        
    }
}

$pdf = new ReportVeiculo();
$pdf->AliasNbPages();
$pdf->AddPage('P','A4',0);
$pdf->headerTable();
$pdf->viewTable();
$pdf->Output();