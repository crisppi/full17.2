<?php
include_once("check_logado.php");

require_once("models/usuario.php");
require_once("models/hospital.php");
require_once("dao/usuarioDao.php");
require_once("dao/hospitalDao.php");
require_once("templates/header.php");

$user = new hospital();
$userDao = new UserDAO($conn, $BASE_URL);
$hospitalDao = new hospitalDAO($conn, $BASE_URL);

// Receber id do usuário
$id_hospital = filter_input(INPUT_GET, "id_hospital");

$hospital = $hospitalDao->findById($id_hospital);

?>

<!-- formulario update -->
<div id="main-container" class="container-fluid">
    <div class="row">
        <h1 class="page-title">Atualizar hospital</h1>
        <p class="page-description">Adicione informações sobre o hospital</p>
        <form class="formulario" action="<?= $BASE_URL ?>process_hospital.php" id="add-movie-form" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="type" value="update">
            <div class="form-group row">

                <input type="hidden" class="form-control" id="id_hospital" name="id_hospital" value="<?= $hospital->id_hospital ?>" placeholder="ID">

                <div class="form-group col-sm-4">
                    <label for="nome_hosp">Nome</label>
                    <input type="text" class="form-control" id="nome_hosp" value="<?= $hospital->nome_hosp ?>" name="nome_hosp" placeholder="Digite o Hospital" required>
                </div>


            </div>
            <div class="form-group row">
                <div class="form-group col-sm-3">
                    <label for="endereco_hosp">Endereço</label>
                    <input type="text" class="form-control" id="endereco_hosp" value="<?= $hospital->endereco_hosp ?>" name="endereco_hosp" placeholder="Digite a endereco">
                </div>
                <div class="form-group col-sm-3">
                    <label for="numero_hosp">Número</label>
                    <input type="text" class="form-control" id="numero_hosp" value="<?= $hospital->numero_hosp ?>" name="numero_hosp" placeholder="Digite o numero">
                </div>
                <div class="form-group col-sm-3">
                    <label for="bairro_hosp">Bairro</label>
                    <input type="text" class="form-control" id="bairro_hosp" name="bairro_hosp" value="<?= $hospital->bairro_hosp ?>" placeholder="Digite o bairro">
                </div>
                <div class="form-group col-sm-3">
                    <label for="cidade_hosp">cidade_hosp</label>
                    <input type="text" class="form-control" id="cidade_hosp" value="<?= $hospital->cidade_hosp ?>" name="cidade_hosp" placeholder="Digite a cidade">
                </div>
            </div>
            <div class="form-group row">
                <div class="form-group col-sm-1">
                    <label for="cnpj_hosp">CNPJ</label>
                    <input type="text" oninput="mascara(this, 'cnpj')" value="<?= $hospital->cnpj_hosp ?>" class="form-control" id="cnpj_hosp" name="cnpj_hosp" placeholder="Digite a cnpj">
                </div>
                <div class="form-group col-sm-2">
                    <label for="email01_hosp">email01</label>
                    <input type="email" class="form-control" id="email01_hosp" value="<?= $hospital->email01_hosp ?>" name="email01_hosp" placeholder="Digite o email principal">
                </div>
                <div class="form-group col-sm-2">
                    <label for="email02_hosp">email02</label>
                    <input type="email" class="form-control" id="email02_hosp" value="<?= $hospital->email02_hosp ?>" name="email02_hosp" placeholder="Digite a email02">
                </div>
                <div class="form-group col-sm-2">
                    <label for="telefone01_hosp">Telefone</label>
                    <input type="text" onkeydown="return mascaraTelefone(event)" value="<?= $hospital->telefone01_hosp ?>" class="form-control" id="telefone01_hosp" name="telefone01_hosp" placeholder="Digite o telefone">
                </div>
                <div class="form-group col-sm-2">
                    <label for="telefone02">Telefone</label>
                    <input type="text" onkeydown="return mascaraTelefone(event)" value="<?= $hospital->telefone02_hosp ?>" class="form-control" id="telefone02" name="telefone02" placeholder="Digite outro telefone">
                </div>

                <div class="form-group col-sm-4">
                    <input type="data" type="hidden" class="form-control" value='<?php echo date("d/m/Y"); ?>' id="data_create" name="data_create" placeholder="">
                </div>
                <div class="form-group col-sm-4">
                    <input type="text" class="form-control" id="usuario_create" name="usuario_create" placeholder="Digite o usuário">
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

<?php include_once("diversos/backbtn_hospital.php"); ?>

<?php
include_once("templates/footer.php");
?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>

</html>