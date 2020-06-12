<?php

namespace App\Report;

use App\controller\ControllerSeguro;
use App\fpdf\fpdf;

class ReportSeguro extends FPDF
{
        function header()
        {
            $this->SetTitle("Sisvel - Seguros");
            $this->Image(DIRIMG."/logo.png",10,6);
            $this->SetFont('Arial','',12);
            $this->Cell(276,5,"Relatório de Seguros",0,0,'C');
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
            $this->Cell(0,8,"Usuário: ".$_SESSION['nome_usuario'],0,0,'R');
            $this->Cell(0,15,"Emitido em: ".date("d/m/Y H:i:s"),0,0,'R');
        }
    
        function headerTable()
        { 
            $this->SetFont('Arial', 'B', 8);
            $this->Cell(14,8,'ID',1,0,'L');
            $this->Cell(40,8,'Apolice',1,0,'L');
            $this->Cell(25,8,'Vencimento',1,0,'L');
            $this->Cell(18,8,'Situação',1,0,'L');
            $this->Cell(25,8,'Seguradora',1,0,'L'); 
            $this->Ln();
        }
    
        function viewTable()
        {
            $this->SetFont('Arial', '', 7);

            $seguro = new ControllerSeguro();
            $seguro = $seguro->listarTodos($seguro);
    
            foreach ($seguro as $value) {
                $this->Cell(14,7, $value['id_seguro'],1,0,'L');
                $this->Cell(40,7,$value['apolice'],1,0,'L');
                $this->Cell(25,7,date("d/m/Y", strtotime($value['data_vencimento'])),1,0,'L');
                $this->Cell(18,7,$value['situacao'],1,0,'L');
                $this->Cell(25,7,$value['razao_social'],1,0,'L');
                $this->Ln();
            }
            
        }
    }

    $pdf = new ReportSeguro();
    $pdf->AliasNbPages();
    $pdf->AddPage('L','A4',0);
    $pdf->headerTable();
    $pdf->viewTable();
    $pdf->Output();