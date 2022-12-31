// $("form").on("submit", function (event) {
//     event.preventDefault();
// processamento do formulario

// FORMULARIO DE DELETE DA TELA LISTA ANTECEDENTE
let frm = $('#minhaForm');
frm.submit(function (event) {
    event.preventDefault();
    let action = $(frm.attr('action'));
    var form_status = $('<div id="minhaForm"></div>');
    $(this).prepend(form_status);

    console.log($(this).attr('action'));
    var dados = ($(this).serialize());
    var dados2 = $("#confirmado").val();
    console.log(dados);
    if ($("#confirmado").val() = 'nao') {
        console.log(dados2);
        apareceOpcoes();

    }

    $.ajax({
        type: "POST",
        url: $(this).attr('action'),
        data: $(this).serialize(),

        //SUCESSO
        success: function (data) {
            $('#info').html('Enviado com sucesso')
        },
        //ERROR 
        error: function (data) {
            $('#info').html('Aconteceu um erro!!!')

        }

    }

    );

});

// FORMULARIO DE PESQUISA DA TELA LISTA ANTECEDENTE
let frm_pesq = $('#form_pesquisa');
frm_pesq.submit(function (event) {
    let action = $(frm_pesq.attr('action'));
    var form_status_pesq = $('<div id="minhaForm"></div>');
    $(this).prepend(form_status_pesq);

    if ($("#pesquisa").val() = 'sim') {
        $.ajax({
            type: "POST",
            url: $(this).attr('action'),
            data: $(this).serialize(),

            //SUCESSO
            success: function (data) {
                $('#info').html('Enviado com sucesso')
            },
            //ERROR 
            error: function (data) {
                $('#info').html('Aconteceu um erro!!!')

            }

        }

        )

    }

});
