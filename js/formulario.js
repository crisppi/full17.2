$(document).ready(function () {
    $("minhaForm").submit(function (event) {
        var formData = {
            name: $("#name").val(),
            email: $("#email").val(),
            superheroAlias: $("#superheroAlias").val(),
        };

        $.ajax({
            type: "POST",
            url: "process.php",
            data: formData,
            dataType: "json",
            encode: true,
        }).done(function (data) {
            console.log(data);
        });

        event.preventDefault();
    });
});