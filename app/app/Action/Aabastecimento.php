<?php

namespace App\Action;

use App\controller\ControllerAbastecimento;

abstract class Aabastecimento
{   

    public function excluirAction($id)
    {      
        $init = new ControllerAbastecimento();
        $init->setId($id);
        
        # Valida se existe id com esse numero
        if (intval($id) != 0){
            $retorno = $init->deletar($init);
            if(intval($retorno) == 1){
            # Registro excluído com sucesso
            $_SESSION["mensagem"] = "registro_excluido";
            header("Location: ".DIRPAGE."/abastecimento/list");
            } else {
            # Houve um erro ao tentar deletar o registro
            $_SESSION["mensagem"] = "erro_deletar";
            header("Location: ".DIRPAGE."/abastecimento/list");
            }
        } else {
            # ID não informado ou inexistente
            $_SESSION["mensagem"] = "id_inexistente";
            header("Location: ".DIRPAGE."/abastecimento/list");
        }
    }


    public function registrarAction()
    {
        if (isset($_POST)) {

            $fornecedor = trim($_POST['fornecedor']);
            $quantidade = floatval(trim($_POST['quantidade']));
            $dataAbastecimento = TratarDados::tratarDataHora($_POST['data']);
            $veiculo = trim($_POST['veiculo']);
            $comprovante = trim($_POST['comprovante']);
            $motorista = trim($_POST['motorista']);
            $quilometragem = trim($_POST['quilometragem']);
            //$valorUnitario = trim($_POST['valorUnitario']);
            $combustivel = trim($_POST['combustivel']);
        
        } else {
            die('Não há $_POST aqui.');
        }

        $init = new ControllerAbastecimento();
        $init->setFornecedor($fornecedor);
        $init->setIdCliente($_SESSION['id_cliente']);
        $init->setQuantidade($quantidade);
        $init->setDataAbastecimento($dataAbastecimento);
        $init->setVeiculo($veiculo);
        $init->setComprovante($comprovante);
        $init->setMotorista($motorista);
        $init->setQuilometragem($quilometragem);
        $init->setCombustivel($combustivel);
 
        $registrar = $init->cadastrar($init);

        if(isset($registrar)){
            $_SESSION["mensagem"] = "registrado";
            header("Location: ".DIRPAGE."/abastecimento/list");
        }
    
    }


    public function alterarAction($id)
    {
        if (isset($id)) {
            $id = $id;
            $fornecedor = trim($_POST['fornecedor']);
            $quantidade = trim($_POST['quantidade']);
            $data = trim($_POST['data']);
            $comprovante = trim($_POST['comprovante']);
            $km = trim($_POST['quilometragem']);
            $motorista = trim($_POST['motorista']);
            $combustivel = trim($_POST['combustivel']);
            $veiculo = trim($_POST['veiculo']);
        } 

        $init = new ControllerAbastecimento();
        $init->setId($id);
        $init->setFornecedor($fornecedor);
        $init->setIdCliente($_SESSION['id_cliente']);
        $init->setQuantidade($quantidade);
        $init->setDataAbastecimento($data);
        $init->setVeiculo($veiculo);
        $init->setComprovante($comprovante);
        $init->setMotorista($motorista);
        $init->setQuilometragem($km);
        $init->setCombustivel($combustivel);

        $cadastrar = $init->atualizar($init);
            
        if(isset($cadastrar)){
            $_SESSION["mensagem"] = "editado_sucesso";
            header("Location: ".DIRPAGE."/abastecimento/list");  
        }
    }
}