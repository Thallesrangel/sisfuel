<?php

use App\controller\ControllerSeguro;

$seguros = new ControllerSeguro();
$seguros = $seguros->listarTodos($seguros);
 
require_once(DIRREQ.'/app/view/layout/mensagens.php');
unset($_SESSION["mensagem"]);

?>
<div class="container">
  <div class="starter-template  height-100">

    <h4>Seguros</h4>
    <p style="float:left">
    <a href="<?=DIRPAGE.'/seguro/novo'?>" class="btn btn-default btn-sm btnCadastrar" alt="Incluir Cadastro" title="Incluir Cadastro">
        Novo</a>
    </p>
    
      <table class="table table-sm table-hover" id="table"> 
        <thead>
          <tr>
            <th>Apólice</th>
            <th>Veículo</th>
            <th>Seguradora</th>
            <th>Vencimento</th>
            <th>Valor</th>
            <th>Situação</th>
            <th>Ações</th>
          </tr>
        </thead>
        <tbody>
            <?php
              if($seguros != ""){
              foreach ($seguros as $key => $value) {
            ?>
                <tr>
                    <td><?=$value['apolice']?></td>
                    <td><?=$value['placa']?></td>
                    <td><?=$value['razao_social']?></td>
                    <td><?=date("d/m/Y", strtotime($value['data_vencimento']));?></td>
                    <td class="valor-limite"><?=$value['valor']?></td>
                    <td><?=$value['situacao']?></td>
                    <td>
                      <a href="<?=DIRPAGE?>/seguro/editar/<?=$value['id_seguro']?>" >
                      <i data-feather="edit" class="iconEditar"></i>
                      </a>
                        
                      <a href="<?=DIRPAGE?>/seguro/excluir/<?=$value['id_seguro']?>">
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
  window.location = "<?=DIRPAGE?>/seguro/editar/"+id;
});
</script>