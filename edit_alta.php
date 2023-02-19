<?php
include_once("check_logado.php");

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
                    <input type="hidden" value="<?= $_SESSION['email_user']; ?>" class="form-control" id="usuario_create_int" name="usuario_create_int" placeholder="Digite o usuário">
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
            </div>
            <div class="row">
                <?php if ($internado_uti_int == "s") {
                ?>
                    <div>
                        <hr>
                        <p> Você precisa dar alta da UTI</p>
                    </div>
                    <input type="hidden" name="alta_uti" value="alta_uti">

                    <div class="form-group col-sm-2">
                        <label class="control-label" for="internado_uti_int">UTI</label>
                        <input type="text" class="form-control" value="<?= $internado_uti_int ?>" id="internado_uti_int" name="internado_uti_int" placeholder="internado_uti_int">
                    </div>
                    <div class="form-group col-sm-2">
                        <label class="control-label" for="data_alta_uti">Data alta UTI</label>
                        <input type="date" class="form-control" value='<?php echo date('d/m/Y') ?>' id="data_alta_uti" name="data_alta_uti" placeholder="">
                    </div>
                <?php } ?>
                <br>
            </div>
            <br>
            <button style="margin:10px" type="submit" class="btn-sm btn-success">Alta</button>
            <br>
    </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

<?php include_once("diversos/backbtn_internacao.php"); ?>

<?php
include_once("templates/footer.php");
?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>

</html>