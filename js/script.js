$("form").on("submit", function(event) {
    event.preventDefault();

    apareceOpcoes();

    $.ajax({
            type: "GET",
            url: $(this).attr('action'),
            data: $(this).serialize(),

            //SUCESSO
            success: function(data) {
                $('#info').html('Enviado com sucesso')
                console.log($(this).serialize());
                console.log("dentro do sucesss");
                console.log(data);

            },
            //ERROR 
            error: function(data) {
                $('#info').html('Aconteceu um erro!!!')

            }

        }

    );

})