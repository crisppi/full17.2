<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('location: index.php');
    exit;
}
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
?> <h3>Dados do estipulante Registro no: <?= $estipulante->id_estipulante ?></h3>
<br>
<div class="card">
    <br>
    <div class="card-header container-fluid" id="view-contact-container">
        <span class="card-title bold">estipulante:</span>
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
    <div id="id-confirmacao" class="btn_acoes visible">
        <p>Deseja deletar este Estipulante?: <?= $nome_est ?>?</p>
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
        window.location = "<?= $BASE_URL ?>del_estipulante.php?id_estipulante=<?= $id_estipulante ?>";

    };

    function cancelar() {
        let idAcoes = (document.getElementById('id-confirmacao'));
        idAcoes.style.display = 'none';
        console.log("chegou no cancelar");
        window.location = "<?= $BASE_URL ?>list_estipulante.php";


    };
    src = "https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js";
</script>
<?php include_once("diversos/backbtn_estipulante.php"); ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
<?php
require_once("templates/footer.php");
?>