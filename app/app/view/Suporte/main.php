<?php
use App\controller\ControllerSuporte;

$suporte = new ControllerSuporte();
$suporte = $suporte->listar($suporte);

require_once(DIRREQ.'/app/view/layout/mensagens.php');
unset($_SESSION["mensagem"]);
?>
<div class="container">
  <div class="starter-template height-100">

    <h4>Suporte Técnico</h4>
      <p>
        <button class="btn btn-default btn-sm btnCadastrar" onclick="window.location.href='<?=DIRPAGE?>/suporte/novo/'">Novo</button>
      </p>
      <table class="table  table-sm table-hover" id="table"> 
        <thead>
          <tr>
            <th>Protocolo</th>
            <th>Requerente</th>
            <th>Título</th>
            <th>Resposta</th>
            <th>Situação</th>
            <th>Ação</th>
          </tr>
        </thead>
        <tbody>
          <?php
            if($suporte != ""){
            foreach ($suporte as $key => $value) {
          ?>
            <tr>
              <td><?=$value['id_suporte']?></td>
              <td><?=$value['requerente']?></td>
              <td><?=$value['titulo']?></td>
              <td><?=$value['resposta']?></td>
              <td><?=$value['situacao']?></td>
              <td>
                <a href="<?=DIRPAGE?>/suporte/editar/<?=$value['id_suporte']?>"title="Visualizar detalhes">
                <i data-feather="eye" class="iconEditar"></i>
                </a>
                  <!-- Colocar a restrição de que somente quando tiver com situação = 1 ter aparecer o botão de cancelar chamado-->
                <a href="<?=DIRPAGE?>/suporte/excluir/<?=$value['id_suporte']?>" title="Cancelar suporte">
                <i data-feather="x" class="iconExcluir"></i>
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