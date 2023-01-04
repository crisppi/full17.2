$("form").on("submit", function(event) {
    event.preventDefault();
    // processamento do formulario

    // FORMULARIO DE DELETE DA TELA LISTA ANTECEDENTE
    console.log("chegou no prevents");
    //let action = $(frm.attr('action'));
    var form_status = $('<div id="minhaForm"></div>');
    $(this).prepend(form_status);

    console.log($(this).attr('action'));

    if ($("#confirmado").val() == 'nao') {

        apareceOpcoes();

        $.ajax({
                type: "GET",
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: 'json',
                //SUCESSO
                success: function(data) {
                    $('#info').html('Enviado com sucesso')
                    console.log($(this).serialize());
                    console.log("dentro do sucesss");

                },
                //ERROR 
                error: function(data) {
                    $('#info').html('Aconteceu um erro!!!')

                }

            }

        );
    }



});


// FORMULARIO DE PESQUISA DA TELA LISTA ANTECEDENTE
let frm_pesq = $('#form_pesquisa');
frm_pesq.submit(function(event) {
    let action = $(frm_pesq.attr('action'));
    var form_status_pesq = $('<div id="form_pesquisa"></div>');
    $(this).prepend(form_status_pesq);


    if ($("#pesquisa").val() = 'sim') {
        $.ajax({
                type: "POST",
                url: $(this).attr('action'),
                data: $(this).serialize(),

                //SUCESSO
                success: function(data) {
                    $('#info').html('Enviado com sucesso');

                },
                //ERROR 
                error: function(data) {
                    $('#info').html('Aconteceu um erro!!!')

                }

            }

        )

    }

});




src = "js/script.js"