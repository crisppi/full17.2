<?php
include_once("check_logado.php");

require_once("globals.php");
require_once("db.php");
require_once("models/seguradora.php");
require_once("models/message.php");
require_once("dao/usuarioDao.php");
require_once("dao/seguradoraDao.php");

//$message = new Message($BASE_URL);
$userDao = new UserDAO($conn, $BASE_URL);
$seguradoraDao = new seguradoraDAO($conn, $BASE_URL);
//$seguradora = new seguradora();
// Resgata o tipo do formulário

$type = "delete";
//$type = filter_input(INPUT_POST, "type");

if ($type === "delete") {
    // Recebe os dados do form
    $id_seguradora = filter_input(INPUT_GET, "id_seguradora");

    $seguradoraDao = new seguradoraDAO($conn, $BASE_URL);

    $seguradora = $seguradoraDao->findById($id_seguradora);

    if ($seguradora) {

        $seguradoraDao->destroy($id_seguradora);

        include_once('list_seguradora.php');
    } else {

        //$message->setMessage("Informações inválidas!", "error", "index.php");
    }
}
