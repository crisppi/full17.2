$('form#minhaForm').submit(function(e) {
    e.preventDefault();

    $.ajax({
        url: 'tratar.php',
        type: 'post',
        dataType: 'html',
        data: $(this).serialize(),
    }).done(function(data) {
        let idAcoes = (document.getElementById('id-confirmacao'));
        idAcoes.style.display = 'block';
        alert(data);
        $('#id_antecedente').val('');
        $('#confirmado').val('');
        $('#type').val('');

    });

});