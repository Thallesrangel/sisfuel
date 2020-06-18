<?php

namespace App\Action;

use Src\traits\TratarDados;

use App\controller\ControllerMovEntrada;
use App\controller\ControllerMovSaida;
use App\controller\ControllerTanque;

abstract class AmovEntrada
{
    use TratarDados;

    public function registrarAction()
    {    
        if (isset($_POST)) {
            $fornecedor = trim($_POST['fornecedor']);
            $quantidade = TratarDados::tratarQuantidade($_POST['quantidade']);
            $tanque = trim($_POST['tanque']);
            $dataEntrada = date("Y-m-d H:i",strtotime($_POST['data']));
            $notaFiscal = trim($_POST['nf']);
            $motorista = trim($_POST['motorista']);
            $placa = trim($_POST['placa']);
            $valor_unitario = TratarDados::tratarValorUnitario($_POST['valor_unitario']);
          } else {
            die("Faltam parâmetros POST");
        }

        # Pega a capacidade do tanque de combustivel no array correspondente ao tanque selecionado
        $init = new ControllerTanque();
        $init->setId($tanque);
        $resultados = $init->capacidadeCombustivelPorTanque($init);

        foreach ($resultados as $key => $value) {
            $capacidade = floatval($value['capacidade']);
        } 

        # Retorna a quantidade total de combustivel naquele tanque
        $retornoQtdTotal = new ControllerMovEntrada();
        $retornoQtdTotal->setTanque($tanque);
        $totalCombustivel = $retornoQtdTotal->quantidadeTotalEntrada($retornoQtdTotal);

        foreach ($totalCombustivel as $key => $value) {
            $valorCombustivelEntrada = floatval($value['quantidade']);
        } 

        # Retorna a quantidade de combustivel total da saida
        $retornoSaida = new ControllerMovSaida();
        $retornoSaida->setTanque($tanque);
        $totalCombustivelSaida = $retornoSaida->quantidadeTotalSaida($retornoSaida);

        foreach ($totalCombustivelSaida as $key => $value) {
            $valorCombustivelSaida = floatval($value['quantidade']);
        } 

        $totalAtual =  $valorCombustivelEntrada - $valorCombustivelSaida;

        if ($totalAtual+$quantidade <= $capacidade) {
        
            # Adicionando ao movimento de entrada
            $init = new ControllerMovEntrada();
            $init->setIdCliente($_SESSION['id_cliente']);
            $init->setFornecedor($fornecedor);
            $init->setQuantidade($quantidade);
            $init->setTanque($tanque);
            $init->setDataEntrada($dataEntrada);
            $init->setNotaFiscal($notaFiscal);
            $init->setMotorista($motorista);
            $init->setPlaca($placa);
            $init->setValorUnitario($valor_unitario);

            # Multiplica o valor unitario pela quantidade de combustivel para chegar ao valor total
            $valor_total = $valor_unitario * $quantidade;

            $init->setValorTotal($valor_total);
            $registrar = $init->cadastrar($init);

            if (isset($registrar)) {
                $_SESSION["mensagem"] = "registrado";
                header("Location: ".DIRPAGE."/movimento_entrada/list");
            }
        } else {
            echo "O tanque selecionado atingiu a capacidade máxima.";
        }
    }


    # Action excluir

    public function excluirAction($id)
    {
        $init = new ControllerMovEntrada();
        $init->setId($id);
        # Valida se existe id com esse numero
        if (intval($id) != 0) {
            $retorno = $init->deletar($init);
            if (intval($retorno) == 1) {
                # Registro excluído com sucesso
                $_SESSION["mensagem"] = "registro_excluido";
                header("Location: ".DIRPAGE."/movimento_entrada/list");
            } else {
                # Houve um erro ao tentar deletar o registro
                $_SESSION["mensagem"] = "erro_deletar";
                header("Location: ".DIRPAGE."/movimento_entrada/list");
            }
        } else {
            # ID não informado ou inexistente
            $_SESSION["mensagem"] = "id_inexistente";
            header("Location: ".DIRPAGE."/movimento_entrada/list");
        }
    }
    
    public function alterarAction($id)
    {
        if (isset($id)) {
            $id = $id;
            $fornecedor = trim($_POST['fornecedor']);
            $quantidade = trim($_POST['quantidade']);
            $tanque = trim($_POST['tanque']);            
            $data_entrada = date("Y-m-d H:i",strtotime($_POST['data']));
            $nota_fiscal = trim($_POST['nf']);
            $motorista = trim($_POST['motorista']);
            $placa = trim($_POST['placa']);
            $valor_unitario = trim($_POST['valor_unitario']);            
        } 
        
        $init = new ControllerMovEntrada();
        $init->setId($id);
        $init->setIdCliente($_SESSION['id_cliente']);
        $init->setFornecedor($fornecedor);
        $init->setQuantidade($quantidade);
        $init->setTanque($tanque);
        $init->setDataEntrada($data_entrada);
        $init->setNotaFiscal($nota_fiscal);
        $init->setMotorista($motorista);
        $init->setPlaca($placa);

        $init->setValorUnitario($valor_unitario);

        # Multiplica o valor unitario pela quantidade de combustivel para chegar ao valor total
        $valor_total = $valor_unitario * $quantidade;

        $init->setValorTotal($valor_total);

        $alterar = $init->atualizar($init);

        if (isset($alterar)) {
            $_SESSION["mensagem"] = "editado_sucesso";
            header("Location: ".DIRPAGE."/movimento_entrada/list");
        }
        
    }
}