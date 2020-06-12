
<?php

use App\controller\ControllerMovEntrada;
use Src\traits\UrlParser;

$entrada = new ControllerMovEntrada();
$entrada = $entrada->listar($entrada);

require_once(DIRREQ.'/app/view/layout/mensagens.php');
unset($_SESSION["mensagem"]);
?>

<div class="container">
  <div class="starter-template height-100">


    <p style="float:left">
    <a href="<?=DIRPAGE?>/movimento_entrada/novo" class="btn btn-default btn-sm btnCadastrar" alt="Incluir Cadastro" title="Incluir Cadastro">
        Novo</a>
    </p>
    
      <table  id="table" class="table table-sm table-hover" id="table"> 
        <thead>
          <tr>
            <th title="ID Abastecimento">ID</th>
            <th title="Tanque Registrado">Tanque</th>
            <th>Fornecedor</th>
            <th title="Quantidade de Combustível">Qtd</th>
            <th title="Nota Fiscal">NF</th>
            <th title="Data de Entrada">Entrada</th>
            <th title="Valor Unitário">R$ Un.</th>
            <th title="Valor Total">R$ Total</th>
            <th>Ações</th>
          </tr>
        </thead>
        <tbody>
            <?php
              if($entrada != ""){
              foreach ($entrada as $key => $value) {
                $dataEntrada = date_create($value['data_entrada']);
            ?>
                <tr>
                    <td><?=$value['id_entrada']?></td>
                    <td><?=$value['nome_tanque']?></td>
                    <td><?=ucwords($value['razao_social'])?></td>
                    <td><?=$value['quantidade'] . '-' . $value['abreviacao_medida']?></td>
                    <td><?=$value['nota_fiscal']?></td>
                    <td><?=date("d/m/Y H:i", strtotime($value['data_entrada']));?></td>
                    <td><?=$value['valor_unitario']?></td>
                    <td><?=$value['valor_total']?></td>
                    <td>
                      <a href="<?=DIRPAGE?>/movimento_entrada/editar/<?=$value['id_entrada']?>">
                      <i data-feather="edit" class="iconEditar"></i>
                      </a>
                        
                      <a href="<?=DIRPAGE?>/movimento_entrada/excluir/<?=$value['id_entrada']?>">
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
  window.location = "<?=DIRPAGE?>/movimento_entrada/editar/"+id;
});
</script>