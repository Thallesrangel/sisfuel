<?php

namespace App\Action;

use App\controller\ControllerCliente;
use App\controller\ControllerUsuario;


abstract class Acliente
{

    public function registrarAction()
    {
      if (isset($_POST)) {
        $id_plano = trim($_POST['plano']);
        $id_tipo_cliente = trim($_POST['id_tipo_cliente']);
        $flag_tanque = trim($_POST['flag_tanque']);

        $razao_social = trim($_POST['razao_social']);
        $nome_usuario = trim($_POST['nome_usuario']);
        $email = trim($_POST['email']);
        $senha = trim($_POST['senha']);
        $documento = trim($_POST['documento']);
        $endereco = trim($_POST['endereco']);
      
      } else {
        die('não há post');
      } 
    
      # Retorna o ultimo ID do cliente inserido
      $initCliente = new ControllerCliente(); 
      $initCliente->setPlano($id_plano); 
      $initCliente->setTipoCliente($id_tipo_cliente); 
      $initCliente->setEmail($email);
      if ($id_tipo_cliente == 1) {
        $initCliente->setNome($razao_social);
      } else {
        $initCliente->setNome($nome_usuario);
      }
      $initCliente->setDocumento($documento);
      $initCliente->setFlagTanque($flag_tanque); 
      $idClienteRetornado = $initCliente->cadastrar($initCliente);

  
      # Cadastrar usuário administrador padrão
      $init = new ControllerUsuario();  
      $init->setNome($nome_usuario);
      $init->setIdCliente($idClienteRetornado);
      $init->setEmail($email);
      $init->setPassword(md5($senha));
      $cadastrar = $init->cadastrarExterno($init);
  
      if(isset($cadastrar)){
          header("Location: ".DIRPAGE."/login");
      }
    }
}