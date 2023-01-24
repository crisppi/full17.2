<?php
require_once("models/usuario.php");
require_once("models/internacao.php");
require_once("dao/usuarioDao.php");
require_once("dao/internacaoDao.php");
require_once("templates/header.php");

$user = new internacao();
$userDao = new UserDAO($conn, $BASE_URL);
$internacaoDao = new internacaoDAO($conn, $BASE_URL);

// Receber id do usuário
$id_internacao = filter_input(INPUT_GET, "id_internacao");

$internacao = $internacaoDao->findById($id_internacao);

?>

<!-- formulario update -->
<div id="main-container" class="container-fluid">
    <div class="row">
        <h1 class="page-title">Atualizar internacao</h1>
        <p class="page-description">Adicione informações sobre a internacao</p>
        <form class="formulario" action="<?= $BASE_URL ?>process_internacao.php" id="add-movie-form" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="type" value="update">
            <div class="form-group row">

                <input type="hidden" class="form-control" id="id_internacao" name="id_internacao" value="<?= $internacao->id_internacao ?>" placeholder="ID">

                <div class="form-group col-sm-4">
                    <label for="nome">internacao</label>
                    <input type="text" class="form-control" id="internacao_pat" value="<?= $internacao->hospital_int ?>" name="internacao_pat" placeholder="Digite o nome" required>
                </div>
                <div class="form-group col-sm-4">
                    <label for="nome">Dias internação</label>
                    <input type="text" class="form-control" id="dias_pato" value="<?= $internacao->paciente_int ?>" name="dias_pato" placeholder="Digite o nome" required>
                </div>

                <br>
                <div>
                    <button style="margin:10px" type="submit" class="btn-sm btn-info">Atualizar</button>

                </div>
                <br>
                <div class="form-group col-sm-4">

                </div>
        </form>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>


<?php include_once("diversos/backbtn_internacao.php"); ?>

<?php
require_once("templates/footer1.php");
