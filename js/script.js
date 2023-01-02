$("#data-confirm").click((event) => {
    event.preventDefault();

    $.POST("jj.php", function(result, status) {
        console.log("ENTROU NO SCRIPT");
        console.log(result);
        console.log(status);
    });
})