<?php

namespace App\Report;

use Src\traits\TratarDados;
use App\controller\ControllerIpva;
use App\fpdf\fpdf;

class ReportIpva extends FPDF
{   
    use TratarDados;
    
    function header(){
        $this->SetTitle("Sisvel - Ipva");
        $this->Image(DIRIMG."/logo.png",10,6);
        $this->SetFont('Arial','',12);
        $this->Cell(276,5,"Relatório de Ipva",0,0,'C');
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
        $this->Cell(15,8,'Veículo',1,0,'L');
        $this->Cell(20,8,'Vencimento',1,0,'L');
        $this->Cell(15,8,'Valor',1,0,'L');
        $this->Cell(15,8,'Situação',1,0,'L');
        $this->Ln();
    }

    function viewTable(){
        
        $this->SetFont('Arial', '', 7);
        $data_inicial = implode('-', array_reverse(explode('/', $_POST['data_inicial'])));
        $data_final =  implode('-', array_reverse(explode('/', $_POST['data_final'])));  
      
        $ipva = new ControllerIpva();
        $ipva->setSituacao($_POST['situacao']);
        $ipva->setIdVeiculo($_POST['veiculo']);
        $ipva->setDataInicial($data_inicial);
        $ipva->setDataFinal($data_final);
        $ipva = $ipva->listarTodos($ipva);

        foreach($ipva as $value) {

            $this->Cell(20,7, $value['id_ipva'],1,0,'L');
            $this->Cell(15,7,$value['placa'],1,0,'L');
            $this->Cell(20,7,date("d/m/Y", strtotime($value['data_vencimento'])),1,0,'L');
            $this->Cell(15,7,$value['valor'],1,0,'L');
            $this->Cell(15,7,$value['situacao'], 1, 0,'L');

            $this->Ln();
        }
        
    }
}

$pdf = new ReportIpva();
$pdf->AliasNbPages();
$pdf->AddPage('P','A4',0);
$pdf->headerTable();
$pdf->viewTable();
$pdf->Output();