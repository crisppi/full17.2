<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('location: index.php');
    exit;
}
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
    <div id="id-confirmacao" class="btn_acoes visible">
        <p>Deseja mesmo deletar este paciente? <?= $paciente->nome_pac ?></p>
        <button class="btn btn-success styled" onclick=cancelar() type="button" id="cancelar" name="cancelar">Cancelar</button>
        <button class="btn btn-danger styled" onclick=deletar() value="default" type="button" id="deletar-btn" name="deletar">Deletar</button>
    </div>
</div>
<script>
    function apareceOpcoes() {
        $('#deletar-btn').val('nao');
        let mudancaStatus = ($('#deletar-btn').val())
        console.log(mudancaStatus);
        let idAcoes = (document.getElementById('id-confirmacao'));
        idAcoes.style.display = 'block';
    }

    function deletar() {
        let idAcoes = (document.getElementById('id-confirmacao'));
        idAcoes.style.display = 'none';
        window.location = "<?= $BASE_URL ?>del_paciente.php?id_paciente=<?= $id_paciente ?>";

    };

    function cancelar() {
        let idAcoes = (document.getElementById('id-confirmacao'));
        idAcoes.style.display = 'none';
        console.log("chegou no cancelar");
        window.location = "<?= $BASE_URL ?>list_paciente.php?>";


    };
    src = "https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js";
</script>
<?php include_once("diversos/backbtn_pacientes.php"); ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
<?php
require_once("templates/footer.php");
?>