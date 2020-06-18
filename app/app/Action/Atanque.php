<?php
namespace App\Action;

use App\controller\ControllerTanque;

use Src\traits\TratarDados;

# Usado para calcular quantidade de combustível disponível nos tanques
use App\controller\ControllerMovEntrada;
use App\controller\ControllerMovSaida;

abstract class Atanque
{
  use TratarDados;
  
  public function excluirAction($id)
  {        
    $init = new ControllerTanque();
    $init->setId($id);
    
    # Valida se existe id com esse numero
    if (intval($id) != 0){
      $retorno = $init->deletar($init);
      if(intval($retorno) == 1){
        # Registro excluído com sucesso
        $_SESSION["mensagem"] = "registro_excluido";
        header("Location: ".DIRPAGE."/tanque/list");
      } else {
        # Houve um erro ao tentar deletar o registro
        $_SESSION["mensagem"] = "erro_deletar";
        header("Location: ".DIRPAGE."/tanque/list");
      }
    } else {
      # ID não informado ou inexistente
      $_SESSION["mensagem"] = "id_inexistente";
      header("Location: ".DIRPAGE."/tanque/list");
    }
  }

  public function novoAction()
  {
    if (isset($_POST)) {
      $nomeTanque = trim($_POST['tanque']);
      $capacidade = TratarDados::tratarCapacidade($_POST['capacidade']);
      $limite = TratarDados::tratarPorcentagem($_POST['limite']);
      var_dump($limite);
      $tipocombustivel = trim($_POST['tipoCombustivel']);
      $idUnidadeMedida = trim($_POST['id_medida']);
    } else {
      die("Faltam parâmetros POST");
    }
    
    $init = new ControllerTanque();
    $init->setNome($nomeTanque);
    $init->setIdCliente($_SESSION['id_cliente']);
    $init->setCapacidade($capacidade);
    $init->setLimite($limite);
    $init->setCombustivel($tipocombustivel);
    $init->setUnidadeMedida($idUnidadeMedida);
    $cadastrar = $init->cadastrar($init);

    if(isset($cadastrar)){
      $_SESSION["mensagem"] = "registrado";
      header("Location: ".DIRPAGE."/tanque/list");
    }
  }

  # Método para calcular quantidade de combustível disponível no tanque
  public function qtdCombustivelDisponivel(int $IdTanque)
  {  
    # Retorna a quantidade total de combustivel naquele tanque
    $retornoQtdTotalSaida = new ControllerMovSaida();
    $retornoQtdTotalSaida->setTanque($IdTanque);
    $totalCombustivelSaida = $retornoQtdTotalSaida->quantidadeTotalSaida($retornoQtdTotalSaida);
    
    foreach ($totalCombustivelSaida as $key => $value) {
      $valorTotalCombustivelSaida = number_format($value['quantidade'], 2, '.', '');
    } 

    # Retorna a quantidade total de combustivel da entrada
    $retornoQtdTotalEntrada = new ControllerMovEntrada();
    $retornoQtdTotalEntrada->setTanque($IdTanque);
    $totalCombustivelEntrada = $retornoQtdTotalEntrada->quantidadeTotalEntrada($retornoQtdTotalEntrada);
    

    foreach ($totalCombustivelEntrada as $key => $value) {
      $valorTotalCombustivelEntrada = number_format($value['quantidade'], 2, '.', '');
    } 
   
    # Retorna o comnbustivel disponivel no tanque - considerando as saidas de combustivel
    $valorAtualTanque = $valorTotalCombustivelEntrada - $valorTotalCombustivelSaida;
    
    if($valorAtualTanque < 0) {
      # Quando se tem mais movimento_saida do que de entrada
      $_SESSION["mensagem"] = "combustivel_faltando";
    } 
   
    return number_format($valorAtualTanque, 2, '.', '');
  }
}