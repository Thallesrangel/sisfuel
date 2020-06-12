<?php

use App\controller\ControllerCatVeiculo;

$usuario = new ControllerCatVeiculo();
$usuarios = $usuario->listar($usuario);
?>
<div class="container">
<div class="starter-template height-100">
    <?php 
       require_once(DIRREQ.'/app/view/layout/mensagens.php');
       unset($_SESSION["mensagem"]);
    ?>
      <h4>Categoria Veículos</h4>
      <p align="left">
      <a data-toggle="modal" data-target="#exampleModal" class="btn btn-default btn-sm btnCadastrar" alt="Incluir Cadastro" title="Incluir Cadastro">
         Novo</a>
      </p>

      <table class="table  table-sm table-hover" id="table"> 
        <thead class="thead-light">
          <tr>
            <th>ID</th>
            <th>Categoria Veículo</th>
            <th>Ação</th>
          </tr>
        </thead>
        <tbody>
            <?php
              if($usuarios != ""){
              foreach ($usuarios as $key => $value) {
            ?>
                <tr>
                    <td><?=$value['id_categoria_veiculo']?></td>
                    <td><?=ucwords($value['categoria_veiculo'])?></td>
                    <td>     
                        <a href="alterar/<?=$value['id_categoria_veiculo']?>" title="Alterar Registro">
                            <i data-feather="edit" class="iconEditar"></i>
                        </a>
                            
                        <a href="<?=DIRPAGE?>/categoria_veiculo/excluir/<?=$value['id_categoria_veiculo']?>" title="Excluir Registro">
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
                <h5 class="modal-title" id="exampleModalLabel">Categoria do Veículo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?=DIRPAGE.'/categoria_veiculo/novo/'?>" method="POST">
                <div class="form-group">
                    <input placeholder="Ex: Pesado, Leve, Passeio..." type="text" name="name" class="form-control" id="message-text">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <input class="btn btn-success" type="submit" value="Cadastrar">
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
  window.location = "<?=DIRPAGE?>/categoria_veiculo/editar/"+id;
});
</script>