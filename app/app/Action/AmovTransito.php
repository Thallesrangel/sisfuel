<?php

namespace App\Action;

use Src\traits\TratarDados;
use App\controller\ControllerMovTransito;

abstract class AmovTransito
{   
    use TratarDados;

    public function excluirAction($id)
    {      
        $init = new ControllerMovTransito();
        $init->setId($id);
        
        # Valida se existe id com esse numero
        if (intval($id) != 0){
            $retorno = $init->deletar($init);
            if(intval($retorno) == 1){
            # Registro excluído com sucesso
            $_SESSION["mensagem"] = "registro_excluido";
            header("Location: ".DIRPAGE."//movimento-transito/list");
            } else {
            # Houve um erro ao tentar deletar o registro
            $_SESSION["mensagem"] = "erro_deletar";
            header("Location: ".DIRPAGE."//movimento-transito/list");
            }
        } else {
            # ID não informado ou inexistente
            $_SESSION["mensagem"] = "id_inexistente";
            header("Location: ".DIRPAGE."//movimento-transito/list");
        }
    }


    public function registrarAction()
    {
        if (isset($_POST)) {
            $fornecedor = trim($_POST['fornecedor']);
            $quantidade = TratarDados::tratarQuantidade($_POST['quantidade']);
            $data_abastecimento = TratarDados::tratarDataHora($_POST['data']);
            $comprovante = trim($_POST['comprovante']);
            $quilometragem = TratarDados::tratarQuantidade($_POST['quilometragem']);
            $motorista = trim($_POST['motorista']);
            $combustivel = trim($_POST['combustivel']);
            $veiculo = trim($_POST['veiculo']);
            $valor_unitario  = TratarDados::tratarValorUnitario($_POST['valor_unitario']);
            $valor_total = doubleval($valor_unitario * $quantidade);    
        } else {
            die('Não há $_POST aqui.');
        }

        $init = new ControllerMovTransito();
        $init->setIdCliente($_SESSION['id_cliente']);
        $init->setFornecedor($fornecedor);
        $init->setQuantidade($quantidade);
        $init->setDataTransito($data_abastecimento);
        $init->setComprovante($comprovante);
        $init->setQuilometragem($quilometragem);
        $init->setMotorista($motorista);
        $init->setTipoCombustivel($combustivel);
        $init->setVeiculo($veiculo);       
        $init->setValorUnitario($valor_unitario);
        $init->setValorTotal($valor_total);
 
        $registrar = $init->cadastrar($init);

        if(isset($registrar)){
            $_SESSION["mensagem"] = "registrado";
            header("Location: ".DIRPAGE."/movimento-transito/list");
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
            header("Location: ".DIRPAGE."//movimento-transito/list");  
        }
    }
}