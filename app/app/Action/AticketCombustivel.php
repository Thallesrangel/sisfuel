<?php
namespace App\Action;

use App\controller\ControllerTicket;
use Src\traits\TratarDados;


abstract class AticketCombustivel
{   
    use TratarDados;

    public function excluirAction($id)
    {
        $init = new ControllerTicket();
        $init->setId($id);
        # Valida se existe id com esse numero
        if (intval($id) != 0){
            $retorno = $init->deletar($init);
            if(intval($retorno) == 1){
                # Registro excluído com sucesso
                $_SESSION["mensagem"] = "registro_excluido";
                header("Location: ".DIRPAGE."/ticket/list");
            } else {
                # Houve um erro ao tentar deletar o registro
                $_SESSION["mensagem"] = "erro_deletar";
                header("Location: ".DIRPAGE."/ticket/list");
            }
        } else {
            # ID não informado ou inexistente
            $_SESSION["mensagem"] = "id_inexistente";
            header("Location: ".DIRPAGE."/ticket/list");
        }
    } 
    
    public function registrarAction()
    {    
        if (isset($_POST)){

            $fornecedor = trim($_POST['fornecedor']);
            $quantidade = TratarDados::tratarQuantidade($_POST['quantidade']);
            $combustivel = trim($_POST['combustivel']);
            $dataEntrada = trim($_POST['data']);
            $motorista = trim($_POST['motorista']);
            $veiculo = trim($_POST['veiculo']);
            
            } else {
                die("Faltam parâmetros POST");
            }

            $init = new ControllerTicket();
            $init->setIdCliente($_SESSION['id_cliente']);
            $init->setFornecedor($fornecedor);
            $init->setQuantidade($quantidade);
            $init->setDataEntrada($dataEntrada);
            $init->setMotorista($motorista);
            $init->setCombustivel($combustivel);
            $init->setVeiculo($veiculo);
            $registrar = $init->cadastrar($init);
            
            if(isset($registrar)){
                $_SESSION["mensagem"] = "registrado";
                header("Location: ".DIRPAGE."/ticket/list");
            } else {
                $_SESSION["mensagem"] = "erro";
                header("Location: ".DIRPAGE."/ticket/list");
        }
    }
}
