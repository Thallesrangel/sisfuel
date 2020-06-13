<?php
use App\model\Conexao;
?>

<div class="container">
<div class="starter-template height-100">
  <h4>Cadastro de usuário</h4>
  
  <form action="<?=DIRPAGE.'/usuario/registrar/'?>" method="POST">
    <div class="row">
  
      <div class="col-3">
        <div class="form-group">
          <span>Permissão</span> 
            <select class="form-control form-control-sm" name="id_acesso">
            <?php
  
            $pdo = Conexao::getConn();
            $sql = "SELECT id_acesso, nome_acesso FROM tbnivel_acesso";
            $permissoes = $pdo->query($sql);
        
              foreach($permissoes as $permissao){
                $idAcesso =  $permissao['id_acesso'];
                $nomeAcesso =  $permissao['nome_acesso'];
              ?>
              <option value="<?= $idAcesso ?>"> <?php echo $nomeAcesso?> </option>
              <?php }?>
            </select>
          </div>  
        </div>
    </div>

    <div class="row">
      
      <div class="col-4">
        <div class="form-group">
          <span>Nome:</span>
          <input  maxlength="30" type="int"  placeholder="Digite o nome completo" name="nome" required class="form-control form-control-sm">
        </div>

        <div class="form-group">
          <label>E-mail</label>
          <input class="form-control form-control-sm" type="email" name="email" placeholder="Digite o e-mail do usuário" required />
        </div>

        <div class="form-group">
          <label>Senha</label>
          <input class="form-control form-control-sm" type="password" name="senha" placeholder="Digite uma senha provisória" required />
        </div>

        <div class="form-group">
          <span>Contato:</span>
          <input  maxlength="10" type="int"  placeholder="Digite seu contato" name="text" required class="form-control form-control-sm telefone">
        </div>

      </div>

    </div>
    <h5>Permissões de Acesso</h5>
    <div class="form-check">
      <input class="form-check-input" name="permissoes[]" type="checkbox" value="1" id="movimentoEntrada">
      <label class="form-check-label" for="movimentoEntrada">Movimento de Entrada</label>
    </div>
    

    <div class="form-check">
      <input class="form-check-input"  name="permissoes[]" type="checkbox" value="2" id="movimentoSaida">
      <label class="form-check-label" for="movimentoSaida">Movimento de Saída</label>
    </div>

    <div class="form-check">
      <input class="form-check-input"  name="permissoes[]" type="checkbox" value="3" id="abastecimento">
      <label class="form-check-label" for="abastecimento">Abastecimento</label>
    </div>

    <div class="form-check">
      <input class="form-check-input"  name="permissoes[]" type="checkbox" value="4" id="movimentoTransito">
      <label class="form-check-label" for="movimentoTransito">Movimento em Trânsito</label>
    </div>

    <div class="form-check">
      <input class="form-check-input"  name="permissoes[]" type="checkbox" value="5" id="ticketAbastecimento">
      <label class="form-check-label" for="ticketAbastecimento">Ticket de Abastecimento</label>
    </div>

    <div class="form-check">
      <input class="form-check-input"  name="permissoes[]" type="checkbox" value="6" id="cartaoVirtual">
      <label class="form-check-label" for="cartaoVirtual">Cartão Virtual</label>
    </div>

    <div class="form-check">
      <input class="form-check-input"  name="permissoes[]" type="checkbox" value="7" id="seguro">
      <label class="form-check-label" for="seguro">Seguro</label>
    </div>

    <div class="form-check">
      <input class="form-check-input"  name="permissoes[]" type="checkbox" value="8" id="ipva">
      <label class="form-check-label" for="ipva">Ipav</label>
    </div>

    <div class="form-check">
      <input class="form-check-input"  name="permissoes[]" type="checkbox" value="8" id="manutencaoVeiculo">
      <label class="form-check-label" for="manutencaoVeiculo">Manutenção Veículo</label>
    </div>


    <br><br>
    <a href="javascript:history.back()" class="btn btn-secondary btn-sm"">Voltar</a>
    <input id="solicitar" class="btn btn-success btn-sm" type="submit" value="Registrar">
  
  </form>
</div>
</div>