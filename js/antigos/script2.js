$("form").on("submit", function(event) {
    event.preventDefault();

    $.ajax({
            type: "POST",
            url: "tratar.php",
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