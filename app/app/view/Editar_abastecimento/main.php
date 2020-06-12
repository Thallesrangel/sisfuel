<?php
use Src\traits\UrlParser;

use App\controller\ControllerAbastecimento;
use App\controller\ControllerFornecedor;
use App\controller\ControllerVeiculo;
use App\controller\ControllerMotorista;
use App\controller\ControllerCatCombustivel;
use App\controller\ControllerTanque;


// -------------
# Objeto motorista
$motoristas = new ControllerMotorista();
$motoristas = $motoristas->listar($motoristas);

# Objeto fornecedor
$fornecedores = new ControllerFornecedor();
$fornecedores = $fornecedores->listar($fornecedores);

# Objeto veiculo
$veiculos = new ControllerVeiculo();
$veiculos = $veiculos->listar($veiculos);

# Objeto categoria combustivel
$combsutivel = new ControllerCatCombustivel();
$combsutivelResultado = $combsutivel->listar($combsutivel);

// -------------

$id = $this->parserUrl()[2];

if(intval($id) != 0){
$init = new ControllerAbastecimento();
$init->setId($id);
$result = $init->buscar_id($init);
}
if (count($result) > 0) {
    $id_abastecimento = $result['id_abastecimento'];
    $idFornecedorBD = $result['id_fornecedor'];
    $quantidade = $result['quantidade'];
    $data_hora = $result['data_hora'];
    $comprovante = $result['comprovante'];
    $quilometragem = $result['km'];
    $iddmotorista = $result['id_motorista'];
    $tipo_combustivel = $result['id_combustivel'];
    $idveiculoBD = $result['id_veiculo'];
}
?>

<div class="container">
<h4>Editar Abastecimento</h4>
	<form action="<?=DIRPAGE.'/abastecimento/alterar/'.$id_abastecimento?>" method="POST">
            <div class="row">
                <div class="col-3">
                    <div class="form-group">
                        <span>Fornecedor</span> 
                        <select class="form-control form-control-sm"  name="fornecedor">
                        <?php
                        foreach($fornecedores as $fornecedor){
                            $idFornecedor =  $fornecedor['id_fornecedor'];
                            $nomeFornecedor =  ucwords($fornecedor['razao_social']);

                            if ($idFornecedorBD == $idFornecedor) {
                                $selected = 'selected';
                            } else {
                                $selected = '';
                            }   
                            echo '<option value="' . $idFornecedor . '" '.$selected.'>' . $nomeFornecedor . '</option>';
                        ?>
                     
                        <?php }?>
                        </select>
                    </div>
                </div>

                <div class="col-3">
                    <label>Quantidade: </labe>
                    <input type="text" name="quantidade" value ="<?=$quantidade?>">
                </div>

                <div class="col-3">
                    <label>Data: </labe>
                    <input type="text" name="data" value ="<?=$data_hora?>">
                </div>

                <div class="col-3">
                    <div class="form-group">
                        <span>Veículo</span> 
                        <select class="form-control form-control-sm" name="veiculo">
                            <?php
                                foreach($veiculos as $veiculo){
                                $idVeiculo =  $veiculo['id_veiculo'];
                                $nomeVeiculo =  $veiculo['nome_modelo'] . " - " . $veiculo['placa'];

                                if ($idveiculoBD == $idVeiculo) {
                                    $selected = 'selected';
                                } else {
                                    $selected = '';
                                }   
                                echo '<option value="' . $idVeiculo . '" '.$selected.'>' . $nomeVeiculo . '</option>';
                                ?>
            
                            <?php }?>
                        </select>
                    </div>  
                </div>
                
            </div>
                
            <div class="row">
                <div class="col-3">
        
                    <div class="form-group">
                        <span>Veículo</span> 
                        <select class="form-control form-control-sm" name="veiculo">
                        <?php
                            foreach($veiculos as $veiculo){
                            $idVeiculo =  $veiculo['id_veiculo'];
                            $nomeVeiculo =  $veiculo['nome_modelo'] . " - " . $veiculo['placa'];

                            if ($idveiculoBD == $idVeiculo) {
                                $selected = 'selected';
                            } else {
                                $selected = '';
                            }   
                            echo '<option value="' . $idVeiculo . '" '.$selected.'>' . $nomeVeiculo . '</option>';
                        ?>
               
                        <?php }?>
                        </select>
                    </div>  
                </div>

                <div class="col-3">
                    <label>Nº comprovante: </labe>
                    <input type="text" name="comprovante" value ="<?=$comprovante?>">
                </div>

                <div class="col-3">
                  
                    <div class="form-group">
                        <span>Motorista</span> 
                        <select class="form-control form-control-sm" id="motorista"  name="motorista">
                            <?php
                            foreach($motoristas as $motorista){
                                $idMotorista =  $motorista['id_motorista'];
                                $nomeMotorista =  ucwords($motorista['nome_motorista']);
                            
                                if ($iddmotorista == $idMotorista) {
                                    $selected = 'selected';
                                } else {
                                    $selected = '';
                                }   
                                echo '<option value="' . $idMotorista . '" '.$selected.'>' . $nomeMotorista . '</option>';
                            ?>
                        
                            <?php 
                            }
                            ?>
                        </select>
                
                    </div>

                </div>

                <div class="col-3">
                    <label>Quilometragem: </labe>
                    <input min="1" type="number" name="quilometragem" value ="<?=$quilometragem?>">
                </div>

                <div class="col-3">
                    <label>Valor unitário / Litro: </labe>
                    <!-- AINDA IMPLEMENTAR -->
                    <input type="text" name="valorUnitario" value ="">
                </div>

                <div class="col-2">
                    <div class="form-group">
                        <span>Combustível</span> 
                        <select class="form-control form-control-sm" id="combustivel"  name="combustivel">
                        <?php
                        foreach($combsutivelResultado as $combustivel){
                            $idCombustivel =  $combustivel['id_combustivel'];
                            $nomeCombustivel =  $combustivel['categoria_combustivel'];

                            if ($tipo_combustivel == $idCombustivel) {
                                $selected = 'selected';
                            } else {
                                $selected = '';
                            }   
                            echo '<option value="' . $idCombustivel . '" '.$selected.'>' . $nomeCombustivel . '</option>';
                        ?>
                        <?php }?>
                        </select>
                   
                    </div>
                </div>


            </div>
        <a href="javascript:history.back()" class="btn btn-secondary btn-sm"">Voltar</a>
        <input class="btn btn-success btn-sm" type="submit"  value="Salvar">
	</form>
</div>