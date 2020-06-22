<?php

namespace App\Action;

use Src\traits\TratarDados;

use App\controller\ControllerManutencaoVeiculo;

abstract class AmanutencaoVeiculo
{
    use TratarDados;

    public function registrarAction()
    {
        if (isset($_POST)) {
            $fornecedor = trim($_POST['fornecedor']);
            $titulo = trim($_POST['titulo']);
            $data_vencimento = TratarDados::tratarData($_POST['data_vencimento']);
            $veiculo = trim($_POST['veiculo']);
            $valor = TratarDados::tratarValorLimite($_POST['valor']);
            $situacao_pagamento = trim($_POST['situacao_pagamento']);
            $tipo_manutencao = trim($_POST['tipo_manutencao']);
            $descricao = trim($_POST['descricao']);
            $condicacao_manutencao = trim($_POST['conservacao']);
        } else {
            die('Não há $_POST aqui ');
        }

        $init = new ControllerManutencaoVeiculo(); 
        $init->setIdCliente($_SESSION['id_cliente']);
        $init->setTitulo($titulo);
        $init->setFornecedor($fornecedor);
        $init->setVeiculo($veiculo);
        $init->setManutencaoTipo($tipo_manutencao);
        $init->setDataVencimento($data_vencimento);
        $init->setValor($valor);
        $init->setDescricao($descricao);
        $init->setSituacaoPagamento($situacao_pagamento);
        $init->setCondicaoManutencao($condicacao_manutencao);

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



