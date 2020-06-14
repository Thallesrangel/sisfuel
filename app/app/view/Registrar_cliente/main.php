<?php

use App\controller\ControllerCliente;
use App\model\Conexao;
?>
<html>
<body>
<div class="container">
<form method='POST' action="<?=DIRPAGE.'/cliente/registrar/'?>"> 


<p>Plano</p>
    <select class="form-control form-control-sm" id="plano"  name="plano">
        <?php
              
        $pdo = Conexao::getConn();
        $sql = "SELECT * FROM tbplanos";
        $resultado = $pdo->query($sql);

            foreach($resultado as $value){
                $idPlano =  $value['id_plano'];
                $nomePlano =  $value['plano'];
        ?>
        <option value="<?= $idPlano?>"> <?=$nomePlano?> </option>
        <?php }?>
    </select>

    <p>TIPO DE CLIENTE</p>
    <select class="form-control form-control-sm" id="tipo_cliente"  name="id_tipo_cliente">
        <?php
              
        $pdo = Conexao::getConn();
        $sql = "SELECT * FROM tbclientes_tipo";
        $resultado = $pdo->query($sql);

            foreach($resultado as $value){
                $idClienteTipo =  $value['id_tipo'];
                $nomeClienteTipo =  $value['cliente_tipo'];
        ?>
        <option value="<?= $idClienteTipo ?>"> <?php echo ($nomeClienteTipo)?> </option>
        <?php }?>
    </select>


<h4>Possui tanques para abastecimento interno? </h4>

<div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" name="flag_tanque" id="sim" value="1">
  <label class="form-check-label" for="sim">Sim</label>
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" name="flag_tanque" id="nao" value="0" checked>
  <label class="form-check-label" for="nao">Não</label>
</div>

<br>

   Razão social <input type="text" name="razao_social"  maxlength="60">  
   Nome do Usuário <input type="text" name="nome_usuario"  maxlength="40">  
    <br><br>
   Email <input type="email" name="email" maxlength="40">  
    <br><br>
   Senha <input type="password" name="senha" maxlength="40">
    <br><br>

    CNPJ/CPF <input type="text" class="cnpj" name="documento">
    <br><br>

    Endereço <input type="text" name="endereco">
    <br><br>


    Contato <input type="text" name="contato">
    <br><br>
    <a href="javascript:history.back()" class="btn btn-secondary btn-sm">Voltar</a>
    <input class="btn btn-primary" type="submit" value="Enviar">
</form>
</div>
</body>
<html>