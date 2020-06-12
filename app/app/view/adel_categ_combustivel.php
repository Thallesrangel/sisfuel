<?php
if($_GET){
  
  include_once("../controller/ControllerCatCombustivel.php");
  
  if(isset($_GET['id_combustivel'])){
    $id = trim($_GET['id_combustivel']);
  } else {
    $id = 0;
  }

  $init = new ControllerCatCombustivel();
  $init->setId($id);

  if (intval($id) != 0){
    $retorno = $init->deletar($init);
    if(intval($retorno) == 1){
      // status 1 = Cadastrado excluído com sucesso
      header("Location: categoria_combustivel.php?status_cadastro=1");
    } else {
      // status 2 = Houve um erro ao tentar deletar o registro
      header("Location: index.php?status_cadastro=2");
    }
  } else {
      // status 3 = ID não informado ou não existe
      header("Location: index.php?status_cadastro=3");
  } 
}
?>