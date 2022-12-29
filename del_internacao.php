<?php

require_once("globals.php");
require_once("db.php");
require_once("models/internacao.php");
require_once("models/message.php");
require_once("dao/usuarioDao.php");
require_once("dao/internacaoDao.php");

//$message = new Message($BASE_URL);
$userDao = new UserDAO($conn, $BASE_URL);
$internacaoDao = new internacaoDAO($conn, $BASE_URL);
//$internacao = new Paciente();
// Resgata o tipo do formulário

$type = "delete";
//$type = filter_input(INPUT_POST, "type");

if ($type === "delete") {
    // Recebe os dados do form
    $id_internacao = filter_input(INPUT_POST, "id_internacao");

    $internacaoDao = new internacaoDAO($conn, $BASE_URL);

    $internacao = $internacaoDao->findById($id_internacao);

    if ($internacao) {

        $internacaoDao->destroy($id_internacao);

        include_once('list_internacao.php');
    } else {

        //$message->setMessage("Informações inválidas!", "error", "index.php");
    }
}
