<?php
include_once("globals.php");

include_once("models/antecedente.php");
include_once("dao/antecedenteDao.php");
include_once("templates/header.php");

// Pegar o id do paceinte
$id_antecedente = filter_input(INPUT_GET, "id_antecedente", FILTER_SANITIZE_NUMBER_INT);

$antecedente;

$antecedenteDao = new antecedenteDAO($conn, $BASE_URL);

//Instanciar o metodo antecedente   
$antecedente = $antecedenteDao->findById($id_antecedente);
?> <h3>Dados do antecedente: <?= $antecedente->id_antecedente ?></h3>
<br>
<div class="card">
    <br>
    <div class="card-header container-fluid" id="view-contact-container">
        <span class="card-title bold">Antecedente:</span>
        <span class="card-title bold"><?= $antecedente->antecedente_ant ?></span>
        <br>
    </div>

</div>
<?php include_once("diversos/backbtn_antecedente.php"); ?>

<?php
include_once("templates/footer1.php");
