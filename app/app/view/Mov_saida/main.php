<?php

use App\controller\ControllerMovSaida;
use Src\traits\UrlParser;

$saida = new ControllerMovSaida();
$saida = $saida->listar($saida);

require_once(DIRREQ.'/app/view/layout/mensagens.php');
unset($_SESSION["mensagem"]);
?>
<div class="container">
  <div class="starter-template height-100">

    <p style="float:left">
    <a href="<?=DIRPAGE?>/movimento_saida/novo/" class="btn btn-default btn-sm btnCadastrar" alt="Incluir Cadastro" title="Incluir Cadastro">
        Novo</a>
    </p>

      <table class="table table-sm table-hover" id="table"> 
        <thead>
          <tr>
          <th>ID</th>
            <th>Motorista</th>
            <th>Veículo</th>
            <th>Km</th>
            <th>Tanque</th>
            <th title="Quantidade">Qtd</th>
            <th>Data - Hora</th>
            <th>Ações</th>
          </tr>
        </thead>
        <tbody>
            <?php
            if ($saida){
              
              foreach ($saida as $key => $value) {
                $dataSaida = date_create($value['data_hora']);
            ?>
                <tr>
                    <td><?=$value['id_saida']?></td>
                    <td><?=ucwords($value['nome_motorista'])?></td>
                    <td><?=strtoupper($value['placa'])?></td>
                    <td><?=$value['km']?></td>
                    <td><?=$value['nome_tanque']?></td>
                    <td><?=$value['quantidade']?></td>
                     <td><?=date_format($dataSaida,'d/m/Y H:i');?></td>
                    <td>
                      <a href="<?=DIRPAGE?>/movimento_saida/editar/<?=$value['id_saida']?>" >
                      <i data-feather="edit" class="iconEditar"></i>
                      </a>
                        
                      <a href="<?=DIRPAGE?>/movimento_saida/excluir/<?=$value['id_saida']?>">
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
  window.location = "<?=DIRPAGE?>/movimento_saida/editar/"+id;
});
</script>