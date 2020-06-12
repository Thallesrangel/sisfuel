<?php

use App\controller\ControllerFabricante;

$fabricante = new ControllerFabricante();
$fabricantes = $fabricante->listar($fabricante);

require_once DIRREQ."/app/view/layout/mensagens.php";
unset($_SESSION["mensagem"]);
?>
<div class="container">
  <div class="starter-template height-100">
      <h4>Fabricante do veículo</h4>
      <p align="left">
      <a data-toggle="modal" data-target="#exampleModal" class="btn btn-default btn-sm btnCadastrar" alt="Incluir Cadastro" title="Incluir Cadastro"> Novo</a>
      <table class="table table-sm table-hover" id="table"> 
        <thead>
          <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Ação</th>
          </tr>
        </thead>
        <tbody>
            <?php
              if($fabricantes != ""){
              foreach ($fabricantes as $key => $value) {
            ?>
                <tr>
                    <td><?=$value['id_fabricante']?></td>
                    <td><?=$value['nome_fabricante']?></td>
                    <td>
                      <a href="<?=$value['id_fabricante']?>" alt="Editar Cadastro" title="Editar Cadastro">
                      <i data-feather="edit" class="iconEditar"></i>
                      </a>
                        
                      <a href="<?=$value['id_fabricante']?>" alt="Excluir Cadastro">
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
                <h5 class="modal-title" id="exampleModalLabel">Fabricante Veículo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="categoriaveiculo/cadastrarmodelo" method="POST">
                <div class="form-group">
                    <input placeholder="Ex: Ford, Fiat, Scania, Mercedes Benz..." type="text" name="name" class="form-control" id="message-text">
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
  window.location = "<?=DIRPAGE?>/fabricante/editar/"+id;
});
</script>