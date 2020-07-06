<?php

namespace App\Report;

use Src\traits\TratarDados;
use App\controller\ControllerMovTransito;
use App\fpdf\fpdf;

class ReportMovTransito extends FPDF
{       
    use TratarDados;

        function header()
        {   
            $this->SetTitle("Sisvel - Movimento em Transito");
            $this->Image(DIRIMG."/logo.png",10,6);
            $this->SetFont('Arial','',12);
            $this->Cell(276,5,"Movimento em Trânsito de Combustíveis",0,0,'C');
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
            $this->Cell(20,8,'Veículo',1,0,'L');
            $this->Cell(33,8,'Fornecedor',1,0,'L');
            $this->Cell(20,8,'Quantidade',1,0,'L');
            $this->Cell(20,8,'R$ Total',1,0,'L');
            $this->Cell(20,8,'R$ Unitário',1,0,'L');
            $this->Cell(20,8,'KM',1,0,'L');
            $this->Cell(28,8,'Comprovante',1,0,'L');
            $this->Cell(40,8,'Motorista',1,0,'L');
            $this->Cell(20,8,'km',1,0,'L');
            $this->Cell(25,8,'Combustível',1,0,'L');
            $this->Cell(25,8,'Abastecimento',1,0,'L');
            $this->Ln();
        }
    
        function viewTable()
        {
    
            $this->SetFont('Arial', '', 7);        
            $data_inicial = TratarDados::tratarDataHora($_POST['data_inicial']);
            $data_final = preg_replace('#(\d{2})/(\d{2})/(\d{4})\s(.*)#', '$3-$2-$1 $4', $_POST['data_final']);
            
            $transito = new ControllerMovTransito();
            $transito->setMotorista($_POST['motorista']);
            $transito->setFornecedor($_POST['fornecedor']);
            $transito->setVeiculo($_POST['veiculo']);

            $transito->setDataInicial($data_inicial);
            $transito->setDataFinal($data_final);
            $transito = $transito->listarTodos($transito);
    
            foreach($transito as $value) {
                $this->Cell(20,7,$value['placa'],1,0,'L');
                $this->Cell(33,7,$value['razao_social'],1,0,'L');
                $this->Cell(20,7,$value['quantidade'],1,0,'L');
                $this->Cell(20,7,'R$: ' . number_format($value['valor_total'],2,",","."),1,0,'L');
                $this->Cell(20,7,'R$: ' . number_format($value['valor_unitario'],2,",","."),1,0,'L');
                $this->Cell(20,7,$value['km'],1,0,'L');
                $this->Cell(28,7,$value['comprovante'],1,0,'L');
                $this->Cell(40,7,$value['nome_motorista'],1,0,'L');
                $this->Cell(20,7,$value['km'],1,0,'L');
                $this->Cell(25,7,$value['categoria_combustivel'],1,0,'L');
                $this->Cell(25,7,date("d/m/Y H:i", strtotime($value['data_hora'])),1,0,'L');
               
                $this->Ln();
            }
            
        }
    }

    $pdf = new ReportMovTransito();
    $pdf->AliasNbPages();
    $pdf->AddPage('L','A4',0);
    $pdf->headerTable();
    $pdf->viewTable();
    $pdf->Output();

