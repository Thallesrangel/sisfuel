<?php 
use App\controller\ControllerCartaoVirtual;

$idCartao = $this->parserUrl()[2];

if (intval($idCartao) != 0) {
  $init = new ControllerCartaoVirtual();
  $init->setId($idCartao);
  $resultado_cartao = $init->buscar_id($init);
}

?>
<div class="d-flex flex-column">
<nav class="navbar-expand navbar-light bg-white  mb-1 static-top shadow-sm">

  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav navbar-left">
	
      <li class="nav-item">
          <li class=nav-link>
            <a href="<?=DIRPAGE?>"><img src="<?=DIRIMG . 'logo.png'?>"></a> 
          </li>
      </li>

      <li class="nav-item">
          <li class=nav-link>
            <a href="<?=DIRPAGE.'/cartao-virtual/registro_externo'?>" class="btn btn-dark">Nova requisição</a> 
          </li>
      </li> 

      <li class="nav-item">
          <li class=nav-link>
            <span class="nav-link"><b>Empresa: </b><?php echo  $_SESSION['nome_usuario'] .' - <b>Motorista:</b>'. $resultado_cartao['nome_motorista'] ?></span>  
          </li>
      </li>
      
    </ul>
    <ul class="navbar-nav ml-auto">
      <!--
      <li class="nav-item list-unstyled ">
        <a class="nav-link" href="<?=DIRPAGE?>"><i data-feather="home"></i><span class="sr-only">(current)</span></a>
      </li>
      -->
      
      <li class="nav-item">
        <a class="nav-link" href="<?=DIRPAGE.'/logout'?>"><i data-feather="log-out"></i></a>
      </li>

    </ul>
  </div>
</nav>


<div class="starter-template height-100">
    <div class="container">
        <div class="row">
            <div class="col-3">
                <p>Limite disponível R$: <?=$resultado_cartao['valor_limite']?></p>
            </div>

            <div class="col-3">
                <?php $data = date_create($resultado_cartao['data_validade']); ?>
                <p>Validade: <?=date_format($data,'d/m/Y');?></p>
            </div>

            <div class="col-3">
                <p>Situação: <?=$resultado_cartao['cartao_situacao']?></p>
            </div>

            <div class="col-3">
                <p>Cartão: <?=$resultado_cartao['id_cartao']?></p>
            </div>
        </div>
    </div>
    <h5 class="text-center"><b>Registros de Requisições de Abastecimentos</b></h5>
    <table class="table table-sm table-hover"> 
        <thead>
          <tr>
            <th>ID</th>
            <th>Posto</th>
            <th>Veículo</th>
            <th>Combustível</th>
            <th>Quantidade</th>
            <th>Valor unitário</th>
            <th>Total</th>
            <th>Situação</th>
            <th>Ação</th>
          </tr>
        </thead>
        <tbody>
            <?php
              if($fornecedor != ""){
              foreach ($fornecedor as $key => $value) {
            ?>
                <tr>
                    <td><?=$value['id_fornecedor']?></td>
                    <td><?=ucwords($value['razao_social'])?></td>
                    <td><?=ucwords($value['area_atuacao'])?></td>
                    <td><?=$value['cnpj']?></td>
                    <td>             
                      <a href="<?=DIRPAGE?>/cartao-virtual/cancelar/<?=$value['id_registro']?>" alt="Cancelar" title="Cancelar"
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