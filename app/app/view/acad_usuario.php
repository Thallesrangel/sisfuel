<?php
session_start();
if($_POST){
  
  include_once("../controller/ControllerUsuario.php");

  if(isset($_POST['nome'])){
    $nome = trim($_POST['nome']);
    $email = trim($_POST['email']);
    $senha = trim($_POST['senha']);
    $id_acesso =trim($_POST['id_acesso']);

  } else {
    die('NÃO HÁ ALGUM POST');
  }
  
  # CASO SEJA USUÁRIO POST INTERNO TERÁ ESSE ID_ACESSO
  if (isset($_POST['id_acesso'])) {
      
    $init = new ControllerUsuario(); 
    $init->setNome($nome);
    $init->setIdCliente($_SESSION['id_cliente']);
    $init->setEmail($email);
    $init->setPassword($senha);
    $init->setIdAcesso($id_acesso);
    $cadastrar = $init->cadastrarInterno($init);

  } else {
    # CASO SEJA USUÁRIO EXTERNO - NOVO CLIENTE
    $init = new ControllerUsuario(); 
    $init->setNome($nome);
    $init->setEmail($email);
    $init->setPassword($senha);
    $cadastrar = $init->cadastrarExterno($init);
  }
    if($cadastrar){
    
      header("Location: index.php?status_cadastro=4");
    }else{
      
      header("Location: index.php?status_cadastro=5");
    }
    
}
?>