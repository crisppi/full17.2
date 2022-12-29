<?php

require_once("globals.php");
require_once("db.php");
require_once("models/patologia.php");
require_once("models/message.php");
require_once("dao/usuarioDao.php");
require_once("dao/patologiaDao.php");

//$message = new Message($BASE_URL);
$userDao = new UserDAO($conn, $BASE_URL);
$patologiaDao = new patologiaDAO($conn, $BASE_URL);
//$patologia = new Paciente();
// Resgata o tipo do formulário

$type = "delete";
//$type = filter_input(INPUT_POST, "type");

if ($type === "delete") {
    // Recebe os dados do form
    $id_patologia = filter_input(INPUT_POST, "id_patologia");

    $patologiaDao = new patologiaDAO($conn, $BASE_URL);

    $patologia = $patologiaDao->findById($id_patologia);

    if ($patologia) {

        $patologiaDao->destroy($id_patologia);

        include_once('list_patologia.php');
    } else {

        //$message->setMessage("Informações inválidas!", "error", "index.php");
    }
}
