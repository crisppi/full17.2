<?php
include_once("check_logado.php");

include_once("globals.php");

include_once("models/usuario.php");
include_once("dao/usuarioDao.php");
include_once("templates/header.php");

// Pegar o id do paceinte
$id_usuario = filter_input(INPUT_GET, "id_usuario", FILTER_SANITIZE_NUMBER_INT);

$usuario;

$usuarioDao = new userDAO($conn, $BASE_URL);

//Instanciar o metodo usuario   
$usuario = $usuarioDao->findById_user($id_usuario);
?> <h3>Dados do usuario Registro no: <?= $usuario->id_usuario ?></h3>
<br>
<div class="card">
    <br>
    <div class="card-header container-fluid" id="view-contact-container">
        <span class="card-title bold">Nome:</span>
        <span class="card-title bold"><?= $usuario->usuario_user ?></span>
        <br>
    </div>
    <div class="card-body">
        <span class=" card-text bold">Email:</span>
        <span class=" card-text bold"><?= $usuario->email_user ?></span>
        <br>
        <span class=" card-text bold">Endereço:</span>
        <span class=" card-text bold"><?= $usuario->endereco_user ?></span>
        <br>
        <span class="card-text bold">Cidade:</span>
        <span class="card-text bold"><?= $usuario->cidade_user ?></span>
        <br>
        <hr>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</div>


<hr>
<div id="id-confirmacao" class="btn_acoes visible">
    <p style="font-weight: bold; font-size:1.0em">Deseja mesmo deletar este usuario?</p>
    <button class="btn btn-success styled" onclick=cancelar() type="button" id="cancelar" name="cancelar">Cancelar</button>
    <button class="btn btn-danger styled" onclick=deletar() value="default" type="button" id="deletar-btn" name="deletar">Deletar</button>
</div>
</div>
<!-- mensagem de apagar -->
<!-- <div styled="margin:0 auto" class="mensagem-apgar">
    <p styled="margin:0 auto">Apagado</p>
</div> -->
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
        window.location = "<?= $BASE_URL ?>del_usuario.php?id_usuario=<?= $id_usuario ?>";

    };

    function cancelar() {
        let idAcoes = (document.getElementById('id-confirmacao'));
        idAcoes.style.display = 'none';
        console.log("chegou no cancelar");
        window.location = "<?= $BASE_URL ?>list_usuario.php";


    };
    src = "https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js";
</script>
<?php include_once("diversos/backbtn_usuarios.php"); ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
<?php
require_once("templates/footer.php");
?>