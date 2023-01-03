$("form#minhaForm").on("submit", function(event) {
    event.preventDefault();



    if ($('#deletar-btn').val() == 'ok') {
        console.log("simmmmm");
        $.ajax({
                type: "POST",
                url: 'tratar.php',
                data: $(this).serialize(),

                //SUCESSO
                success: function(data) {
                    $('#info').html('Enviado com sucesso');
                    console.log("dentro do sucesss!!!!!!");
                    //console.log($(this).serialize());
                    $('#deletar-btn').val('nao');
                },

                //ERROR 
                error: function(data) {
                    $('#info').html('Aconteceu um erro!!!')

                }

            }

        );
    }

})