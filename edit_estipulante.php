<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('location: index.php');
    exit;
}
require_once("models/usuario.php");
require_once("models/estipulante.php");
require_once("dao/usuarioDao.php");
require_once("dao/estipulanteDao.php");
require_once("templates/header.php");

$user = new Estipulante();
$userDao = new UserDAO($conn, $BASE_URL);
$estipulanteDao = new estipulanteDAO($conn, $BASE_URL);

// Receber id do usuário
$id_estipulante = filter_input(INPUT_GET, "id_estipulante");

$estipulante = $estipulanteDao->findById($id_estipulante);

?>

<!-- formulario update -->
<div id="main-container" class="container-fluid">
    <div class="row">
        <h1 class="page-title">Atualizar Estipulante</h1>
        <p class="page-description">Adicione informações sobre o Estipulante</p>
        <form class="formulario" action="<?= $BASE_URL ?>process_estipulante.php" id="add-movie-form" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="type" value="update">
            <div class="form-group row">

                <input type="hidden" class="form-control" id="id_estipulante" name="id_estipulante" value="<?= $estipulante->id_estipulante ?>" placeholder="ID">

                <div class="form-group col-sm-4">
                    <label for="estipulanteNome">Nome</label>
                    <input type="text" style="font-size:13px; font-weight:600" class="form-control" id="nome_est" value="<?= $estipulante->nome_est ?>" name="nome_est" placeholder="Digite o Hospital" required>
                </div>


            </div>
            <div class="form-group row">
                <div class="form-group col-sm-3">
                    <label for="endereco_est ">Endereço</label>
                    <input type="text" class="form-control" id="endereco_est " value="<?= $estipulante->endereco_est  ?>" name="endereco_est " placeholder="Digite a endereco">
                </div>
                <div class="form-group col-sm-3">
                    <label for="numero_est ">Número</label>
                    <input type="text" class="form-control" id="numero_est " value="<?= $estipulante->numero_est  ?>" name="numero_est " placeholder="Digite o numero">
                </div>
                <div class="form-group col-sm-3">
                    <label for="bairro_est ">Bairro</label>
                    <input type="text" class="form-control" id="bairro_est " name="bairro_est " value="<?= $estipulante->bairro_est ?>" placeholder="Digite o bairro">
                </div>
                <div class="form-group col-sm-3">
                    <label for="cidade_est">Cidade</label>
                    <input type="text" class="form-control" id="cidade_est" value="<?= $estipulante->cidade_est ?>" name="cidade_est" placeholder="Digite a cidade">
                </div>
            </div>
            <div class="form-group row">
                <div class="form-group col-sm-1">
                    <label for="cnpj_est">CNPJ</label>
                    <input type="text" oninput="mascara(this, 'cnpj')" value="<?= $estipulante->cnpj_est ?>" class="form-control" id="cnpj_est" name="cnpj" placeholder="Digite a cnpj">
                </div>
                <div class="form-group col-sm-2">
                    <label for="email01_est">email01</label>
                    <input type="email" class="form-control" id="email01_est" value="<?= $estipulante->email01_est ?>" name="email01_est" placeholder="Digite a email01">
                </div>
                <div class="form-group col-sm-2">
                    <label for="email02_est">email02</label>
                    <input type="email" class="form-control" id="email02_est" value="<?= $estipulante->email02_est ?>" name="email02_est" placeholder="Digite a email02">
                </div>
                <div class="form-group col-sm-2">
                    <label for="telefone01_est">Telefone</label>
                    <input type="text" onkeydown="return mascaraTelefone(event)" value="<?= $estipulante->telefone01_est ?>" class="form-control" id="telefone01_est" name="telefone01_est" placeholder="Digite o telefone">
                </div>
                <div class="form-group col-sm-2">
                    <label for="telefone02">Telefone</label>
                    <input type="text" onkeydown="return mascaraTelefone(event)" value="<?= $estipulante->telefone02_est ?>" class="form-control" id="telefone02_est" name="telefone02_est" placeholder="Digite outro telefone">
                </div>

                <div class="form-group col-sm-2">
                    <label for="data_create_est">Data</label>
                    <input type="date" type="hidden" class="form-control" value='<?php echo date("d/m/Y"); ?>' id="data_create_est" name="data_create_est" placeholder="">
                </div>
                <div class="form-group col-sm-4">
                    <label for="usuario_create_est">Usuário</label>
                    <input type="text" class="form-control" id="usuario_create_est" name="usuario_create_est" placeholder="Digite o usuário">
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

<?php include_once("diversos/backbtn_estipulante.php"); ?>

<?php
include_once("templates/footer.php");
?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>

</html>