<?php
include_once("globals.php");

include_once("models/seguradora.php");
include_once("dao/seguradoraDao.php");
include_once("templates/header.php");

// Pegar o id do paceinte
$id_seguradora = filter_input(INPUT_GET, "id_seguradora", FILTER_SANITIZE_NUMBER_INT);

$seguradora;

$seguradoraDao = new seguradoraDAO($conn, $BASE_URL);

//Instanciar o metodo seguradora   
$seguradora = $seguradoraDao->findById($id_seguradora);
?> <h3>Dados do seguradora Registro no: <?= $seguradora->id_seguradora ?></h3>
<br>
<div class="card">
    <br>
    <div class="card-header container-fluid" id="view-contact-container">
        <span class="card-title bold">seguradora:</span>
        <span class="card-title bold"><?= $seguradora->seguradora_seg ?></span>
        <br>
    </div>
    <div class="card-body">
        <span class=" card-text bold">Email:</span>
        <span class=" card-text bold"><?= $seguradora->email01_seg ?></span>
        <br>
        <span class=" card-text bold">Endereço:</span>
        <span class=" card-text bold"><?= $seguradora->endereco_seg ?></span>
        <br>
        <span class="card-text bold">Cidade:</span>
        <span class="card-text bold"><?= $seguradora->cidade_seg ?></span>
        <br>
        <hr>
    </div>

</div>
<?php include_once("diversos/backbtn_seguradora.php"); ?>

<?php
include_once("templates/footer1.php");
