function submeterFomulario(id_formulario) {
    let frm = $('#' + id_formulario);
    let idAcoes = (document.getElementById('id-confirmacao'));
    idAcoes.style.display = 'block';
    console.log("chegou aqui");

    frm.submit(function (e) {
        // IMPEDE O ENVIO DOR FORMULARIO
        e.preventDefault();

        // SUMISSAO O FORMULARIO VIA AJAX
        $.ajax({
            type: frm.attr('method'),
            url: frm.attr('action'),
            data: frm.serialize(),

            //SUCESSO
            success: function (i) {
                console.log('dados inseridos com sucesso');
                console.log(i);
            },
            //ERROR 
            error: function () {
                console.log('dados inseridos com sucesso');

            }

        }

        );
    })
}