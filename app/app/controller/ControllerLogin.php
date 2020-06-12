<?php
namespace App\controller;

session_start();

use Src\classes\ClassRender;
use App\model\ClsUsuario;

class ControllerLogin extends ClsUsuario
{   
    public function __construct()
    {   
        ob_start ();
        if(isset($_SESSION['id_usuario']))	{
            Header("Location: ".DIRPAGE);
        }
        $render = new ClassRender();
        $render->setTitle("Sisfuel App");
        $render->setDescription("Sisfuel");
        $render->setKeyWords("sisfuel");
        $render->setDir("login");
        $render->renderLayout();
    }
 
    # Metodo responsavel por receber as variaveis
    public function logar(){
       
        if (isset($_POST['email']) && !empty($_POST['email'])) {
            $emailPost = trim($_POST['email']);
            $senhaPost = trim($_POST['senha']);
        } 

        $init = new ControllerUsuario();
        $init->setEmail($emailPost);
        $resultado = $init->buscarUsuario($init);
        $id_usuario = $resultado['id_usuario'];
        $email = $resultado['email'];
        $senha = $resultado['senha'];
        $nivel_acesso = $resultado['id_acesso'];
        condição ? codigoUm : codigoDois;
        $permissoes = isset($resultado['permissoes']) ? unserialize($resultado['permissoes']) : (array) 0;

    
        if (!empty($email)) {
  
            if($senha == md5($senhaPost)){
                $_SESSION['id_usuario'] = $resultado['id_usuario'];
                $_SESSION['nome_usuario'] = $resultado['nome_usuario'];
                $_SESSION['razao_social_cliente'] = $resultado['razao_social_cliente'];
                $_SESSION['id_cliente'] = $resultado['id_cliente'];
                $_SESSION['nivel'] = $resultado['id_acesso'];
                # 1 - Empresarial || 2 - Pessoal
                $_SESSION['id_tipo'] = $resultado['id_tipo']; #tbclientes_tipo
                $_SESSION['flag_tanque'] = $resultado['flag_tanque'];
                $_SESSION['permissoes'] =  $permissoes;
                
                # Se for MOTORISTA só acessa externo
                if ( $_SESSION['nivel'] == 3) { 
                    header("Location:".DIRPAGE."/cartao-virtual/externo/".$_SESSION['id_usuario']);
                } else {
                    header("Location:".DIRPAGE."/");
                }
           
            } else {
                $_SESSION["mensagem"] = "email_senha_incorreto";
                header("Location:".DIRPAGE."/login");
            }
        }
    }
}