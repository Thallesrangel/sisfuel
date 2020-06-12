<?php
namespace App\Action;

use App\controller\ControllerVeiculo;

abstract class Aveiculo
{
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
        if(isset($_POST['placa'])){
            $placa = trim($_POST['placa']);
            $renavam = trim($_POST['renavam']);
            $fabricante = trim($_POST['fabricante']);
            $tipocombustivel = trim($_POST['tipoCombustivel']);
            $categoriaveiculo = trim($_POST['categoriaVeiculo']);
        } else {
            die("erro ao CADASTRAR.. Confere em Action/Aveiculo");
        }
     
        $init = new ControllerVeiculo();
        $init->setPlaca($placa);
        $init->setIdCliente($_SESSION['id_cliente']);
        $init->setRenavam($renavam);
        $init->setFabricante($fabricante);
        $init->setCombustivel($tipocombustivel);
        $init->setCatVeiculo($categoriaveiculo);
        $cadastrar = $init->cadastrar($init);
          
        if (isset($cadastrar)) {
            $_SESSION["mensagem"] = "registrado";
            header("Location: " . DIRPAGE . "/veiculo/list");
        }
    }
}