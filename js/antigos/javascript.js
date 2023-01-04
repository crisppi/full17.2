function SubmeterFormulario() {

    let frm = $('#minhaForm');

    // let idAcoes = (document.getElementById('id-confirmacao'));
    // idAcoes.style.display = 'block';
    console.log("chegou aqui");
    console.log(frm);

    frm.submit(function (e) {
        // IMPEDE O ENVIO DOR FORMULARIO
        e.preventDefault();

        // SUMISSAO O FORMULARIO VIA AJAX

        var txt = $(this).serialize();
        console.log(txt);
        $.ajax({
            type: frm.attr('method'),
            url: frm.attr('action'),
            data: frm.serialize(),

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
    })
}

