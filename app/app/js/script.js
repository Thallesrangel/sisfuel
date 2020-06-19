
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


$(document).submit(function(){

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