<?php

namespace App\Report;

use App\controller\ControllerManutencaoVeiculo;
use App\fpdf\fpdf;

class ReportManutencaoVeiculo extends FPDF
{
        function header(){
            $this->SetTitle(iconv('UTF-8', 'ISO-8859-1',"Sisvel - Manutenção Veículos"));
            $this->Image(DIRIMG."/logo.png",10,6);
            $this->SetFont('Arial','',12);
            $this->Cell(276,5,"Relatório Manutenção de Veículo",0,0,'C');
            $this->Ln();
            $this->setFont('Arial','',10);
            $this->Cell(276,10,'Software para gestão de combustíveis');
            $this->Ln(15);
        }
        function footer(){
            $this->SetY(-15);
            $this->SetFont('Arial','',8);
            $this->Cell(0,10,'Página '.$this->PageNo().'/{nb}',0,0,'C');
            $this->Cell(0,8,"Usuário: ".$_SESSION['nome_usuario'],0,0,'R');
            $this->Cell(0,15,"Emitido em: ".date("d/m/Y H:i:s"),0,0,'R');
        }
    
        function headerTable() { 
            $this->SetFont('Arial', 'B', 8);
            $this->Cell(14,8,'ID',1,0,'L');
            $this->Cell(40,8,'Título',1,0,'L');
            $this->Cell(45,8,'Fornecedor',1,0,'L');
            $this->Cell(18,8,'Placa',1,0,'L');
            $this->Cell(25,8,'Tipo',1,0,'L');
            $this->Cell(15,8,'Data',1,0,'L');
            $this->Cell(20,8,'Valor',1,0,'L');  
            $this->Cell(20,8,'Situação',1,0,'L');
            $this->Ln();
        }
    
        function viewTable(){
    
            $this->SetFont('Arial', '', 7);

            $abastecimento = new ControllerManutencaoVeiculo();
            $abastecimento = $abastecimento->listarTodos($abastecimento);
    
            foreach($abastecimento as $value) {
                $this->Cell(14,7, $value['id_manutencao'],1,0,'L');
                $this->Cell(40,7,$value['titulo'],1,0,'L');
                $this->Cell(45,7,$value['razao_social'],1,0,'L');
                $this->Cell(18,7,$value['placa'],1,0,'L');
                $this->Cell(25,7,$value['tipo_manutencao'],1,0,'L');
                $this->Cell(15,7,date("d/m/Y", strtotime($value['data_vencimento'])),1,0,'L');
                $this->Cell(20,7,$value['valor'],1,0,'L');
                $this->Cell(20,7,$value['situacao'],1,0,'L');
                $this->Ln();
            }
            
        }
    }

    $pdf = new ReportManutencaoVeiculo();
    $pdf->AliasNbPages();
    $pdf->AddPage('L','A4',0);
    $pdf->headerTable();
    $pdf->viewTable();
    $pdf->Output();