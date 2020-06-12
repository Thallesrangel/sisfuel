<?php

namespace App\Action;

use App\controller\ControllerManutencaoVeiculo;

abstract class AmanutencaoVeiculo{

    public function registrarAction()
    {
        if (isset($_POST)) {
            $fornecedor = trim($_POST['fornecedor']);
            $titulo = trim($_POST['titulo']);
            $data_vencimento = $_POST['data_vencimento'];
            $veiculo = trim($_POST['veiculo']);
            $valor = trim($_POST['valor']);
            $situacao_pagamento = trim($_POST['situacao_pagamento']);
            $tipo_manutencao = trim($_POST['tipo_manutencao']);
            $descricao = trim($_POST['descricao']);
        } else {
            die('Não há $_POST aqui ');
        }

        $init = new ControllerManutencaoVeiculo(); 
        $init->setIdCliente($_SESSION['id_usuario']);
        $init->setTitulo($titulo);
        $init->setFornecedor($fornecedor);
        $init->setVeiculo($veiculo);
        $init->setManutencaoTipo($tipo_manutencao);
        $init->setDataVencimento($data_vencimento);
        $init->setValor($valor);
        $init->setDescricao($descricao);
        $init->setSituacaoPagamento($situacao_pagamento);

        $cadastrar = $init->cadastrar($init);

        if ($cadastrar) {
            $_SESSION["mensagem"] = "registrado";
            header("Location: ".DIRPAGE."/manutencao/list");
        } else {
            $_SESSION["mensagem"] = "erro_registrar";
            header("Location: ".DIRPAGE."/manutencao/list");       
        } 
    }

}



