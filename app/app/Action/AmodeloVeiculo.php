<?php

namespace App\Action;

use App\controller\ControllerModeloVeiculo;

abstract class AmodeloVeiculo{

    public function excluirAction($id){
        
		$init = new ControllerModeloVeiculo();
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
            header("Location: ".DIRPAGE."/modelo-veiculo/list");
          }
      } else {
          # ID não informado ou inexistente
          $_SESSION["mensagem"] = "id_inexistente";
          header("Location: ".DIRPAGE."/modelo-veiculo/list");
        } 
    } 

    public function registrarAction() 
    {   
      if (isset($_POST)) {
          $fabricante = trim($_POST['fabricante']);
          $modelo = trim($_POST['modelo']);
        } else {
          die("erro ao excluir tá?! Confere em Action/Afornecedor");
      }
     
      $init = new ControllerModeloVeiculo();  
      $init->setIdCliente($_SESSION['id_cliente']);
      $init->setModelo($modelo);
      $init->setFabricante($fabricante);
      $cadastrar = $init->cadastrar($init);
  
      if ($cadastrar) {
        $_SESSION["mensagem"] = "registrado";
        header("Location: ".DIRPAGE."/modelo-veiculo/list");
      } else {
          $_SESSION["mensagem"] = "erro_registrar";
          header("Location: ".DIRPAGE."/modelo-veiculo/list");       
      } 
    }
}