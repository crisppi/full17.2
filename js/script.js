$("form").on("submit", function (event) {
    event.preventDefault();
    // processamento do formulario
    let frm = $('#minhaForm');
    let action = $(frm.attr('action'));
    var form_status = $('<div id="minhaForm"></div>');

    $(this).prepend(form_status);

    console.log($(this).attr('action'));
    var dados = ($(this).serialize());
    var dados2 = $("#confirmado").val();
    console.log(dados);
    console.log(dados2);

    apareceOpcoes();

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