<?php
namespace App\Action;

use Src\traits\TratarDados;
use App\controller\ControllerMotorista;
use App\controller\ControllerUsuario;

abstract class Amotorista
{        
    use TratarDados;

    public function excluirAction($id){
    
        $init = new ControllerMotorista();
        $init->setId($id);
        # Valida se existe id com esse numero
        if (intval($id) != 0){
            $retorno = $init->deletar($init);
            if(intval($retorno) == 1){
                # Registro excluído com sucesso
                $_SESSION["mensagem"] = "registro_excluido";
                header("Location: ".DIRPAGE."/motorista/list");
            } else {
                # Houve um erro ao tentar deletar o registro
                $_SESSION["mensagem"] = "erro_deletar";
                header("Location: ".DIRPAGE."/motorista/list");
            }
        } else {
            # ID não informado ou inexistente
            $_SESSION["mensagem"] = "id_inexistente";
            header("Location: ".DIRPAGE."/motorista/list");
        }
    } 

    public function novoAction()
    {
        if (isset($_POST)) {
            $nome = trim($_POST['nome']);
            $cnh = trim($_POST['cnh']);
            $data_vencimento_cnh = TratarDados::tratarData($_POST['vencimento_cnh']);
            $cpf = trim($_POST['cpf']);
            $data_nascimento = TratarDados::tratarData($_POST['data_nascimento']);
            $email = trim($_POST['email']);
            $senha = md5($_POST['senha']);
          } else {
            die("Faltam parâmetros POST");
        }
      
        # CADASTRA usuário motorista com ID = 3 PARA ELE CONSULTAR ACESSO EXTERNO
        $u = new ControllerUsuario();  
        $u->setNome($nome);
        $u->setIdCliente($_SESSION['id_cliente']);
        $u->setEmail($email);
        $u->setPassword(md5($senha));
        $u->setIdAcesso(3);
        $cadastrar1 = $u->cadastrarInterno($u);
        
        $init = new ControllerMotorista(); 
        $init->setNome($nome);
        $init->setIdCliente($_SESSION['id_cliente']);
        $init->setCnh($cnh);
        $init->setDataVencimentoCnh($data_vencimento_cnh);
        $init->setCpf($cpf);
        $init->setDataNascimento($data_nascimento);
        
        $cadastrar2 = $init->cadastrar($init);
        
        if (isset($cadastrar2)) {
            $_SESSION["mensagem"] = "registrado";
            header("Location: ".DIRPAGE."/motorista/list");
        }
    }
    
    public function alterarAction($id)
    { 
        if (isset($_POST['nome_motorista'])) {
            $id = $id;
            $nome = trim($_POST['nome_motorista']);
            $cnh = trim($_POST['cnh']);
            $data_vencimento_cnh = trim($_POST['data_vencimento_cnh']);
            $cpf = trim($_POST['cpf']);
            $data_nascimento = trim($_POST['data_nascimento']);

        } 
        $d = new ControllerMotorista();  
        $d->setId($id);
        $d->setNome($nome);
        $d->setIdCliente($_SESSION['id_cliente']);
        $d->setCnh($cnh);
        $d->setDataVencimentoCnh($data_vencimento_cnh);
        $d->setCpf($cpf);
        $d->setDataNascimento($data_nascimento);
        $cadastrar = $d->atualizar($d);
            
        if(isset($cadastrar)){
            $_SESSION["mensagem"] = "editado_sucesso";
            header("Location: ".DIRPAGE."/motorista/list");        
        }
    }
}