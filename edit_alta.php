<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('location: index.php');
    exit;
}
require_once("templates/header.php");
require_once("models/usuario.php");
require_once("models/internacao.php");
require_once("dao/usuarioDao.php");
require_once("dao/internacaoDao.php");
include("array_dados.php");

$internacao = new internacao();
$userDao = new UserDAO($conn, $BASE_URL);
$internacaoDao = new internacaoDAO($conn, $BASE_URL);

// Receber id do usuário
$id_internacao = filter_input(INPUT_GET, "id_internacao");
$internacao = $internacaoDao->findById($id_internacao);

$Internacao_geral = new internacaoDAO($conn, $BASE_URL);
$internacao = $internacaoDao->joininternacaoHospitalshow($id_internacao);
extract($internacao);
?>

<!-- formulario alta -->
<div id="main-container" class="container-fluid">
    <div class="row">
        <h4 class="page-title">Alta Hospitalar</h4>
        <p class="page-description">Adicione informações sobre o internacao</p>
        <form class="formulario" action="<?= $BASE_URL ?>process_internacao.php" id="add-movie-form" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="type" value="update">
            <div class="form-group col-sm-3">
                <input type="hidden" class="form-control" id="id_internacao" name="id_internacao" value="<?= $id_internacao ?>">
            </div>
            <div class="form-group col-sm-3">
                <label class="control-label" for="data_alta_int">Hospital</label>
                <input type="text" class="form-control" value="<?= $nome_hosp ?>">
            </div>
            <div class="form-group col-sm-3">
                <label class="control-label" for="data_alta_int">Paciente</label>
                <input type="text" class="form-control" value="<?= $nome_pac ?>">
            </div>
            <div class="row">
                <div class="form-group col-sm-2">
                    <label class="control-label" for="data_alta_int">Data Alta</label>
                    <input type="date" class="form-control" value='<?php echo date('d/m/Y') ?>' id="data_alta_int" name="data_alta_int" placeholder="" required>
                </div>
                <div class="form-group col-sm-2">
                    <input type="hidden" class="form-control" value="Não" id="internado_int" name="internado_int" placeholder="">
                </div>
                <div class="form-group col-sm-2">
                    <input type="hidden" class="form-control" value='<?php echo date('d/m/Y') ?>' id="data_visita_int" name="data_visita_int" placeholder="">
                </div>
                <div class="form-group col-sm-2">
                    <input type="hidden" class="form-control" value='<?php echo date('d/m/Y') ?>' id="data_create_int" name="data_create_int" placeholder="">
                </div>
                <div class="form-group col-sm-3">
                    <input type="hidden" value="<?= $_SESSION['username']; ?>" class="form-control" id="usuario_create_int" name="usuario_create_int" placeholder="Digite o usuário">
                </div>
                <div class="form-group col-sm-2">
                    <label class="control-label" for="tipo_alta_int">Tipo de alta</label>
                    <select class="form-control" id="tipo_alta_int" name="tipo_alta_int" required>
                        <option value="">Selecione o motivo da alta</option>
                        <?php
                        sort($dados_alta, SORT_ASC);
                        foreach ($dados_alta as $alta) { ?>
                            <option value="<?= $alta; ?>"><?= $alta; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <br>
            </div>
            <br>
            <button style="margin:10px" type="submit" class="btn-sm btn-info">Atualizar</button>
            <br>
    </div>
    </form>
</div>
<!-- <script>
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

        if (!["Backsinte", "Delete"].includes(tecla)) {
            return false;
        }
    }
</script> -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

<?php include_once("diversos/backbtn_internacao.php"); ?>

<?php
include_once("templates/footer.php");
?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>

</html>