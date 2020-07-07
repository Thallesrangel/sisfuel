<?php

use App\controller\ControllerVeiculo;

use App\model\Conexao;

$usuario = new ControllerVeiculo();
$usuarios = $usuario->listar($usuario);

require_once(DIRREQ.'/app/view/layout/mensagens.php');
unset($_SESSION["mensagem"]);
?>
<div class="container">
<div class="starter-template height-100">
      <p>
      <a href="<?=DIRPAGE?>/veiculo/novo" class="btn btn-default btn-sm btnCadastrar" alt="Incluir Cadastro" title="Incluir Cadastro">
        Novo</a>
      </p>
     

      <table class="table table-sm table-hover" id="table"> 
        <thead>
          <tr>
            <th>Veículo</th>
            <th>Renavam</th>
            <th>Fabricante</th>
            <th>Combustível</ht>
            <th>Categoria</ht>
            <th>Acoes</th>
          </tr>
        </thead>
        <tbody>
            <?php
              if($usuarios != ""){
              foreach ($usuarios as $key => $value) {
            ?>
                <tr>
                  <td><?=$value['placa']?></td>
                  <td><?=$value['renavam']?></td>
                  <td><?=$value['modelo_veiculo']?></td>
                  <td><?=$value['categoria_combustivel']?></td>
                  <td><?=$value['categoria_veiculo']?></td>
                  <td>
                    <a href="<?=DIRPAGE?>/veiculo/editar/<?=$value['id_veiculo']?>" alt="Editar Cadastro" title="Editar Cadastro">
                      <i data-feather="edit" class="iconEditar"></i>
                    </a>
                      
                    <a href="<?=DIRPAGE?>/veiculo/excluir/<?=$value['id_veiculo']?>" alt="Excluir Cadastro">
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
</div>
</div>

<!-- Script Usado para editar com dois clicks na linha-->
<script>
$('tr').dblclick(function(){
  var tr = $(this).closest("tr");
  var id = tr.find("td:eq(0)").text();
  window.location = "<?=DIRPAGE?>/veiculo/editar/"+id;
});
</script>