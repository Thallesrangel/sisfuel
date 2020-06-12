<?php
    require_once (DIRREQ."/app/view/layout/head.php");
    # Mensagens
    require_once(DIRREQ.'/app/view/layout/mensagens.php');
    unset($_SESSION["mensagem"]);
?>
<link href="https://fonts.googleapis.com/css?family=Barlow&display=swap" rel="stylesheet">

<style>
body{
	background-color: #ecf0f1;
    font-family: 'Barlow', sans-serif;
    backgroind: 
}
.tamanho-largura {
    max-width: 350px;
    height: auto;
    background: #FFF;
    padding: 2%;
    margin-top: 6%;
    border: 2px solid #ecf0f1; 
    border-radius: 10px;
}
.tamanho-largura button{
	padding: 3% 0%;
}
.btnLoginEntrar{
    color: #FFF;
    background: #1abc9c;
    font-size: 18px;
}
.btnLoginEntrar:hover{
    background: #16a085;
}

</style>

 <div class="container tamanho-largura shadow-lg p-3 mb-5 bg-white rounded">
        
    <div class="d-flex justify-content-center">
        <img class="img-fluid" src="<?=DIRIMG . 'logo.png'?>">
    </div>
    
    <br>

    <form action="<?=DIRPAGE.'/login/logar'?>" method="POST" id="form" autocomplete="off">

        <div class="form-group">
            <label>E-mail</label>
            <input class="form-control" type="email" name="email" placeholder="Digite seu e-mail"
                autocomplete="off" id="campo" required autofocus/>
        </div>

        <div class="form-group">
            <label>Senha</label>
            <input class="form-control" type="password" name="senha" placeholder="Digite sua senha" autocomplete="off" required/>
        </div>

        <div class="row">

            <div class="col-12">
                    <button type="submit" class="btn btn-default btn-sm btn-block btnLoginEntrar">Entrar</button>
            </div>	
          
        </div>

        <br>
        <p><a class="d-flex justify-content-center" href="<?=DIRPAGE.'/cliente'?>">Não possui cadastro? Clique aqui.</a></p>
        <p><a class="d-flex justify-content-center" href="<?=DIRPAGE.'/usuario/recuperar/'?>">Recuperar acesso.</a></p>
    </form>
</div>



<!--
    Ajax login
<script>

$(function() {

    $('#form').on('submit', function(e)
    {
        e.preventDefault();

        var email = $('input[name=email]').val();
        var senha = $('input[name=senha').val();

        $.ajax({
            type: 'POST',
            url: '<=DIRPAGE.'/login/logar'?>',
            data: {email:email, senha:senha},
            sucess:function(msg) {
               alert(msg)
            }
        });
    });
});
</script> -->