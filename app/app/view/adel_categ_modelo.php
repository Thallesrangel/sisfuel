<?php

  session_start();
  
if ($_GET) {
  
  include_once("../controller/ControllerCatModelo.php");
  
  if(isset($_GET['id_modelo'])){
    $id = trim($_GET['id_modelo']);
  } else {
    $id = 0;
  }

  $init = new ControllerCatModelo();
  $init->setId($id);

  if (intval($id) != 0){
    $retorno = $init->deletar($init);
    if(intval($retorno) == 1){
      # Registro excluído com sucesso
      $_SESSION["mensagem"] = "registro_excluido";
      header("Location: categoria_modelo.php");
    } else {
      # Houve um erro ao tentar deletar o registro
      $_SESSION["mensagem"] = "erro_deletar";
      header("Location: index.php");
    }
  } else {
      # ID não informado ou não existe
      $_SESSION["mensagem"] = "id_inexistente";
      header("Location: index.php");
  } 
}
?>