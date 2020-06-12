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
      <h4>Lista de veiculos</h4>
      <p align="left">
      <a data-toggle="modal" data-target="#exampleModal" class="btn btn-default btn-sm btnCadastrar" alt="Incluir Cadastro" title="Incluir Cadastro">
        Novo</a>
      </p>

      <table class="table table-sm table-hover" id="table"> 
        <thead>
          <tr>
            <th>ID</th>
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
                    <td><?=$value['id_veiculo']?></td>
                    <td><?=$value['placa']?></td>
                    <td><?=$value['renavam']?></td>
                    <td><?=$value['nome_fabricante']?></td>
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

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cadastro Veículo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?=DIRPAGE.'/veiculo/registrar/'?>" method="POST">
                <div class="form-group">
                    <input maxlength="8" placeholder="Placa" type="text" name="placa" class="form-control" id="message-text">
               </div>
               
                <div class="form-group">
                    <input maxlength="25" placeholder="Renavam" type="text" name="renavam" class="form-control" id="message-text">
                </div>

                <div class="form-group">
                    <label for="fabricante">Fabricante</label>
                    <select class="form-control" id="fabricante"  name="fabricante">
                                <?php
                                #SQL DIRETO
                                $pdo = Conexao::getConn();
                                $sql = "SELECT id_fabricante, nome_fabricante FROM tbfabricante_veiculo";
                                $resultado = $pdo->query($sql);

                                foreach($resultado as $value){
                                  $idFabricante =  $value['id_fabricante'];
                                  $nomeFabricante =  $value['nome_fabricante'];
                                ?>
                                <option value="<?= $idFabricante ?>"><?php echo $nomeFabricante ?></option>
                                <?php }?>
                    </select>
                </div>  

                <div class="form-group">
                    <label for="tipoCombustivel">Tipo de Combustível</label>
                    <select class="form-control" id="tipoCombustivel" name="tipoCombustivel" onmousedown="if(this.options.length>5){this.size=5;}" onchange="this.blur()"  onblur="this.size=0;">
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
                    <label for="categoriaVeiculo">Categoria do Veículo</label>
                    <select class="form-control" id="categoriaVeiculo"  name="categoriaVeiculo">
                                <?php
                                #SQL DIRETO
                                $pdo = Conexao::getConn();
                                $sql = "SELECT id_categoria_veiculo, categoria_veiculo FROM tbcategoria_veiculo";
                                $resultado = $pdo->query($sql);

                                foreach($resultado as $value){
                                  $idCatVeiculo =  $value['id_categoria_veiculo'];
                                  $nomeCategoria =  $value['categoria_veiculo'];
                                ?>
                                <option value="<?= $idCatVeiculo ?>"><?=$nomeCategoria?></option>
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

<!-- Script Usado para editar com dois clicks na linha-->
<script>
$('tr').dblclick(function(){
  var tr = $(this).closest("tr");
  var id = tr.find("td:eq(0)").text();
  window.location = "<?=DIRPAGE?>/veiculo/editar/"+id;
});
</script>