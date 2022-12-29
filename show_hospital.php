<?php
include_once("globals.php");

include_once("models/hospital.php");
include_once("dao/hospitalDao.php");
include_once("templates/header.php");

// Pegar o id do paceinte
$id_hospital = filter_input(INPUT_GET, "id_hospital", FILTER_SANITIZE_NUMBER_INT);

$hospital;

$hospitalDao = new hospitalDAO($conn, $BASE_URL);

//Instanciar o metodo hospital   
$hospital = $hospitalDao->findById($id_hospital);
?> <h3>Dados do Hospital Registro no: <?= $hospital->id_hospital ?></h3>
<br>
<div class="card">
    <br>
    <div class="card-header container-fluid" id="view-contact-container">
        <span class="card-title bold">Hospital:</span>
        <span class="card-title bold"><?= $hospital->nome_hosp ?></span>
        <br>
    </div>
    <div class="card-body">
        <span class=" card-text bold">Email:</span>
        <span class=" card-text bold"><?= $hospital->email01_hosp ?></span>
        <br>
        <span class=" card-text bold">Endereço:</span>
        <span class=" card-text bold"><?= $hospital->endereco_hosp ?></span>
        <br>
        <span class="card-text bold">Cidade:</span>
        <span class="card-text bold"><?= $hospital->cidade_hosp ?></span>
        <br>
        <hr>
    </div>

</div>
<?php include_once("diversos/backbtn_hospital.php"); ?>

<?php
include_once("templates/footer1.php");
