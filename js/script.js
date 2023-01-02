$("#data-confirm").click((event) => {
    event.preventDefault();

    $.POST("tratar.php", function(result, status) {
        console.log("ENTRO NO SCRIPT");
        console.log(result);
        console.log(status);
    });
})