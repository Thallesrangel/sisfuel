<?php

namespace App\Action;

use App\controller\ControllerSeguro;


abstract class Aseguro
{

    public function excluirAction($id)
    {      
        $init = new ControllerSeguro();
        $init->setId($id);
        
        # Valida se existe id com esse numero
        if (intval($id) != 0){
            $retorno = $init->deletar($init);
            if(intval($retorno) == 1){
            # Registro excluído com sucesso
            $_SESSION["mensagem"] = "registro_excluido";
            header("Location: ".DIRPAGE."/seguro/list");
            } else {
            # Houve um erro ao tentar deletar o registro
            $_SESSION["mensagem"] = "erro_deletar";
            header("Location: ".DIRPAGE."/seguro/list");
            }
        } else {
            # ID não informado ou inexistente
            $_SESSION["mensagem"] = "id_inexistente";
            header("Location: ".DIRPAGE."/seguro/list");
        }
    }

    public function registrarAction()
    {
        if (isset($_POST)) {
           
            $apolice = trim($_POST['apolice']);  
            $veiculo = trim($_POST['veiculo']);
            $data_vencimento = trim($_POST['data_vencimento']);
            $valor = trim($_POST['valor']);
            $situacao = trim($_POST['situacao']);         
            $fornecedor = trim($_POST['fornecedor']);
        } else {
            die('Não há $_POST aqui ');
        }

        $d = new ControllerSeguro(); 
        $d->setIdCliente($_SESSION['id_cliente']);
        $d->setApolice($apolice);
        $d->setVeiculo($veiculo);
        $d->setDataVencimento($data_vencimento);
        $d->setValor($valor);
        $d->setSituacao($situacao);
        $d->setFornecedor($fornecedor);

        $retorno = $d->cadastrar($d);

        if(isset($retorno)){
            $_SESSION["mensagem"] = "registrado";
            header("Location: ".DIRPAGE."/seguro/list");
        }
    }
}
