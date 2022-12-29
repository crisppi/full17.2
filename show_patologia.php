<?php
include_once("globals.php");

include_once("models/patologia.php");
include_once("dao/patologiaDao.php");
include_once("templates/header.php");

// Pegar o id do paceinte
$id_patologia = filter_input(INPUT_GET, "id_patologia", FILTER_SANITIZE_NUMBER_INT);

$patologia;

$patologiaDao = new patologiaDAO($conn, $BASE_URL);

//Instanciar o metodo patologia   
$patologia = $patologiaDao->findById($id_patologia);
?> <h3>Dados da Patologia : <?= $patologia->id_patologia ?></h3>
<br>
<div class="card">
    <br>
    <div class="card-header container-fluid" id="view-contact-container">
        <span class="card-title bold">Patologia:</span>
        <span class="card-title bold"><?= $patologia->patologia_pat ?></span>
        <br>
    </div>
    <div class="card-header container-fluid" id="view-contact-container">
        <span class="card-title bold">Dias de internação:</span>
        <span class="card-title bold"><?= $patologia->dias_pato ?></span>
        <br>
    </div>

</div>
<?php include_once("diversos/backbtn_patologia.php"); ?>

<?php
include_once("templates/footer1.php");
