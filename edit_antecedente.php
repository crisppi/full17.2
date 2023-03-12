<?php
include_once("check_logado.php");

require_once("models/usuario.php");
require_once("models/antecedente.php");
require_once("dao/usuarioDao.php");
require_once("dao/antecedenteDao.php");
require_once("templates/header.php");

$user = new antecedente();
$userDao = new UserDAO($conn, $BASE_URL);
$antecedenteDao = new antecedenteDAO($conn, $BASE_URL);

// Receber id do usuário
$id_antecedente = filter_input(INPUT_GET, "id_antecedente");

$antecedente = $antecedenteDao->findById($id_antecedente);

?>

<!-- formulario update -->
<div id="main-container" class="container-fluid">
    <div class="row">
        <h1 class="page-title">Atualizar Antecedente</h1>
        <p class="page-description">Adicione informações sobre o antecedente</p>
        <form class="formulario" action="<?= $BASE_URL ?>process_antecedente.php" id="add-movie-form" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="type" value="update-ant">
            <div class="form-group row">

                <input type="hidden" class="form-control" id="id_antecedente" name="id_antecedente" value="<?= $antecedente->id_antecedente ?>" placeholder="ID">

                <div class="form-group col-sm-4">
                    <label for="antecedente_ant">Antecedente</label>
                    <input type="text" class="form-control" id="antecedente_ant" value="<?= $antecedente->antecedente_ant ?>" name="antecedente_ant" placeholder="Digite o nome" required>
                </div>

                <br>
                <div>

                    <button style="margin:10px" type="submit" class="btn-sm btn-info">Atualizar</button>
                    <br>
                </div>
                <div class="form-group col-sm-4">

                </div>
        </form>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>


<?php include_once("diversos/backbtn_antecedente.php"); ?>

<?php
include_once("templates/footer.php");
?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>

</html>