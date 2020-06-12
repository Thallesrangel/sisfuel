
<div class="container">
<div class="starter-template height-100">
  <h4>Solicitar Suporte Técnico</h4>
  <form action="<?=DIRPAGE.'/suporte/registrar/'?>" method="POST">
  
    <div class="form-group">
      <p>Requerente: <?php echo $_SESSION['nome_usuario']; ?></p>
    </div>

    <div class="form-group col-6">
      <span>Título</span> 
      <input  maxlength="40" placeholder="Título" type="text" name="titulo" class="form-control form-control-sm">
    </div>

    <div class="form-group col-6">
      <span>Descrição</span>
      <textarea id="descricao" maxlength="250" rows="5"  style="resize: none" placeholder="Descreva brevemente - Limite de 300 caracteres"
       name="descricao" class="form-control form-control-sm"></textarea>
      <span id="qtdRestante"></span> 
    </div>

    <div class="form-group col-6">
      <span>Arquivo</span> 
  
      <input id="arquivo" type="file" name="titulo" class="form-control form-control-sm">
      <span id="label" style= "color: red;"> </span> 
      <br>
      <span>Tamanho máximo do arquivo: 2 MB </span> 
      <br>
      <span>Formatos válidos: PDF, JPGE, JPG</span>
    </div>

      <a href="javascript:history.back()" class="btn btn-secondary btn-sm"">Cancelar</a>
      <input id="solicitar" class="btn btn-success btn-sm" type="submit" value="Solicitar">
    
      
  </form>
</div>
</div>

<script>
//Conta a quantidade de caracteres textarea

$('#descricao').keydown(function () {
  var max = 250;
  var len = $(this).val().length;
  if (len >= max) {
    $('#qtdRestante').text('Você chegou ao limite máximo de caracteres.');
  } else {
    var char = max - len;
    $('#qtdRestante').text(char + ' Caracter restante.');
  }
});


//Valida formatos de arquivo

var file_onchange = function () {
  var input = this;

  if (input.files && input.files[0]) {
    var type = input.files[0].type; 

    
    var type_reg = /^image\/(jpg|png|jpeg|gif)$/;

    if (type_reg.test(type)) {
      $("#solicitar").removeClass("disabled");
    } else {
      alert('Este tipo de arquivo não é suportado. Adicione um arquivo válido para proseguir.');
      $('#solicitar').reset();
      $("#solicitar").addClass('disabled');
    }
  }
};

$('#arquivo').on('change', file_onchange);


//Verificar tamanho máximo do arquivo

  $('#arquivo').on('change', function() { 
    if (this.files[0].size >= 2097152) { 
      $('#label').text("Faça o upload do arquivo com menos de 2MB");  
    } else { 
      $('#label').text(this.files[0].size + "bytes"); 
    } 
}); 


</script>