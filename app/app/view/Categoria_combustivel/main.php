<?php

use App\controller\ControllerCatCombustivel;

$usuario = new ControllerCatCombustivel();
$usuarios = $usuario->listar($usuario);
?>
<div class="container">
<div class="starter-template height-100">
    <?php 
       require_once(DIRREQ.'/app/view/layout/mensagens.php');
       unset($_SESSION["mensagem"]);
    ?>

      <h4>Categoria de Combustível</h4>
      <p align="left">
      <a data-toggle="modal" data-target="#exampleModal" class="btn btn-default btn-sm btnCadastrar" alt="Incluir Cadastro" title="Incluir Cadastro">
         Novo</a>
      </p>

      <table class="table table-sm table-hover" id="table"> 
        <thead>
          <tr>
            <th>ID</th>
            <th>Combustível</th>
            <th>Ação</th>
          </tr>
        </thead>
        <tbody>
            <?php
              if($usuarios != ""){
              foreach ($usuarios as $key => $value) {
            ?>
                <tr>
                    <td><?=$value['id_combustivel']?></td>
                    <td><?=$value['categoria_combustivel']?></td>
                    <td>
                      <a href="aedit_categ_combustivel.php?id_combustivel=<?=$value['id_combustivel']?>" alt="Editar categoria combustível" title="Editar categoria combustível">
                      <i data-feather="edit" class="iconEditar"></i>
                      </a>
                        
                      <a href="adel_categ_combustivel.php?id_combustivel=<?=$value['id_combustivel']?>" alt="Excluir categoria combustível"  title="Excluir categoria combustível">
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
                <h5 class="modal-title" id="exampleModalLabel">Categoria do Combustível</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="acad_categ_combustivel.php" method="POST">
                <div class="form-group">
                    <input placeholder="Ex: Diesel, Etanol, Gasolina..." type="text" name="name" class="form-control" id="message-text">
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
  window.location = "<?=DIRPAGE?>/categoria_combustivel/editar/"+id;
});
</script>