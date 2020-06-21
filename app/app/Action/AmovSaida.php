<?php

namespace App\Action;

use Src\traits\TratarDados;

use App\controller\ControllerMovSaida;
use App\controller\ControllerMovEntrada;

abstract class AmovSaida
{
    use TratarDados;

    public function registrarAction()
    {
        if (isset($_POST)) {

            $motorista = trim($_POST['motorista']);
            $quantidade = TratarDados::tratarQuantidade($_POST['quantidade']);
            $tanque = trim($_POST['tanque']);
            $dataSaida = date("Y-d-m h:i:s", strtotime($_POST['data']));
            $veiculo = trim($_POST['veiculo']);
            $quilometragem = trim($_POST['quilometragem']);
        
        } else {
            die('Não há $_POST aqui ');
        }

        # Retorna a quantidade total de combustivel naquele tanque
        $retornoQtdTotalSaida = new ControllerMovSaida();
        $retornoQtdTotalSaida->setTanque($tanque);
        $totalCombustivelSaida = $retornoQtdTotalSaida->quantidadeTotalSaida($retornoQtdTotalSaida);
        
        foreach ($totalCombustivelSaida as $key => $value){
            $valorTotalCombustivelSaida = floatval($value['quantidade']);
        } 

        # Retorna a quantidade total de combustivel da entrada
        $retornoQtdTotalEntrada = new ControllerMovEntrada();
        $retornoQtdTotalEntrada->setTanque($tanque);
        $totalCombustivelEntrada = $retornoQtdTotalEntrada->quantidadeTotalEntrada($retornoQtdTotalEntrada);
        
        foreach ($totalCombustivelEntrada as $key => $value){
            $valorTotalCombustivelEntrada = floatval($value['quantidade']);
        } 
        
        # Retorna o comnbustivel disponivel no tanque - considerando as saidas de combustivel
        $valorAtualTanque = $valorTotalCombustivelEntrada - $valorTotalCombustivelSaida;
        
        # Verifica se a quantidade é menor ou igual a quantidade que o tanque tem atualmente de combustivel
        if ($quantidade <= $valorAtualTanque) {
            
            $init = new ControllerMovSaida();
            $init->setIdCliente($_SESSION['id_cliente']);
            $init->setMotorista($motorista);
            $init->setQuantidade($quantidade);
            $init->setTanque($tanque);
            $init->setDataSaida($dataSaida);
            $init->setVeiculo($veiculo);
            $init->setQuilometragem($quilometragem);

            $registrar = $init->cadastrar($init);

            if (isset($registrar)) {
                $_SESSION["mensagem"] = "registrado";
                header("Location: ".DIRPAGE."/movimento_saida/list");
            }
            
        } else {
            echo "O tanque selecionado não possui combustível suficiente para realizar o abastecimento. Favor adicionar no movimento de entrada";
        }
    }


     # Action excluir

     public function excluirAction($id)
     {
        $init = new ControllerMovSaida();
        $init->setId($id);
        # Valida se existe id com esse numero
        if (intval($id) != 0) {
            $retorno = $init->deletar($init);

            if (intval($retorno) == 1) {
                # Registro excluído com sucesso
                $_SESSION["mensagem"] = "registro_excluido";
                header("Location: ".DIRPAGE."/movimento_saida/list");
            } else {
                # Houve um erro ao tentar deletar o registro
                $_SESSION["mensagem"] = "erro_deletar";
                header("Location: ".DIRPAGE."/movimento_saida/list");
            }

        } else {
            # ID não informado ou inexistente
            $_SESSION["mensagem"] = "id_inexistente";
            header("Location: ".DIRPAGE."/movimento_saida/list");
        }
    } 
}