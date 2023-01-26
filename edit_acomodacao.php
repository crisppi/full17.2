<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('location: index.php');
    exit;
}
require_once("models/usuario.php");
require_once("models/acomodacao.php");
require_once("dao/usuarioDao.php");
require_once("dao/acomodacaoDao.php");
require_once("templates/header.php");

$user = new acomodacao();
$userDao = new UserDAO($conn, $BASE_URL);
$acomodacaoDao = new acomodacaoDAO($conn, $BASE_URL);

// Receber id do usuário
$id_acomodacao = filter_input(INPUT_GET, "id_acomodacao");

$acomodacao = $acomodacaoDao->joinAcomodacaoHospitalshow($id_acomodacao);

?>

<!-- formulario update -->
<div id="main-container" class="container-fluid">
    <div class="row">
        <h1 class="page-title">Atualizar acomodação</h1>
        <p class="page-description">Selecione as informações sobre a acomodação</p>
        <form class="formulario" action="<?= $BASE_URL ?>process_acomodacao.php" id="add-movie-form" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="type" value="update">
            <div class="form-group row">

                <input type="hidden" class="form-control" id="id_acomodacao" name="id_acomodacao" value="<?= $acomodacao['id_acomodacao'] ?>" placeholder="ID">


                <div class="form-group col-sm-2">
                    <label class="control-label" for="acomodacao_aco">Acomodação</label>
                    <select class="form-control" style="overflow:visible" id="acomodacao_aco" name="acomodacao_aco">
                        <option value=<?= $acomodacao['acomodacao_aco'] ?>><?= $acomodacao['acomodacao_aco'] ?></option>
                        <option value="UTI">UTI</option>
                        <option value="Semi">Semi</option>
                        <option value="Apto">Apto</option>
                        <option value="Enfermaria">Enfermaria</option>
                        <option value="Uco">Uco</option>
                        <option value="Maternidade">Maternidade</option>
                        <option value="Berçário">Berçário</option>
                    </select>
                </div>
                <div class="form-group col-sm-2">
                    <label class="control-label" for="fk_hospital">Hospital</label>
                    <select class="form-control" id="fk_hospital" name="fk_hospital">
                        <option value="<?= $acomodacao['fk_hospital'] ?>"><?= $acomodacao['nome_hosp'] ?></option>

                        <?php foreach ($hospitals as $hospital) : ?>
                            <option value="<?= $hospital["id_hospital"] ?>"><?= $hospital["nome_hosp"] ?></option>
                        <?php endforeach; ?>
                    </select>

                </div>

                <div class="form-group col-sm-2">
                    <label for="valor_diaria">Valor Diária</label>
                    <input type="text" class="form-control" id="valor_aco" value="<?= $acomodacao['valor_aco'] ?>" name="valor_aco" placeholder="Digite diária" required>
                </div>

                <div>
                    <button style="margin:10px" type="submit" class="btn-sm btn-info">Atualizar</button>
                </div>
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

<?php include_once("diversos/backbtn_acomodacao.php"); ?>

<?php
include_once("templates/footer.php");
?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>

</html>