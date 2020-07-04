
$(document).ready(function() {
    $('.js-select').select2();
});

$(document).ready( function () {
    $('#table').DataTable( {
        "language": {
            "lengthMenu": "_MENU_ registros por página",
            "zeroRecords": "Nenhum registro encotrado",
            "info": "Mostrando página _PAGE_ de _PAGES_",
            "infoEmpty": "Nenhum registro disponível",
            "infoFiltered": "(Filtrado de _MAX_ registros no total)",
            "sSearch": "Pesquisar",
            "oPaginate": {
                "sNext": "Próximo",
                "sPrevious": "Anterior",
                "sFirst": "Primeiro",
                "sLast": "Último"
            },
        },

    } );
});

$(document).ready(function(){
    $('.telefone').mask('(00) 0000-0000');
    $('.data').mask("00/00/0000", {placeholder: "__/__/____"});
    $('.porcentagem').mask('##0,00%', {reverse: true});
    $('.quantidade').mask('000.000.000,00', {reverse: true});
    $('.valor-unitario').mask('000,00', {reverse: true});
    $('.valor-limite').mask('000.000,00', {reverse: true});
    $('.cnpj').mask('00.000.000/0000-00', {reverse: true});
    $('.cpf').mask('000.000.000-00', {reverse: true});
});



/*
*   Retorna o tempo de carregamento da paǵina
*/
let pagina = {
   tempo: window.performance.now()
}

window.onload = function() {
    console.log(pagina.tempo)
}
    $(document).ready(function($){
  
      let traducao = {
        firstDayOfWeek: 1,
        weekdays: {
          shorthand: ["Dom", "Seg", "Ter", "Qua", "Qui", "Sex", "Sáb"],
          longhand: ["Domingo", "Segunda", "Terça", "Quarta", "Quinta", "Sexta", "Sábado"],
        }, 
        months: {
          shorthand: ["Jan", "Fev", "Mar", "Abr", "Mai", "Jun", "Jul", "Ago", "Set", "Out", "Nov", "Dez"],
          longhand: ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto","Setembro", "Outubro", "Novembro", "Dezembro"],
        },
      };
  
      $('[date-input="d/m/y"]').flatpickr({
        dateFormat: "d/m/Y",
        locale:traducao
      });
  
      $('[date-input="d/m/y h:i"]').flatpickr({
        enableTime: true,
        dateFormat: "d/m/Y H:i",
        enableSeconds: false,
        time_24hr: true,
        locale:traducao
      });
  
      $('[date-input="h:i:s"]').flatpickr({
        enableTime: true,
        enableSeconds: true,
        dateFormat: "H:i:S",
        time_24hr: true,
        locale:traducao
      });
    });