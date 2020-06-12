<?php

namespace App\Report;

use App\controller\ControllerMovEntrada;
use App\fpdf\fpdf;

class ReportMovEntrada extends FPDF
{
        function header(){
            $this->SetTitle("Sisvel - Movimento de entrada de Combustível");
            $this->Image(DIRIMG."/logo.png",10,6);
            $this->SetFont('Arial','',12);
            $this->Cell(276,5,"Movimento de Entrada de Combustíveis",0,0,'C');
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
            $this->Cell(10,8,'ID',1,0,'L');
            $this->Cell(18,8,'NF',1,0,'L');
            $this->Cell(33,8,'Tanque',1,0,'L');
            $this->Cell(20,8,'Quantidade',1,0,'L');
            $this->Cell(20,8,'R$ Unitário',1,0,'L');
            $this->Cell(17,8,'R$ Total',1,0,'L');
            $this->Cell(45,8,'Fornecedor',1,0,'L');
            $this->Cell(27,8,'CNPJ Fornecedor',1,0,'L');  
            $this->Cell(40,8,'Motorista',1,0,'L');
            $this->Cell(15,8,'Veículo',1,0,'L');
            $this->Cell(23,8,'Entrada',1,0,'L');
            $this->Ln();
        }
    
        function viewTable(){
    
            $this->SetFont('Arial', '', 7);

            $entrada = new ControllerMovEntrada();
            $entrada->setPlaca($_POST['veiculo']);
            $entrada->setDataInicial(date("Y-m-d H:i:s", strtotime($_POST['data_inicial'])));
            $entrada->setDataFinal(date("Y-m-d H:i:s", strtotime($_POST['data_final'])));
            $entrada = $entrada->listarTodos($entrada);
    
            foreach($entrada as $value) {
                $this->Cell(10,7, $value['id_entrada'],1,0,'L');
                $this->Cell(18,7,$value['nota_fiscal'],1,0,'L');
                $this->Cell(33,7,$value['nome_tanque'],1,0,'L');
                $this->Cell(20,7,$value['quantidade'],1,0,'L');
                $this->Cell(20,7,$value['valor_unitario'],1,0,'L');
                $this->Cell(17,7,$value['valor_total'],1,0,'L');
                $this->Cell(45,7,$value['razao_social'],1,0,'L');
                $this->Cell(27,7,$value['cnpj'],1,0,'L');
                $this->Cell(40,7,$value['motorista'],1,0,'L');
                $this->Cell(15,7,$value['placa'],1,0,'L');
                $this->Cell(23,7,date("d/m/Y H:i", strtotime($value['data_entrada'])),1,0,'L');
                $this->Ln();
            }
            
        }
    }

    $pdf = new ReportMovEntrada();
    $pdf->AliasNbPages();
    $pdf->AddPage('L','A4',0);
    $pdf->headerTable();
    $pdf->viewTable();
    $pdf->Output();