<?php

require_once("globals.php");
require_once("db.php");
require_once("models/antecedente.php");
require_once("models/message.php");
require_once("dao/usuarioDao.php");
require_once("dao/antecedenteDao.php");

//$message = new Message($BASE_URL);
$userDao = new UserDAO($conn, $BASE_URL);
$antecedenteDao = new antecedenteDAO($conn, $BASE_URL);

// Resgata o tipo do formulário

$type = "delete";
//$type = filter_input(INPUT_POST, "type");

if ($type === "delete") {
    // Recebe os dados do form
    $id_antecedente = filter_input(INPUT_GET, "id_antecedente");

    $antecedenteDao = new antecedenteDAO($conn, $BASE_URL);

    $antecedente = $antecedenteDao->findById($id_antecedente);
    var_dump($id_antecedente);
    if ($antecedente) {

        $antecedenteDao->destroy($id_antecedente);

        include_once('list_antecedente.php');
    } else {

        //$message->setMessage("Informações inválidas!", "error", "index.php");
    }
}
