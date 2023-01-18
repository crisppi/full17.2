<?php

require_once("globals.php");
require_once("db.php");
require_once("models/hospital.php");
require_once("models/message.php");
require_once("dao/usuarioDao.php");
require_once("dao/hospitalDao.php");

//$message = new Message($BASE_URL);
$userDao = new UserDAO($conn, $BASE_URL);
$hospitalDao = new hospitalDAO($conn, $BASE_URL);
//$hospital = new hospital();
// Resgata o tipo do formulário

$type = "delete";
//$type = filter_input(INPUT_POST, "type");

if ($type === "delete") {
    // Recebe os dados do form
    $id_hospital = filter_input(INPUT_GET, "id_hospital");

    $hospitalDao = new hospitalDAO($conn, $BASE_URL);

    $hospital = $hospitalDao->findById($id_hospital);

    if ($hospital) {

        $hospitalDao->destroy($id_hospital);

        include_once('list_hospital.php');
    } else {

        $message->setMessage("Informações inválidas!", "error", "index.php");
    }
}
