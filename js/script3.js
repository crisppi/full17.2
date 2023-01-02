// FORMULARIO DE PESQUISA DA TELA LISTA ANTECEDENTE
let frm = $('#minhaForm');
frm.submit(function(event) {
    let action = $(frm.attr('action'));
    var form_status = $('<div id="form_pesquisa"></div>');
    $(this).prepend(form_status);


});