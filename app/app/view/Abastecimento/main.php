<?php

use App\controller\ControllerAbastecimento;

$abastecimento = new ControllerAbastecimento();
$abastecimentos = $abastecimento->listar($abastecimento);

require_once(DIRREQ.'/app/view/layout/mensagens.php');
unset($_SESSION["mensagem"]);

?>

<div class="container">

  <div class="starter-template height-100">
    <p>
    <a href="<?=DIRPAGE?>/abastecimento/novo" class="btn btn-default btn-sm btnCadastrar" alt="Incluir Cadastro" title="Incluir Cadastro">
        Novo</a>
    </p>

    <table class="table table-sm table-hover text-center" id="table"> 
      <thead>
        <tr>
          <th>ID</th>
          <th>Fornecedor</th>
          <th>Qtd</th>
          <th>Data</th>
          <th>Comprovante</th>
          <th>KM</th>
          <th>Motorista</th>
          <th>Combustível</th>
          <th>Veículo</th>
          <th>Ações</th>
        </tr>
      </thead>
        <tbody>
            <?php
              if($abastecimentos != ""){
              foreach ($abastecimentos as $key => $value) {
                $dataEntrada = date_create($value['data_hora']);
            ?>
                <tr>
                    <td><?=$value['id_abastecimento']?></td>
                    <td><?=ucwords($value['razao_social'])?></td>
                    <td><?=ucwords($value['quantidade'])?></td>
                    <td><?=date("d/m/Y H:i", strtotime($value['data_hora']));?></td>
                    <td><?=$value['comprovante']?></td>
                    <td><?=$value['km']?></td>
                    <td><?=$value['nome_motorista']?></td>
                    <td><?=$value['categoria_combustivel']?></td>
                    <td><?=$value['placa']?></td>
                    <td>
                      <a href="<?=DIRPAGE?>/abastecimento/editar/<?=$value['id_abastecimento']?>">
                      <i data-feather="edit" class="iconEditar"></i>
                      </a>
                        
                      <a href="<?=DIRPAGE?>/abastecimento/excluir/<?=$value['id_abastecimento']?>">
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
  window.location = "<?=DIRPAGE?>/abastecimento/editar/"+id;
});
</script>