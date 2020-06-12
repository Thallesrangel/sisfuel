<?php

namespace App\Action;

use App\controller\ControllerCatVeiculo;

abstract class AcategoriaVeiculo{

    public function excluirAction($id){
        
		$init = new ControllerCatVeiculo();
      $init->setId($id);
      # Valida se existe id com esse numero
      if (intval($id) != 0){
          $retorno = $init->deletar($init);
          if(intval($retorno) == 1){
            # Registro excluído com sucesso
            $_SESSION["mensagem"] = "registro_excluido";
            header("Location: ".$_SERVER['HTTP_REFERER']."");
      
          } else {
            # Houve um erro ao tentar deletar o registro
            $_SESSION["mensagem"] = "erro_deletar";
            header("Location: ".DIRPAGE."/categoria_veiculo/list");
          }
      } else {
          # ID não informado ou inexistente
          $_SESSION["mensagem"] = "id_inexistente";
          header("Location: ".DIRPAGE."/categoria_veiculo/list");
        } 
    } 

    public function novoAction() 
    {   
      if (isset($_POST['name'])) {
          $nome = trim($_POST['name']);
        } else {
          die("erro ao excluir tá?! Confere em Action/Afornecedor");
      }
     
      $init = new ControllerCatVeiculo();  
      $init->setNome($nome);
      $cadastrar = $init->cadastrar($init);
  
      if ($cadastrar) {
        $_SESSION["mensagem"] = "registrado";
        header("Location: ".DIRPAGE."/categoria_veiculo/list");
      } else {
          $_SESSION["mensagem"] = "erro_registrar";
          header("Location: ".DIRPAGE."/categoria_veiculo/list");       
      } 
    }
}