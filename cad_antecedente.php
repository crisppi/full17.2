<?php
//session_start();

require_once("templates/header.php");
require_once("dao/antecedenteDao.php");
require_once("models/message.php");

$message = new Message($BASE_URL);

$flassMessage = $message->getMessage();
if (!empty($flassMessage["msg"])) {
    // Limpar a mensagem
    $message->clearMessage();
}
$antecedenteDao = new antecedenteDAO($conn, $BASE_URL);

// Receber id do usuário
$id_antecedente = filter_input(INPUT_GET, "id_antecedente");

?>
<div id="main-container" class="container-fluid">

    <div class="row">
        <h1 class="page-title">Cadastrar antecedente</h1>
        <p class="page-description">Adicione informações sobre a antecedente</p>
        <form class="formulario" action="<?= $BASE_URL ?>process_antecedente.php" id="add-movie-form" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="type" value="create">
            <div class="form-group row">
                <div class="form-group col-sm-4">
                    <label for="antecedente_ant">Patologia</label>
                    <input type="text" class="form-control" id="antecedente_ant" name="antecedente_ant" placeholder="Digite o nome do usuário" required>
                </div>
            </div>
            <br>
            <button style="margin:10px" type="submit" class="btn-sm btn-info">Cadastrar</button>
            <br>
            <br>
            <?php if (!empty($flassMessage["msg"])) : ?>
                <div class="msg-container">
                    <p class="msg <?= $flassMessage["type"] ?>"><?= $flassMessage["msg"] ?></p>
                </div>
            <?php endif; ?>
    </div>

    </form>
    <div>
        <a class="btn btn-success" href="list_antecedente.php">Listar
        </a>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

<?php
require_once("templates/footer1.php");
?>