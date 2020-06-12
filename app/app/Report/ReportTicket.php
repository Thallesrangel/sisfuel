<?php

namespace App\Report;

use App\controller\ControllerTicket;
use App\fpdf\fpdf;

class ReportTicket extends FPDF
{
        function header(){
            $this->SetTitle("Sisvel - Ticket Abastecimento");
            $this->Image(DIRIMG."/logo.png",10,6);
            $this->SetFont('Arial','',12);
            $this->Cell(276,5,"Relatório Ticket Abastecimento",0,0,'C');
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
            $this->Cell(14,8,'Ticket',1,0,'L');
            $this->Cell(40,8,'Fornecedor',1,0,'L');
            $this->Cell(25,8,'CNPJ',1,0,'L');
            $this->Cell(18,8,'Veículo',1,0,'L');
            $this->Cell(25,8,'Combustível',1,0,'L');
            $this->Cell(22,8,'Quantidade',1,0,'L');
           // $this->Cell(20,8,'Hodômetro',1,0,'L');  
            $this->Cell(35,8,'Motorista',1,0,'L');
            $this->Cell(25,8,'Data',1,0,'L');
            $this->Ln();
        }
    
        function viewTable(){
    
            $this->SetFont('Arial', '', 7);

            $ticket = new ControllerTicket();
            $ticket = $ticket->listarTodos($ticket);
    
            foreach($ticket as $value) {
                $this->Cell(14,7, $value['id_ticket'],1,0,'L');
                $this->Cell(40,7,$value['razao_social'],1,0,'L');
                $this->Cell(25,7,$value['cnpj'],1,0,'L');
                $this->Cell(18,7,$value['placa'],1,0,'L');
                $this->Cell(25,7,$value['categoria_combustivel'],1,0,'L');
                $this->Cell(22,7,$value['quantidade'],1,0,'L');
               // $this->Cell(20,7,$value['km'],1,0,'L');
                $this->Cell(35,7,$value['nome_motorista'],1,0,'L');
                $this->Cell(25,7,date("d/m/Y", strtotime($value['data_entrada'])),1,0,'L');
                $this->Ln();
            }
            
        }
    }

    $pdf = new ReportTicket();
    $pdf->AliasNbPages();
    $pdf->AddPage('L','A4',0);
    $pdf->headerTable();
    $pdf->viewTable();
    $pdf->Output();