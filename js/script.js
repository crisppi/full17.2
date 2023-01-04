$("form#minhaForm").on("submit", function(event) {
    event.preventDefault();
    let dados = $(this).serialize();
    console.log(dados);

    $('#deletar-btn').val('nao');
    let mudancaStatus = ($('#deletar-btn').val())
        //console.log(mudancaStatus);

    let idAcoes = (document.getElementById('id-confirmacao'));
    idAcoes.style.display = 'block';

    if ($('#deletar-btn').val() == 'nao') {
        let ac = (document.getElementById('id-confirmacao'));
        ac.addEventListener("click", function() {
            //console.log("clicou");
            $('#deletar-btn').val('ok');

            if ($('#deletar-btn').val() == 'ok') {
                $.ajax({
                        type: 'POST',
                        url: $(this).attr('action'),
                        data: dados,

                        //SUCESSO
                        success: function(data) {
                            //$('#info').html('Enviado com sucesso');
                            console.log("dentro do sucesss!!!!!!");
                            console.log(dados);
                            //console.log(dados);
                            $('#deletar-btn').val('nao');
                        },

                        //ERROR 
                        error: function(data) {
                            $('#info').html('Aconteceu um erro!!!')

                        }

                    }

                );
            }
        });
    }


})