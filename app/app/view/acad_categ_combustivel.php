<?php

if($_POST){
  
  include_once("../controller/ControllerCatCombustivel.php");

  if(isset($_POST['name'])){
    $nome = trim($_POST['name']);
  } else {
    $nome = "";
  }

    $init = new ControllerCatCombustivel();  //Bao Usuario é a classe do controlador
    $init->setNome($nome);
    $cadastrar = $init->cadastrar($init);

    if($cadastrar){
      // 4 = Registro(s) excluído(s) com sucesso.
      header("Location: categoria_combustivel.php?status_cadastro=4");
    }else{
      // 5 = Erro ao tentar cadastrar
      header("Location: categoria_combustivel.php?status_cadastro=5");
    }
}
?>