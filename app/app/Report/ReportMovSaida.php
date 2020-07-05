<?php

namespace App\Report;

use Src\traits\TratarDados;
use App\controller\ControllerMovSaida;
use App\fpdf\fpdf;

class ReportMovSaida extends FPDF
{       
    use TratarDados;

        function header()
        {   
            $this->SetTitle("Sisvel - Movimento de saida de Combustível");
            $this->Image(DIRIMG."/logo.png",10,6);
            $this->SetFont('Arial','',12);
            $this->Cell(276,5,"Movimento de Saída de Combustíveis",0,0,'C');
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
            $this->Cell(15,8,'ID',1,0,'L');
            $this->Cell(20,8,'Veículo',1,0,'L');
            $this->Cell(33,8,'Tanque',1,0,'L');
            $this->Cell(20,8,'Quantidade',1,0,'L');
            $this->Cell(40,8,'Motorista',1,0,'L');
            $this->Cell(25,8,'km',1,0,'L');
            $this->Cell(25,8,'Saída',1,0,'L');
            $this->Ln();
        }
    
        function viewTable()
        {
    
            $this->SetFont('Arial', '', 7);        
            $data_inicial = TratarDados::tratarDataHora($_POST['data_inicial']);
            $data_final = preg_replace('#(\d{2})/(\d{2})/(\d{4})\s(.*)#', '$3-$2-$1 $4', $_POST['data_final']);
            
            $saida = new ControllerMovSaida();
            $saida->setMotorista($_POST['motorista']);
            $saida->setTanque($_POST['tanque']);
            $saida->setVeiculo($_POST['veiculo']);
            $saida->setDataInicial($data_inicial);
            $saida->setDataFinal($data_final);
            $saida = $saida->listarTodos($saida);
    
            foreach($saida as $value) {
                $this->Cell(15,7, $value['id_saida'],1,0,'L');
                $this->Cell(20,7,$value['placa'],1,0,'L');
                $this->Cell(33,7,$value['nome_tanque'],1,0,'L');
                $this->Cell(20,7,$value['quantidade'],1,0,'L');
                $this->Cell(40,7,$value['nome_motorista'],1,0,'L');
                $this->Cell(25,7,$value['km'],1,0,'L');
                $this->Cell(25,7,date("d/m/Y H:i", strtotime($value['data_hora'])),1,0,'L');
               
                $this->Ln();
            }
            
        }
    }

    $pdf = new ReportMovSaida();
    $pdf->AliasNbPages();
    $pdf->AddPage('L','A4',0);
    $pdf->headerTable();
    $pdf->viewTable();
    $pdf->Output();

