<?php

  session_start();

if ($_POST) {
  if(isset($_POST['name'])){
    $nome = trim($_POST['name']);
  } else {
    $nome = "";
  }

    $init = new ControllerCatModelo(); 
    $init->setNome($nome);
    $cadastrar = $init->cadastrar($init);

    if ($cadastrar) {

      $_SESSION["mensagem"] = "registrado";
      header("Location: categoria_modelo.php");

    } else {

      $_SESSION["mensagem"] = "erro_registrar";
      header("Location: categoria_modelo.php");

    }
}