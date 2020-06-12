<?php
namespace App\Action;

use App\controller\ControllerIpva;

abstract class Aipva
{ 
    public function excluirAction($id){
        
        $init = new ControllerIpva();
        $init->setId($id);
        # Valida se existe id com esse numero
        if (intval($id) != 0){
            $retorno = $init->deletar($init);
            if(intval($retorno) == 1){
                # Registro excluído com sucesso
                $_SESSION["mensagem"] = "registro_excluido";
                header("Location: ".DIRPAGE."/ipva/list");
            } else {
                # Houve um erro ao tentar deletar o registro
                $_SESSION["mensagem"] = "erro_deletar";
                header("Location: ".DIRPAGE."/ipva/list");
            }
        } else {
            # ID não informado ou inexistente
            $_SESSION["mensagem"] = "id_inexistente";
            header("Location: ".DIRPAGE."/ipva/list");
        }
    } 

    public function registrarAction()
    {
        if (isset($_POST)) {
            $id_veiculo = trim($_POST['veiculo']);
            $valor = trim($_POST['valor']);
            $data_vencimento = date('Y-m-d',strtotime($_POST['data_vencimento']));
            $situacao = trim($_POST['situacao']);
         
          } else {
            die("Faltam parâmetros POST");
        }

        $init = new ControllerIpva(); 
      
        $init->setIdCliente($_SESSION['id_cliente']);
        $init->setIdVeiculo($id_veiculo);
        $init->setDataVencimento($data_vencimento);
        $init->setValor($valor);
        $init->setSituacao($situacao);
        
        $cadastrar = $init->cadastrar($init);
        
        if (isset($cadastrar)) {
            $_SESSION["mensagem"] = "registrado";
            header("Location: ".DIRPAGE."/ipva/list");
        }
    }
    
    public function alterarAction($id){
     
    
    }
}