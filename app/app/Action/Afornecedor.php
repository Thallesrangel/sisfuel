<?php

namespace App\Action;

use App\controller\ControllerFornecedor;

abstract class Afornecedor{

    public function excluirAction($id)
    {    
		$init = new ControllerFornecedor();
        $init->setId($id);
        # Valida se existe id com esse numero
        if (intval($id) != 0) {
            $retorno = $init->deletar($init);
            return $retorno;
        } else {
            die("erro ao excluir tá?! Confere em Action/Afornecedor");
        } 
    } 

    public function novoAction()
    {
        if (isset($_POST['razaosocial'])) {
            $razaoSocial = trim($_POST['razaosocial']);
            $remover = array(".","/","-","*","");
            $cnpj = (int) str_replace($remover, "", $_POST['cnpj']);
            $areaAtuacao = trim($_POST['area_atuacao']);
        } else {
            die("erro ao excluir tá?! Confere em Action/Afornecedor");
        }
     
        $init = new ControllerFornecedor();
        $init->setNome($razaoSocial);
        $init->setIdCliente($_SESSION['id_cliente']);
        $init->setCnpj($cnpj);
        $init->setAreaAtuacao($areaAtuacao);
        $cadastrar = $init->cadastrar($init);

        return $cadastrar;
    }
}