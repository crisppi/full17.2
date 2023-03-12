<?php
include_once("check_logado.php");

include_once("globals.php");

include_once("models/antecedente.php");
include_once("dao/antecedenteDao.php");
include_once("templates/header.php");

// Pegar o id do paceinte
$id_antecedente = filter_input(INPUT_GET, "id_antecedente", FILTER_SANITIZE_NUMBER_INT);

$antecedente;

$antecedenteDao = new antecedenteDAO($conn, $BASE_URL);
// instanciar msg
$message = new Message($BASE_URL);

$flassMessage = $message->getMessage();
if (!empty($flassMessage["msg"])) {
    // Limpar a mensagem
    $message->clearMessage();
}
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
    <div id="id-confirmacao" class="btn_acoes visible">
        <p>Deseja deletar este antecedente: <?= $antecedente->antecedente_ant ?>?</p>
        <button class="btn btn-success styled" onclick=cancelar() type="button" id="cancelar" name="cancelar">Cancelar</button>
        <button class="btn btn-danger styled" onclick=deletar() value="default" type="button" id="deletar-btn" name="deletar">Deletar</button>

    </div>
</div>

<?php include_once("diversos/backbtn_antecedente.php"); ?>
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
        window.location = "<?= $BASE_URL ?>process_antecedente.php?id_antecedente=<?= $id_antecedente ?>";

    };

    function cancelar() {
        let idAcoes = (document.getElementById('id-confirmacao'));
        idAcoes.style.display = 'none';
        console.log("chegou no cancelar");
        window.location = "<?= $BASE_URL ?>list_antecedente.php";


    };
    src = "https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js";
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
<?php
require_once("templates/footer.php");
?>