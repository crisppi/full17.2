<?php
require_once("templates/header.php");
require_once("dao/visitaDao.php");
require_once("models/message.php");
include_once("models/hospital.php");
include_once("dao/hospitalDao.php");

$visitaDao = new visitaDAO($conn, $BASE_URL);


// Receber id da internacao
$id_internacao = filter_input(INPUT_GET, "id_internacao");

?>
<div id="main-container" class="container-fluid">
    <?php include_once('formularios/form_cad_visita.php'); ?>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

    <?php
    require_once("templates/footer.php");
    ?>