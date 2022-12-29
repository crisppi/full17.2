<?php
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
<?php include_once("diversos/backbtn_usuarios.php"); ?>

<?php
include_once("templates/footer1.php");
