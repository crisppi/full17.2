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

    <div id="id-confirmacao" class="btn_acoes visible">
        <p>Deseja deletar este hospital: <?= $hospital->nome_hosp ?>?</p>
        <button class="btn btn-success styled" onclick=cancelar() type="button" id="cancelar" name="cancelar">Cancelar</button>
        <button class="btn btn-danger styled" onclick=deletar() value="default" type="button" id="deletar-btn" name="deletar">Deletar</button>

    </div>
</div>
<div class="mensagem-apg">apagada


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
        window.location = "<?= $BASE_URL ?>del_hospital.php?id_hospital=<?= $id_hospital ?>";

    };

    function cancelar() {
        let idAcoes = (document.getElementById('id-confirmacao'));
        idAcoes.style.display = 'none';
        console.log("chegou no cancelar");
        window.location = "<?= $BASE_URL ?>del_hospital.php?id_hospital=<?= $id_hospital ?>";


    };
    src = "https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js";
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>

<?php include_once("diversos/backbtn_hospital.php"); ?>

<?php
require_once("templates/footer.php");
?>