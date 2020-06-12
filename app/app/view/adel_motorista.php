<?php
if($_GET){
  
  include_once("../controller/ControllerMotorista.php");
  
  if(isset($_GET['id_motorista'])){
    $id = trim($_GET['id_motorista']);
  } else {
    $id = 0;
  }

  $init = new ControllerMotorista();
  $init->setId($id);

  if (intval($id) != 0){
    $retorno = $init->deletar($init);
    if(intval($retorno) == 1){
      // status 1 = Cadastrado excluído com sucesso
      header("Location: motorista.php?status_cadastro=1");
    } else {
      // status 2 = Houve um erro ao tentar deletar o registro
      header("Location: motorista.php?status_cadastro=2");
    }
  } else {
      // status 3 = ID não informado ou não existe
      header("Location: motorista.php?status_cadastro=3");
  } 
}
?>