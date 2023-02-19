<?php
include_once("check_logado.php");

require_once("models/usuario.php");
require_once("models/patologia.php");
require_once("dao/usuarioDao.php");
require_once("dao/patologiaDao.php");
require_once("templates/header.php");

$user = new patologia();
$userDao = new UserDAO($conn, $BASE_URL);
$patologiaDao = new patologiaDAO($conn, $BASE_URL);

// Receber id do usuário
$id_patologia = filter_input(INPUT_GET, "id_patologia");

$patologia = $patologiaDao->findById($id_patologia);

?>

<!-- formulario update -->
<div id="main-container" class="container-fluid">
    <div class="row">
        <h1 class="page-title">Atualizar Patologia</h1>
        <p class="page-description">Adicione informações sobre a patologia</p>
        <form class="formulario" action="<?= $BASE_URL ?>process_patologia.php" id="add-movie-form" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="type" value="update">
            <div class="form-group row">

                <input type="hidden" class="form-control" id="id_patologia" name="id_patologia" value="<?= $patologia->id_patologia ?>" placeholder="ID">

                <div class="form-group col-sm-4">
                    <label for="nome">Patologia</label>
                    <input type="text" class="form-control" id="patologia_pat" value="<?= $patologia->patologia_pat ?>" name="patologia_pat" placeholder="Digite o nome" required>
                </div>
                <div class="form-group col-sm-4">
                    <label for="nome">Dias internação</label>
                    <input type="text" class="form-control" id="dias_pato" value="<?= $patologia->dias_pato ?>" name="dias_pato" placeholder="Digite o nome" required>
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


<?php include_once("diversos/backbtn_patologia.php"); ?>

<?php
include_once("templates/footer.php");
?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>

</html>