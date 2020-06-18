<?php

use App\controller\ControllerTanque;
use App\Action\Atanque;
use App\Model\Conexao;

$tanque = new ControllerTanque();
$tanque = $tanque->listar($tanque);

?>
<div class="container-fluid">
    <div class="container">
        <div class="row justify-content-center">
        
            <div class="card border-left-primary shadow h-100 py-2">
                <a href="<?=DIRPAGE.'/veiculo/view/'?>">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1">Veículos</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"></div>
                            </div>
                            <div class="col-auto">
                            <i class="iconDashboard" data-feather="truck"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="card border-left-primary shadow h-100 py-2">
                <a href="<?=DIRPAGE.'/motorista/view/'?>">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1">Motoristas</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"></div>
                            </div>
                        <div class="col-auto">
                        <i class="iconDashboard" data-feather="users"></i>
                        </div>
                        </div>
                    </div>
                </a>
            </div>
            
            <div class="card border-left-primary shadow h-100 py-2">
                <a href="<?=DIRPAGE.'/ticket/view/'?>">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1">Ticket liberados</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"></div>
                            </div>
                        <div class="col-auto">
                        <i class="iconDashboard" data-feather="file-minus"></i>
                        </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="card border-left-primary shadow h-100 py-2">
                <a href="<?=DIRPAGE.'/ticket/view/'?>">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1">Ticket liberados</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"></div>
                            </div>
                        <div class="col-auto">
                        <i class="iconDashboard" data-feather="file-minus"></i>
                        </div>
                        </div>
                    </div>
                </a>
            </div>
   
        </div>

  
<br>
    <?php
    if($tanque != ""){
    foreach ($tanque as $key => $value) {

        $qtdCombustivelDisponivel = Atanque::qtdCombustivelDisponivel($value['id_tanque']);
    ?>
    <div class="container">
        <div class="divTanque col-sm-12 col-lg-3">
            <h6><?=$value['nome_tanque']?></h6>
            <p><?=$qtdCombustivelDisponivel . " / ". $value['capacidade']  . '-' . $value['abreviacao_medida']?></p>
            <progress id="idBarProgress" value="<?=$qtdCombustivelDisponivel?>" max="<?=$value['capacidade']?>"> </progress><br>
            <span><?=($qtdCombustivelDisponivel * 100 ) / $value['capacidade']?>%</span><br>
            <p><?=$value['categoria_combustivel']?></p>
        </div>
    </div>
    <?php
    }
}
?>  
</div>
</div>

