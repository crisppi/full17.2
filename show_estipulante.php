<?php
include_once("globals.php");

include_once("models/estipulante.php");
include_once("dao/estipulanteDao.php");
include_once("templates/header.php");

// Pegar o id do paceinte
$id_estipulante = filter_input(INPUT_GET, "id_estipulante", FILTER_SANITIZE_NUMBER_INT);

$estipulante;

$estipulanteDao = new estipulanteDAO($conn, $BASE_URL);

//Instanciar o metodo estipulante   
$estipulante = $estipulanteDao->findById($id_estipulante);
?> <h3>Dados do Hospital Registro no: <?= $estipulante->id_estipulante ?></h3>
<br>
<div class="card">
    <br>
    <div class="card-header container-fluid" id="view-contact-container">
        <span class="card-title bold">Hospital:</span>
        <span class="card-title bold"><?= $estipulante->nome_est ?></span>
        <br>
    </div>
    <div class="card-body">
        <span class=" card-text bold">Email:</span>
        <span class=" card-text bold"><?= $estipulante->email01_est ?></span>
        <br>
        <span class=" card-text bold">Endereço:</span>
        <span class=" card-text bold"><?= $estipulante->endereco_est ?></span>
        <br>
        <span class="card-text bold">Cidade:</span>
        <span class="card-text bold"><?= $estipulante->cidade_est ?></span>
        <br>
        <hr>
    </div>

</div>
<?php include_once("diversos/backbtn_estipulante.php"); ?>

<?php
include_once("templates/footer1.php");
