<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('location: index.php');
    exit;
}
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
<div id="id-confirmacao" class="btn_acoes visible">
    <p>Deseja mesmo deletar este patologia? <?= $nome_pac ?></p>
    <button class="btn btn-success styled" onclick=cancelar() type="button" id="cancelar" name="cancelar">Cancelar</button>
    <button class="btn btn-danger styled" onclick=deletar() value="default" type="button" id="deletar-btn" name="deletar">Deletar</button>
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
        window.location = "<?= $BASE_URL ?>del_patologia.php?id_patologia=<?= $id_patologia ?>";

    };

    function cancelar() {
        let idAcoes = (document.getElementById('id-confirmacao'));
        idAcoes.style.display = 'none';
        console.log("chegou no cancelar");
        window.location = "<?= $BASE_URL ?>del_patologia.php?id_patologia=<?= $id_patologia ?>";


    };
    src = "https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js";
</script>
<?php include_once("diversos/backbtn_patologia.php"); ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
<?php
require_once("templates/footer.php");
?>