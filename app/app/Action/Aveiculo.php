<?php
namespace App\Action;

use Src\traits\TratarDados;
use App\controller\ControllerVeiculo;

abstract class Aveiculo
{   
    use TratarDados;
    # Exclui um veículo
    public function excluirAction($id)
    {    
		$init = new ControllerVeiculo();
        $init->setId($id);
        # Valida se existe id com esse numero
        if (intval($id) != 0){
            $retorno = $init->deletar($init);
            $_SESSION["mensagem"] = "excluido";
            header("Location: " . DIRPAGE . "/veiculo/list");
        } else {
            die("erro ao excluir tá?! Confere em Action/Afornecedor");
        } 
    } 

    # Cadastra novo veículo
    public function registrarAction()
    {   
        if (isset($_POST)) {
            $placa = $_POST['placa'];
            $renavam = $_POST['renavam'];
            $cor = $_POST['cor'];
            $ano_fabricacao = date("Y-m-d",strtotime($_POST['ano_fabricacao']));
            $ano_modelo = date("Y-m-d",strtotime($_POST['ano_modelo']));
            $quantidade_tanque = TratarDados::tratarQuantidade($_POST['quantidade_tanque']);
            $chassi = $_POST['chassi'];
            $id_modelo = $_POST['id_modelo'];
            $tipocombustivel = trim($_POST['tipoCombustivel']);
            $categoriaveiculo = trim($_POST['categoriaVeiculo']);
            $tipo_veiculo = $_POST['tipo_veiculo'];
        } else {
            die("erro ao CADASTRAR.. Confere em Action/Aveiculo");
        }
     
        $init = new ControllerVeiculo();
        $init->setIdCliente($_SESSION['id_cliente']);
        $init->setPlaca($placa);
        $init->setRenavam($renavam);
        $init->setCor($cor);
        $init->setAnoFabricao($ano_fabricacao);
        $init->setAnoModelo($ano_modelo);
        $init->setQuantidadeTanque($quantidade_tanque);
        $init->setChassi($chassi);
        $init->setModeloVeiculo($id_modelo); 
        $init->setCombustivel($tipocombustivel);
        $init->setCategoriaVeiculo($categoriaveiculo);
        $init->setTipoVeiculo($tipo_veiculo);

        $cadastrar = $init->cadastrar($init);
          
        if (isset($cadastrar)) {
            $_SESSION["mensagem"] = "registrado";
            header("Location: " . DIRPAGE . "/veiculo/list");
        }
    }
}