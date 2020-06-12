<?php
if($_GET){
  
  include_once("../controller/ControllerUsuario.php");
  
  if(isset($_GET['id_usuario'])){
    $id = trim($_GET['id_usuario']);
  } else {
    $id = 0;
  }

  $init = new ControllerUsuario();
  $init->setId($id);

  if (intval($id) != 0){
    $retorno = $init->deletar($init);
    if(intval($retorno) == 1){
      // status 1 = Cadastrado excluído com sucesso
      header("Location: acessos.php?status_cadastro=1");
    } else {
      // status 2 = Houve um erro ao tentar deletar o registro
      header("Location: acessos.php?status_cadastro=2");
    }
  } else {
      // status 3 = ID não informado ou não existe
      header("Location: acessos.php?status_cadastro=3");
  } 
}
?>