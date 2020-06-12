<?php

namespace App\Report;
use App\fpdf\fpdf;
use App\controller\ControllerTicket;
use App\model\Conexao;

  
class ReportGerarTicket extends FPDF{

    public function gerarTicket(int $idTicket){

     
        $pdo = Conexao::getConn();
        $sql = "SELECT *, b.*,d.*, e.nome_motorista, f.* FROM tbticket a
                    INNER JOIN tbfornecedor b ON (b.id_fornecedor = a.id_fornecedor)
                    INNER JOIN tbveiculo c ON (c.id_veiculo = a.id_veiculo)
                    INNER JOIN tbcategoria_combustivel d ON (d.id_combustivel = a.id_combustivel)
                    INNER JOIN tbmotorista e ON (e.id_motorista = a.id_motorista)
                    INNER JOIN tbclientes f ON (f.id_cliente = a.id_cliente)
            WHERE id_ticket = '$idTicket'";

        $resultado = $pdo->query($sql);



        $pdf= new FPDF("P","pt","A4");

        $pdf->AddPage();
       
        $pdf->SetTitle("Sisvel - Ticket de Abastecimento");
        $pdf->SetFont('arial','',13);
        $pdf->SetY(40);
        $pdf->Image(DIRIMG."/logo.png",10,6);


        $pdf->SetY(20);
        $pdf->SetX(200);
        $pdf->SetFont('arial','',13);
        $pdf->Cell(0,20,"Ticket de Abastecimento",0,1,'L');


        if($resultado != ""){
            foreach ($resultado as $key => $value) {
                $pdf->SetX(45);
                $pdf->SetFont('arial','',9);
                $pdf->Cell(0,20,"",0,1,'L');


                $pdf->SetXY(30,50);
                $pdf->Cell(0,20,'Empresa '. $_SESSION['razao_social_cliente'],0,1,'L');

                $pdf->SetXY(340,50);
                $pdf->Cell(0,20,'Combustível '. $value['categoria_combustivel'],0,1,'L');

                $pdf->SetXY(30,70);
                $pdf->Cell(0,20,'Protocolo: ' . $value['id_ticket'],0,1,'L');
                $pdf->SetXY(130,70);
                $pdf->Cell(0,20,'Motorista: ' . $value['nome_motorista'],0,1,'L');
                $pdf->SetXY(340,70);
                $pdf->Cell(0,20,'Fornecedor: ' . $value['razao_social'],0,1,'L');
                $pdf->SetXY(30,90);
                $pdf->Cell(0,20,'Veículo: ' . $value['placa'],0,1,'L');
                $pdf->SetXY(130,90);
                $pdf->Cell(0,20,'Quantidade: ' . $value['quantidade'] . ' (L)',0,1,'L');
                $pdf->SetXY(340,90);
                $pdf->Cell(0,20,'Data da Requisição: ' . date("d/m/Y", strtotime($value['data_entrada'])),0,1,'L');
                $pdf->SetXY(30,110);
                $pdf->Cell(0,20,'Validação: www.sisfuel.com.br/validacao/' . $value['id_ticket'],0,1,'L');
            }
        }
        $pdf->Cell(0,10,"",0,1,'L');

        $pdf->SetFont('arial','B',8);
        $pdf->Cell(0,13,"Emissor: ".$_SESSION['nome_usuario'],0,1,'L');
        $pdf->Cell(0,13,"Emitido em: ".date("d/m/Y H:i:s"),0,1,'L');
        $pdf->SetFont('arial','',8);
        $pdf->SetXY(260,130);
        $pdf->Cell(0,20,'___________________________',0,1,'L');
        $pdf->SetXY(270,140);
        $pdf->Cell(0,20,'Assinatura/Carimbo emitente',0,1,'L');

        $pdf->SetXY(420,130);
        $pdf->Cell(0,20,'___________________________',0,1,'L');
        $pdf->SetXY(440,140);
        $pdf->Cell(0,20,'Assinatura Motorista',0,1,'L');
        $pdf->SetY(180);
        $pdf->SetFont('arial','',8);
        $pdf->Cell(0,10,'------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------');
        $pdf->Output("arquivo.pdf","I");
    }
}