<?php

require_once("globals.php");
require_once("db.php");
require_once("models/patologia.php");
require_once("models/message.php");
require_once("dao/usuarioDao.php");
require_once("dao/patologiaDao.php");

$message = new Message($BASE_URL);
$userDao = new UserDAO($conn, $BASE_URL);
$patologiaDao = new patologiaDAO($conn, $BASE_URL);

// Resgata o tipo do formulário
$type = filter_input(INPUT_POST, "type");

// Resgata dados do usuário

if ($type === "create") {

    // Receber os dados dos inputs
    $patologia_pat = filter_input(INPUT_POST, "patologia_pat");
    $dias_pato = filter_input(INPUT_POST, "dias_pato");

    $patologia = new patologia();

    // Validação mínima de dados
    if (!empty($patologia_pat)) {

        $patologia->patologia_pat = $patologia_pat;
        $patologia->dias_pato = $dias_pato;

        $patologiaDao->create($patologia);
    } else {

        $message->setMessage("Você precisa adicionar pelo menos: patologiaNome do patologia!", "error", "back");
    }/*
} else if ($type === "delete") {
    // Recebe os dados do form
    $id_patologia = filter_input(INPUT_POST, "id_patologia");

    $patologiaDao = new patologiaDAO($conn, $BASE_URL);

    $patologia = $patologiaDao->findById($id_patologia);

    if ($patologia) {

        $patologiaDao->destroy($id_patologia);
    } else {

        //$message->setMessage("Informações inválidas!", "error", "index.php");
    }*/
} else if ($type === "update") {

    $patologiaDao = new patologiaDAO($conn, $BASE_URL);

    // Receber os dados dos inputs
    $id_patologia = filter_input(INPUT_POST, "id_patologia");
    $patologia_pat = filter_input(INPUT_POST, "patologia_pat");
    $dias_pato = filter_input(INPUT_POST, "dias_pato");


    $patologiaData = $patologiaDao->findById($id_patologia);

    $patologiaData->id_patologia = $id_patologia;
    $patologiaData->patologia_pat = $patologia_pat;
    $patologiaData->dias_pato = $dias_pato;


    $patologiaDao->update($patologiaData);

    include_once('list_patologia.php');
}
//$type = "delete";
//$type = filter_input(INPUT_POST, "type");

if ($type === "delete") {
    // Recebe os dados do form
    $id_patologia = filter_input(INPUT_GET, "id_patologia");

    $patologiaDao = new patologiaDAO($conn, $BASE_URL);

    $patologia = $patologiaDao->findById($id_patologia);

    echo $patologia;
    if ($patologia) {

        $patologiaDao->destroy($id_patologia);

        include_once('list_patologia.php');
    } else {

        $message->setMessage("Informações inválidas!", "error", "index.php");
    }
}
