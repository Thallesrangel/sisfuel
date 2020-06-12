<?php
namespace App\view\layout;

if(isset($_SESSION['mensagem'])){
    
    #  Registro excluído com sucesso
    if ($_SESSION['mensagem'] == 'registro_excluido') {
        echo "<div id='msg' class='alert alert-success' role='alert'>
            <a href='#' class='close' data-dismiss='alert' aria-label='close'>  &nbsp <i class='fa fa-times' aria-hidden='true'></i></a>
            Registro excluído com sucesso.
            </div>";    
    }

    #  Houve um erro ao tentar deletar o registro
    if ($_SESSION['mensagem'] == 'erro_deletar') {
        echo "<div id='msg' class='alert alert-danger' role='alert'>
            <a href='#' class='close' data-dismiss='alert' aria-label='close'>  &nbsp <i class='fa fa-times' aria-hidden='true'></i></a>
            Houve um erro ao tentar deletar o registro
            </div>";    
    }

    #  ID não informado ou não existe
    if ($_SESSION['mensagem'] == 'id_inexistente') {
        echo "<div id='msg' class='alert alert-warning' role='alert'>
            <a href='#' class='close' data-dismiss='alert' aria-label='close'>  &nbsp <i class='fa fa-times' aria-hidden='true'></i></a>
            ID não informado ou inexistente.
            </div>";    
    }

    # Registrado com sucesso
    if ($_SESSION['mensagem'] == 'registrado') {
        echo "<div id='msg' class='alert alert-success' role='alert'>
            <a href='#' class='close' data-dismiss='alert' aria-label='close'>  &nbsp <i class='fa fa-times' aria-hidden='true'></i></a>
            Registrado com sucesso.
            </div>";    
    }

    # Erro ao tentar registrar
    if ($_SESSION['mensagem'] == 'erro_registrar') {
        echo "<div id='msg' class='alert alert-success' role='alert'>
            <a href='#' class='close' data-dismiss='alert' aria-label='close'>  &nbsp <i class='fa fa-times' aria-hidden='true'></i></a>
            Erro ao tentar cadastrar.
            </div>";    
    }

    # Erro ao editar registro
    if ($_SESSION['mensagem'] == 'erro_editar') {
        echo "<div id='msg' class='alert alert-success' role='alert'>
            <a href='#' class='close' data-dismiss='alert' aria-label='close'>  &nbsp <i class='fa fa-times' aria-hidden='true'></i></a>
            Erro ao editar registro.
            </div>";    
    }

    # Registro atualizado com sucesso
    if ($_SESSION['mensagem'] == 'editado_sucesso') {
    echo "<div id='msg' class='alert alert-success' role='alert'>
        <a href='#' class='close' data-dismiss='alert' aria-label='close'>  &nbsp <i class='fa fa-times' aria-hidden='true'></i></a>
        Registro atualizado com sucesso.
        </div>";    
    }

    
    # Usado no login para validar email ou senha - caso incorreto exibir
    if ($_SESSION['mensagem'] == 'email_senha_incorreto') {
        echo "<div id='msg' class='alert alert-danger' role='alert'>
            <a href='#' class='close' data-dismiss='alert' aria-label='close'>  &nbsp <i class='fa fa-times' aria-hidden='true'></i></a>
            E-mail ou Senha incorretos.
            
            </div>";    
    }

    # Usado na view tanque e view home para mostrar se o tanque tem mais mov_saida do que entrada caso tenha exibir
    if ($_SESSION['mensagem'] == 'combustivel_faltando') {
        echo "<div id='msg' class='alert alert-danger' role='alert'>
            <a href='#' class='close' data-dismiss='alert' aria-label='close'>  &nbsp <i class='fa fa-times' aria-hidden='true'></i></a>
                Há tanque(s) com quatidade total de combustível negativo. Favor adicionar no movimento de entrada.

                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                </button>
            </div>";    
    }

}
?>

<script>
    $("#msg").fadeTo(8000, 500).slideUp(400, function(){
        $("#msg").slideUp(2000);
    });
</script>