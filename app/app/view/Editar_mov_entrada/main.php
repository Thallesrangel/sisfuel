<?php

use Src\traits\UrlParser;
use App\controller\ControllerFornecedor;
use App\controller\ControllerMovEntrada;
use App\controller\ControllerTanque;
// -------------
# Objeto fornecedor
$fornecedores = new ControllerFornecedor();
$fornecedores = $fornecedores->listar($fornecedores);

$tanques = new ControllerTanque();
$tanques = $tanques->listar($tanques);
// -------------

$id = $this->parserUrl()[2];

if(intval($id) != 0){
$init = new ControllerMovEntrada();
$init->setId($id);
$result = $init->buscar_id($init);
}

if (count($result) > 0) {
    $id_entrada = $result['id_entrada'];
    $idFornecedorBD = $result['id_fornecedor'];
    $quantidade = $result['quantidade'];
    $idTanqueBD = $result['id_tanque'];
    $placa = $result['placa'];
    $motorista = $result['motorista'];
    $data_entrada = $result['data_entrada'];  
    $nota_fiscal = $result['nota_fiscal']; 
    $valor_unitario = $result['valor_unitario'];
}
?>

    <div class="container">
    <div class="starter-template height-100">
    <h4>Editar Entrada de Combustível</h4>
    <h1>FALTA VALIDAR NA ACTION IGUAL O CADASTRAR </h1>

    <form action="<?=DIRPAGE.'/movimento_entrada/alterar/'.$id_entrada?>" method="POST">
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
        
        <div class="col-2">
            <div class="form-group">
            <span>Quantidade</span> 
            <input  maxlength="20" min="1" type="number" name="quantidade" value ="<?=$quantidade?>" class="form-control form-control-sm">
            </div>
        </div>

        <div class="col-3">
            <div class="form-group">
            <span>Tanque</span> 
            
            <select class="form-control form-control-sm"  name="tanque">
                    <?php
                    foreach($tanques as $tanque){
                        $idTanque =  $tanque['id_tanque'];
                        $nomeTanque =  ucwords($tanque['nome_tanque']);

                        if ($idTanqueBD == $idTanque) {
                            $selected = 'selected';
                        } else {
                            $selected = '';
                        }   
                        echo '<option value="' . $idTanque . '" '.$selected.'>' . $nomeTanque . '</option>';
                    ?>
                    
                    <?php }?>
                </select>

            </div>  
            </div>

        <div class="col-3">
            <div class="form-group">
            <span>Data</span>
            <input id="datetime" type="datetime" value="<?= $data_entrada?>" name="data" class="form-control form-control-sm">
            </div>
        </div>
        </div>

        <div class="row">

        <div class="col-2">
            <div class="form-group">
            <span>Nº Nota Fiscal</span>
            <input type="number" name="nf" value="<?= $nota_fiscal ?>"class="form-control form-control-sm">
            </div>
        </div>

        <div class="col-3">
            <div class="form-group">
            <span>Motorista</span>
            <input maxlength="35" type="text" name="motorista"  value="<?=$motorista?>" autocomplete="off" class="form-control form-control-sm">
            </div>
        </div>

        
        <div class="col-2">
            <div class="form-group">
            <span>Placa:</span>
            <input  maxlength="10" type="int" name="placa" value="<?=$placa?>" class="form-control form-control-sm">
            </div>
        </div>

        <div class="col-2">
            <div class="form-group">
            <span>Valor unitário:</span>
            <input  maxlength="10" type="int" name="valor_unitario"  value="<?=$valor_unitario?>" class="form-control form-control-sm">
            </div>
        </div>

        </div>
        
        <a href="javascript:history.back()" class="btn btn-secondary btn-sm"">Voltar</a>
        <input id="solicitar" class="btn btn-success btn-sm" type="submit" value="Registrar">
    
    </form>
    </div>
</div>