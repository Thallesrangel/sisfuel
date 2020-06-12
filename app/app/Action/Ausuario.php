<?php
namespace App\Action;

use App\controller\ControllerUsuario;


abstract class Ausuario
{
    public function registrarUsuarioInterno(){
    $nome_usuario = trim($_POST['nome']);
    $email = trim($_POST['email']);
    $senha = trim($_POST['senha']);
    $acesso = trim($_POST['id_acesso']);
    $permissoes = serialize($_POST['permissoes']);
    
      $init = new ControllerUsuario();  
      $init->setNome($nome_usuario);
      $init->setIdCliente($_SESSION['id_cliente']);
      $init->setEmail($email);
      $init->setPassword(md5($senha));
      $init->setIdAcesso($acesso);
      $init->setPermissoes($permissoes);
      $cadastrar = $init->cadastrarInterno($init);

      if (isset($cadastrar)) {
        header("Location: ".DIRPAGE."/usuario/list");
      }
    }
}
