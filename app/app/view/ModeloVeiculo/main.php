<?php

use App\controller\ControllerModeloVeiculo;
use App\controller\ControllerFabricante;

$modelo = new ControllerModeloVeiculo();
$modelo = $modelo->listar($modelo);

// Objeto Fornecedor
$fabricante = new ControllerFabricante();
$fabricante = $fabricante->listar($fabricante);

require_once(DIRREQ.'/app/view/layout/mensagens.php');
unset($_SESSION["mensagem"]);

?>
<div class="container">
<div class="starter-template  height-100">

      <h4>Modelo Veículo</h4>
      <p align="left">
      <a data-toggle="modal" data-target="#exampleModal" class="btn btn-default btn-sm btnCadastrar" alt="Incluir Cadastro" title="Incluir Cadastro">
         Novo</a>
      </p>

      <table class="table table-sm table-hover" id="table"> 
        <thead>
          <tr>
            <th>ID</th>
            <th>Modelo</th>
            <th>Fabricante</th>
             <th>Ação</th>
          </tr>
        </thead>
        <tbody>
            <?php
              if($modelo != ""){
              foreach ($modelo as $key => $value) {
            ?>
                <tr>
                    <td><?=$value['id_modelo']?></td>
                    <td><?=$value['modelo_veiculo']?></td>
                    <td><?=$value['nome_fabricante']?></td>
              
                    <td>
                      <a href="<?=DIRPAGE?>/modelo-veiculo/alterar/<?=$value['id_modelo']?>" title="Alterar Registro">
                      <i data-feather="edit" class="iconEditar"></i>
                      </a>
                        
                      <a href="<?=DIRPAGE?>/modelo-veiculo/excluir/<?=$value['id_modelo']?>" title="Excluir Registro">
                      <i data-feather="trash" class="iconExcluir"></i>
                      </a>
                    </td>
                </tr>
              <?php
              }
            }
            ?>
        </tbody>
      </table>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cadastrar Modelo de Veículo </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?=DIRPAGE.'/modelo-veiculo/registrar/'?>" method="POST">
                
                  <div class="form-group">
                      <input placeholder="Modelo" type="text" name="modelo" class="form-control">
                  </div>

                
                <div class="form-group">
                    <p>Fornecedor</p> 
                    <select class="form-control form-control-sm js-select" name="fabricante" required>
                    <?php
                    foreach($fabricante as $fabricant){
                        $idFabricante =  $fabricant['id_fabricante'];
                        $nomeFabricante =  $fabricant['nome_fabricante'];
                    ?>
                    <option value="<?= $idFabricante ?>"> <?php echo ($nomeFabricante)?> </option>
                    <?php }?>
                    </select>
                </div>  
                   
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <input class="btn btn-success" type="submit" value="Cadastrar">
                    <input class="btn btn-danger" type="reset" value="Limpar">
                </div>
                </form>
            </div>
        
        </div>
    </div>
</div>
</div>

<!-- Script Usado para editar com dois clicks na linha-->
<script>
$('tr').dblclick(function(){
  var tr = $(this).closest("tr");
  var id = tr.find("td:eq(0)").text();
  window.location = "<?=DIRPAGE?>/modelo-veiculo/editar/"+id;
});
</script>