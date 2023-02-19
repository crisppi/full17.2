<?php
include_once("check_logado.php");

require_once("globals.php");
require_once("db.php");
require_once("models/estipulante.php");
require_once("models/message.php");
require_once("dao/usuarioDao.php");
require_once("dao/estipulanteDao.php");

//$message = new Message($BASE_URL);
$userDao = new UserDAO($conn, $BASE_URL);
$estipulanteDao = new estipulanteDAO($conn, $BASE_URL);
//$estipulante = new estipulante();
// Resgata o tipo do formulário

$type = "delete";
//$type = filter_input(INPUT_POST, "type");

if ($type === "delete") {
    // Recebe os dados do form
    $id_estipulante = filter_input(INPUT_GET, "id_estipulante");

    $estipulanteDao = new estipulanteDAO($conn, $BASE_URL);

    $estipulante = $estipulanteDao->findById($id_estipulante);

    if ($estipulante) {

        $estipulanteDao->destroy($id_estipulante);

        include_once('list_estipulante.php');
    } else {

        //$message->setMessage("Informações inválidas!", "error", "index.php");
    }
}
