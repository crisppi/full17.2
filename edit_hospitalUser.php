<?php
include_once("check_logado.php");
include_once("check_logado.php");

require_once("templates/header.php");

require_once("models/hospitalUser.php");
require_once("dao/hospitalUserDao.php");

require_once("models/message.php");
include_once("check_logado.php");

require_once("templates/header.php");

include_once("models/internacao.php");
include_once("dao/internacaoDao.php");

include_once("models/message.php");

include_once("models/hospital.php");
include_once("dao/hospitalDao.php");

include_once("models/patologia.php");
include_once("dao/patologiaDao.php");

include_once("models/usuario.php");
include_once("dao/usuarioDAO.php");

include_once("models/uti.php");
include_once("dao/utiDao.php");

include_once("models/gestao.php");
include_once("dao/gestaoDao.php");

include_once("models/prorrogacao.php");
include_once("dao/prorrogacaoDao.php");

include_once("models/negociacao.php");
include_once("dao/negociacaoDao.php");

include_once("array_dados.php");

$internacaoDao = new internacaoDAO($conn, $BASE_URL);

$hospital_geral = new hospitalDAO($conn, $BASE_URL);
$hospitals = $hospital_geral->findGeral($limite, $inicio);

$usuarioDao = new userDAO($conn, $BASE_URL);
$usuarios = $usuarioDao->findGeral($limite, $inicio);

$hospitalUserDao = new hospitalUserDAO($conn, $BASE_URL);
$hospitalUser = $hospitalUserDao->findGeral();

// Receber id do usuário
$id_hospitalUser = filter_input(INPUT_GET, "id_hospitalUser");
$hospitalUser = $hospitalUserDao->joinHospitalUser($id_hospitalUser);
extract($hospitalUser);

?>

<!-- formulario update -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<div id="main-container" class="container-fluid">
    <div class="row">
        <h1 class="page-title">Atualizar hospital</h1>
        <p class="page-description">Adicione informações sobre o hospital</p>
        <form class="formulario" action="<?= $BASE_URL ?>process_hospitalUser.php" id="add-movie-form" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="type" value="update">
            <input type="hidden" name="id_hospitalUser" value="<?= $id_hospitalUser ?>">
            <div class="form-group row">
                <div class="form-group col-sm-3">
                    <label class="control-label col-sm-3 " for="fk_hospital_user">Hospital</label>
                    <select class="form-control" id="fk_hospital_user" name="fk_hospital_user" required>
                        <option value="<?= $hospitalUser['0']["nome_hosp"] ?>"><?= $hospitalUser['0']["nome_hosp"] ?></option>
                        <?php foreach ($hospitals as $hospital) : ?>
                            <option value="<?= $hospital["id_hospital"] ?>"><?= $hospital["nome_hosp"] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group col-sm-3">
                    <label class="control-label" for="fk_usuario_hosp">usuario</label>
                    <select class="form-control" id="fk_usuario_hosp" name="fk_usuario_hosp" required>
                        <option value="<?= $hospitalUser['0']["usuario_user"] ?>"><?= $hospitalUser['0']["usuario_user"] ?></option>
                        <?php foreach ($usuarios as $usuario) : ?>

                            <option value="<?= $usuario["id_usuario"] ?>"><?= $usuario["usuario_user"] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <br>
            <button style="margin:10px" type="submit" class="btn-sm btn-info">Atualizar</button>
            <br>
    </div>
    </form>
</div>


<?php include_once("diversos/backbtn_hospital.php"); ?>

<?php
include_once("templates/footer.php");
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>


</html>