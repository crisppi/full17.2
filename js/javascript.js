function SubmeterFormulario(id_formulario) {

    let frm = $('#' + id_formulario);

    let idAcoes = (document.getElementById('id-confirmacao'));
    idAcoes.style.display = 'block';
    console.log("chegou aqui");
    console.log($(id_formulario).attr('href'));

    frm.submit(function (event) {
        // IMPEDE O ENVIO DOR FORMULARIO
        event.preventDefault();

        // SUMISSAO O FORMULARIO VIA AJAX
        $.ajax({
            type: frm.attr('method'),
            url: frm.attr('action'),
            data: frm.serialize(),

            //SUCESSO
            success: function (i) {
                $('#info').html('Enviado com sucesso')
            },
            //ERROR 
            error: function () {
                $('#info').html('Aconteceu um erro!!!')

            }

        }

        );
    })
}