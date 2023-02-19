<?php
include_once("check_logado.php");

require_once("models/usuario.php");
require_once("models/seguradora.php");
require_once("dao/usuarioDao.php");
require_once("dao/seguradoraDao.php");
require_once("templates/header.php");

$user = new seguradora();
$userDao = new UserDAO($conn, $BASE_URL);
$seguradoraDao = new seguradoraDAO($conn, $BASE_URL);

// Receber id do usuário
$id_seguradora = filter_input(INPUT_GET, "id_seguradora");

$seguradora = $seguradoraDao->findById($id_seguradora);

?>

<!-- formulario update -->
<div id="main-container" class="container-fluid">
    <div class="row">
        <h1 class="page-title">Atualizar seguradora</h1>
        <p class="page-description">Adicione informações sobre o seguradora</p>
        <form class="formulario" action="<?= $BASE_URL ?>process_seguradora.php" id="add-movie-form" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="type" value="update">
            <div class="form-group row">

                <input type="hidden" class="form-control" id="id_seguradora" name="id_seguradora" value="<?= $seguradora->id_seguradora ?>" placeholder="ID">

                <div class="form-group col-sm-4">
                    <label for="seguradora_seg">Nome</label>
                    <input type="text" style="font-size:13px; font-weight:600" class="form-control" id="seguradora_seg" value="<?= $seguradora->seguradora_seg ?>" name="seguradora_seg" placeholder="Digite o seguradora">
                </div>


            </div>
            <div class="form-group row">
                <div class="form-group col-sm-3">
                    <label for="endereco_seg">Endereço</label>
                    <input type="text" class="form-control" id="endereco_seg" value="<?= $seguradora->endereco_seg ?>" name="endereco_seg" placeholder="Digite a endereco">
                </div>
                <div class="form-group col-sm-1">
                    <label for="numero_seg">Número</label>
                    <input type="text" class="form-control" id="numero_seg" value="<?= $seguradora->numero_seg ?>" name="numero_seg" placeholder="Digite o numero">
                </div>
                <div class="form-group col-sm-3">
                    <label for="bairro_seg">Bairro</label>
                    <input type="text" class="form-control" id="bairro_seg" name="bairro_seg" value="<?= $seguradora->bairro_seg ?>" placeholder="Digite o bairro">
                </div>
                <div class="form-group col-sm-3">
                    <label for="cidade_seg">Cidade</label>
                    <input type="text" class="form-control" id="cidade_seg" value="<?= $seguradora->cidade_seg ?>" name="cidade_seg" placeholder="Digite a cidade">
                </div>
            </div>
            <div class="form-group row">
                <div class="form-group col-sm-2">
                    <label for="cnpj_seg">CNPJ</label>
                    <input type="text" oninput="mascara(this, 'cnpj')" value="<?= $seguradora->cnpj_seg ?>" class="form-control" id="cnpj_seg" name="cnpj_seg" placeholder="Digite a cnpj">
                </div>
                <div class="form-group col-sm-2">
                    <label for="email01_seg">email01</label>
                    <input type="email" class="form-control" id="email01_seg" value="<?= $seguradora->email01_seg ?>" name="email01_seg" placeholder="Digite a email01">
                </div>
                <div class="form-group col-sm-2">
                    <label for="email02_seg">email02</label>
                    <input type="email" class="form-control" id="email02_seg" value="<?= $seguradora->email02_seg ?>" name="email02" placeholder="Digite a email02">
                </div>
                <div class="form-group col-sm-2">
                    <label for="telefone01">Telefone</label>
                    <input type="text" onkeydown="return mascaraTelefone(event)" value="<?= $seguradora->telefone01_seg ?>" class="form-control" id="telefone" name="telefone01" placeholder="Digite o telefone">
                </div>
                <div class="form-group col-sm-2">
                    <label for="telefone02_seg">Telefone</label>
                    <input type="text" onkeydown="return mascaraTelefone(event)" value="<?= $seguradora->telefone02_seg ?>" class="form-control" id="telefone02_seg" name="telefone02_seg" placeholder="Digite outro telefone">
                </div>

                <div class="form-group col-sm-2">
                    <label for="data_create_seg">Data</label>
                    <input type="date" type="hidden" class="form-control" value='<?php echo date("d/m/Y"); ?>' id="data_create_seg" name="data_create_seg" placeholder="">
                </div>
                <div class="form-group col-sm-2">
                    <label for="usuario_create_seg">Usuário</label>
                    <input type="text" class="form-control" id="usuario_create_seg" name="usuario_create_seg" placeholder="Digite o usuário">
                </div>
            </div>
            <br>
            <button style="margin:10px" type="submit" class="btn-sm btn-info">Atualizar</button>
            <br>
    </div>
    </form>
</div>
</div>
<script>
    function mascara(i) {

        var v = i.value;

        if (isNaN(v[v.length - 1])) { // impede entrar outro caractere que não seja número
            i.value = v.substring(0, v.length - 1);
            return;
        }

        i.setAttribute("maxlength", "14");
        if (v.length == 3 || v.length == 7) i.value += ".";
        if (v.length == 11) i.value += "-";

    }
</script>
<script>
    function mascara(i, t) {

        var v = i.value;

        if (isNaN(v[v.length - 1])) {
            i.value = v.substring(0, v.length - 1);
            return;
        }

        if (t == "data") {
            i.setAttribute("maxlength", "10");
            if (v.length == 2 || v.length == 5) i.value += "/";
        }

        if (t == "cpf") {
            i.setAttribute("maxlength", "14");
            if (v.length == 3 || v.length == 7) i.value += ".";
            if (v.length == 11) i.value += "-";
        }

        if (t == "cnpj") {
            i.setAttribute("maxlength", "18");
            if (v.length == 2 || v.length == 6) i.value += ".";
            if (v.length == 10) i.value += "/";
            if (v.length == 15) i.value += "-";
        }

        if (t == "cep") {
            i.setAttribute("maxlength", "9");
            if (v.length == 5) i.value += "-";
        }

        if (t == "tel") {
            if (v[0] == 12) {

                i.setAttribute("maxlength", "10");
                if (v.length == 5) i.value += "-";
                if (v.length == 0) i.value += "(";

            } else {
                i.setAttribute("maxlength", "9");
                if (v.length == 4) i.value += "-";
            }
        }
    }

    function mascaraTelefone(event) {
        let tecla = event.key;
        let telefone = event.target.value.replace(/\D+/g, "");

        if (/^[0-9]$/i.test(tecla)) {
            telefone = telefone + tecla;
            let tamanho = telefone.length;

            if (tamanho >= 12) {
                return false;
            }

            if (tamanho > 10) {
                telefone = telefone.replace(/^(\d\d)(\d{5})(\d{4}).*/, "($1) $2-$3");
            } else if (tamanho > 5) {
                telefone = telefone.replace(/^(\d\d)(\d{4})(\d{0,4}).*/, "($1) $2-$3");
            } else if (tamanho > 2) {
                telefone = telefone.replace(/^(\d\d)(\d{0,5})/, "($1) $2");
            } else {
                telefone = telefone.replace(/^(\d*)/, "($1");
            }

            event.target.value = telefone;
        }

        if (!["Backspace", "Delete"].includes(tecla)) {
            return false;
        }
    }
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

<?php include_once("diversos/backbtn_seguradora.php"); ?>

<?php
include_once("templates/footer.php");
?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>

</html>