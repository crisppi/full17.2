<?php
include_once("globals.php");

include_once("models/paciente.php");
include_once("dao/pacienteDao.php");
include_once("templates/header.php");

// Pegar o id do paceinte
$id_paciente = filter_input(INPUT_GET, "id_paciente", FILTER_SANITIZE_NUMBER_INT);

$paciente;

$pacienteDao = new PacienteDAO($conn, $BASE_URL);

//Instanciar o metodo paciente   
$paciente = $pacienteDao->findById($id_paciente);
?> <h3>Dados do paciente Registro no: <?= $paciente->id_paciente ?></h3>
<br>
<div class="card">
    <br>
    <div class="card-header container-fluid" id="view-contact-container">
        <span class="card-title bold">Nome:</span>
        <span class="card-title bold"><?= $paciente->nome_pac ?></span>
        <br>
    </div>
    <div class="card-body">
        <span class=" card-text bold">Email:</span>
        <span class=" card-text bold"><?= $paciente->email01_pac ?></span>
        <br>
        <span class=" card-text bold">Endereço:</span>
        <span class=" card-text bold"><?= $paciente->endereco_pac ?></span>
        <br>
        <span class="card-text bold">Cidade:</span>
        <span class="card-text bold"><?= $paciente->cidade_pac ?></span>
        <br>
        <hr>
    </div>

</div>
<?php include_once("diversos/backbtn_pacientes.php"); ?>

<?php
include_once("templates/footer1.php");
