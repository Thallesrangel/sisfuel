<?php
use App\controller\ControllerTanque;
use App\Model\Conexao;
$tanque = new ControllerTanque();
$tanque = $tanque->listar($tanque);

use App\Action\Atanque;

require_once(DIRREQ.'/app/view/layout/mensagens.php');
unset($_SESSION["mensagem"]);
?>
<div class="container">
<div class="starter-template  height-100">
      <h4>Lista de Tanques</h4>
      <p align="left">
      <a data-toggle="modal" data-target="#exampleModal" class="btn btn-default btn-sm btnCadastrar" alt="Incluir Cadastro" title="Incluir Cadastro">
         Novo</a>
      </p>
     <div class="table-responsive-sm">
        <table class="table table-sm table-hover text-center" id="table"> 
          <thead>
            <tr>
              <th>ID</th>
              <th>Tanque</th>
              <th>Capacidade</th>
              <th>Limite</th>
              <th>Quantidade Disponível</th>
              <th>Combustível</th>
              <th>Unidade</th>
              <th>Acões</th>
            </tr>
          </thead>
          <tbody>
              <?php
                if($tanque != ""){
                foreach ($tanque as $key => $value) {

                  $qtdCombustivelDisponivel = Atanque::qtdCombustivelDisponivel($value['id_tanque']);
              ?>
                  <tr>
                      <td><?=$value['id_tanque']?></td>
                      <td><?=$value['nome_tanque']?></td>
                      <td><?=$value['capacidade']?></td>
                      <td><?=$value['alerta_limite']?></td>
                      <td><?=$qtdCombustivelDisponivel . '-' . $value['abreviacao_medida']?></td>
                      <td><?=$value['categoria_combustivel']?></td>
                      <td><?=$value['unidade_medida'] . '-' . $value['abreviacao_medida']?></td>
                      <td>
                        <a href="<?=DIRPAGE?>/tanque/editar/<?=$value['id_tanque']?>" alt="Editar Cadastro" title="Editar Cadastro">
                        <i data-feather="edit" class="iconEditar"></i>
                        </a>
                          
                        <a href="<?=DIRPAGE?>/tanque/excluir/<?=$value['id_tanque']?>" alt="Excluir Cadastro">
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

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cadastrar Tanque</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?=DIRPAGE.'/tanque/novo/'?>" method="POST">
                <div class="form-group">
                  <input maxlength="25" placeholder="Identificação do tanque" type="text" name="tanque" class="form-control" id="message-text">
               </div>
               
                <div class="form-group">
                  <input maxlength="20" placeholder="Capacidade Maxima" type="int" name="capacidade" class="form-control quantidade">
                </div>

                <div class="form-group col-5">
                  <input maxlength="7" max="100" min="0" placeholder="Alerta de Limite" type="int" name="limite" class="form-control porcentagem">
                </div>

                <div class="form-group">
                    <label for="tipoCombustivel">Tipo de Combustível</label><br>
                    <select class="form-control js-select" id="tipoCombustivel"  name="tipoCombustivel">
                    <?php
                        #SQL DIRETO
                        $pdo = Conexao::getConn();
                        $sql = "SELECT id_combustivel, categoria_combustivel FROM tbcategoria_combustivel";
                        $resultado = $pdo->query($sql);

                        foreach($resultado as $value){
                          $idCombustivel =  $value['id_combustivel'];
                          $nomeCombustivel =  $value['categoria_combustivel'];
                        ?>
                        <option value="<?= $idCombustivel ?>"><?php echo $nomeCombustivel?></option>
                        <?php }?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="unidadeMedida">Unidade de Medida</label><br>
                    <select class="form-control js-select" id="unidadeMedida" name="id_medida">
                    <?php
                        #SQL DIRETO
                    
                        $pdo = Conexao::getConn();
                        $sql = "SELECT id_medida, unidade_medida, abreviacao_medida, tipo_medida FROM tbunidade_medida WHERE 
                        tipo_medida IN ('capacidade', 'massa') ORDER BY unidade_medida";
                        $resultado = $pdo->query($sql);

                        foreach($resultado as $value){
                          $idUnidadeMedida =  $value['id_medida'];
                          $nomeUnidadeMedida =  $value['unidade_medida'] . " - "  . $value['abreviacao_medida'];
                        ?>
                        <option value="<?=$idUnidadeMedida?>"> <?=$nomeUnidadeMedida?> </option>
                        <?php }?>
                    </select>
                </div>  

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Fechar</button>
                    <input class="btn btn-success btn-sm" type="submit" value="Cadastrar">
                    <input class="btn btn-danger btn-sm" type="reset" value="Limpar">
                </div>
                </form>
            </div>
        
        </div>
    </div>
</div>
</div>