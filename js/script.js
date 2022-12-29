<script>

    const btn = document.querySelector("#send");
    btn.addEventListener("click", function(e) {
        e.preventDefault();
    const name = document.querySelector("#entrada");
    console.log(name)
    const value = name.value;
    console.log(value);
    alert("var ID : " + value);


        });

</script>