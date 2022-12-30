function SubmeterFormulario() {

    let frm = $('#minhaForm');

    // let idAcoes = (document.getElementById('id-confirmacao'));
    // idAcoes.style.display = 'block';
    // console.log("chegou aqui");
    frm.submit(function (e) {
        // IMPEDE O ENVIO DOR FORMULARIO
        e.preventDefault();

        // SUMISSAO O FORMULARIO VIA AJAX
        $.ajax({
            type: "POST",
            url: "process_antecedente.php",
            data: serialize(),

            //SUCESSO
            success: function (i) {
                $('#info').html('Enviado com sucesso')
            },
            //ERROR 
            error: function (i) {
                $('#info').html('Aconteceu um erro!!!')

            }

        }

        );
    })
    return false;
}