<?php
include_once("check_logado.php");

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
    <div id="id-confirmacao" class="btn_acoes visible">
        <p>Deseja mesmo deletar esta Seguradora?: <?= $seguradora->seguradora_seg ?>?</p>
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
        window.location = "<?= $BASE_URL ?>del_seguradora.php?id_seguradora=<?= $id_seguradora ?>";

    };

    function cancelar() {
        let idAcoes = (document.getElementById('id-confirmacao'));
        idAcoes.style.display = 'none';
        console.log("chegou no cancelar");
        window.location = "<?= $BASE_URL ?>list_seguradora.php";


    };
    src = "https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js";
</script>
<?php include_once("diversos/backbtn_seguradora.php"); ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
<?php
require_once("templates/footer.php");
?>