<?php

namespace App\Action;

use App\controller\ControllerSuporte;


abstract class Asuporte
{

    public function registrarAction()
    {
        if (isset($_POST['descricao'])) {
            $requerente = $_SESSION['id_usuario'];
            $titulo = trim($_POST['titulo']);
            $descricao = trim($_POST['descricao']);
            
            
        } else {
            die('Não há $_POST aqui ');
        }

        $init = new ControllerSuporte(); 
        $init->setIdCliente($_SESSION['id_usuario']);
        $init->setRequerente($requerente);
        $init->setTitulo($titulo);
        $init->setDescricao($descricao);

        $cadastrar = $init->cadastrar($init);

        if(isset($cadastrar)){
            $_SESSION["mensagem"] = "registrado";   
            header("Location: ".DIRPAGE."/suporte/");
        }
    }


     # Action excluir

     public function excluirAction($id)
     {
        $init = new ControllerSuporte();
        $init->setId($id);
        # Valida se existe id com esse numero
        if (intval($id) != 0){
            $retorno = $init->deletar($init);
            if(intval($retorno) == 1){
                # Registro excluído com sucesso
                $_SESSION["mensagem"] = "registro_excluido";
                header("Location: ".DIRPAGE."/suporte/");
            } else {
                # Houve um erro ao tentar deletar o registro
                $_SESSION["mensagem"] = "erro_deletar";
                header("Location: ".DIRPAGE."/suporte/");
            }
        } else {
            # ID não informado ou inexistente
            $_SESSION["mensagem"] = "id_inexistente";
            header("Location: ".DIRPAGE."/suporte/");
        }
    }
}