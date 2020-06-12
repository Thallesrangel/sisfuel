<?php
use App\controller\ControllerMotorista;
use Src\traits\UrlParser;

$id = $this->parserUrl()[2];

if(intval($id) != 0){
$init = new ControllerMotorista();
$init->setId($id);
$result = $init->buscar_id($init);
}
if (count($result) > 0) {
    $id = $result['id_motorista'];
    $nome = $result['nome_motorista'];
    $cpf = $result['cpf'];
    $cnh = $result['cnh'];
    $vencimento_cnh = $result['data_vencimento_cnh'];
    $data_nascimento = $result['data_nascimento'];
}
?>

<div class="container">
    <div class="starter-template height-100">
        <h4>Editar Motorista</h4>
        <form action="<?=DIRPAGE.'/motorista/alterar/'.$id?>" method="POST" name="atualizar">
                <div class="row">
                    <div class="col-3">
                        <label>Nome: </labe>
                        <input type="text" name="nome_motorista" value ="<?=$nome?>">
                    </div>

                    <div class="col-3">
                        <label>CPF: </labe>
                        <input type="text" name="cpf" value ="<?=$cpf?>">
                    </div>

                    <div class="col-3">
                        <label>CNH: </labe>
                        <input type="text" name="cnh" value ="<?=$cnh?>">
                    </div>
                </div>
                    
                <div class="row">
                    <div class="col-3">
                        <label>Vencimento CNH: </labe>
                        <input type="text" name="data_vencimento_cnh" value ="<?=$vencimento_cnh?>">
                    </div>

                    <div class="col-3">
                        <label>Data nascimento: </labe>
                        <input type="text" name="data_nascimento" value ="<?=$data_nascimento?>">
                    </div>
                </div>
            <a href="javascript:history.back()" class="btn btn-secondary btn-sm"">Voltar</a>
            <input class="btn btn-success btn-sm" type="submit"  value="Salvar">
        </form>
    </div>
</div>