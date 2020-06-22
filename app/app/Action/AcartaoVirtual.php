<?php

namespace App\Action;

use Src\traits\TratarDados;
use App\controller\ControllerCartaoVirtual;

abstract class AcartaoVirtual
{   
  use TratarDados;
  public function excluirAction($id){
      
    $init = new ControllerCartaoVirtual();
      $init->setId($id);
      # Valida se existe id com esse numero
      if (intval($id) != 0){
        $retorno = $init->deletar($init);
        if(intval($retorno) == 1){
          # Registro excluído com sucesso
          $_SESSION["mensagem"] = "registro_excluido";
          header("Location: ".$_SERVER['HTTP_REFERER']."");
        } else {
          # Houve um erro ao tentar deletar o registro
          $_SESSION["mensagem"] = "erro_deletar";
          header("Location: ".DIRPAGE."/cartao_virtual/list");
        }
      } else {
        # ID não informado ou inexistente
        $_SESSION["mensagem"] = "id_inexistente";
        header("Location: ".DIRPAGE."/cartao_virtual/list");
      } 
  } 

  public function registrarAction()
  {
    if (isset($_POST)) {
      $id_motorista = trim($_POST['motorista']);
      $data_validade = TratarDados::tratarData($_POST['data_validade']);
      $valor_limite = TratarDados::tratarValorLimite($_POST['valor_limite']);
      $situacao = trim($_POST['situacao']);
      $renovacao_automatica = trim($_POST['renovacao_automatica']);
      } else {
      die("Faltam dados no POST");
    }
  
      $init = new ControllerCartaoVirtual(); 
      $init->setIdCliente($_SESSION['id_cliente']);
      $init->setIdUsuario($_SESSION['id_usuario']);
      $init->setValorLimite($valor_limite);
      $init->setDataValidade($data_validade);
      $init->setMotorista($id_motorista);
      $init->setIdSituacao($situacao);
      $init->setIdRenovacao($renovacao_automatica);

      $cadastrar = $init->cadastrar($init);
      
      if (isset($cadastrar)) {
        $_SESSION["mensagem"] = "registrado";
        header("Location: ".DIRPAGE."/cartao-virtual/list");
      }
    }
}