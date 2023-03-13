<?php

require_once("globals.php");
require_once("db.php");
require_once("models/internacao.php");
require_once("models/message.php");
require_once("dao/usuarioDao.php");
require_once("dao/internacaoDao.php");

$message = new Message($BASE_URL);
$userDao = new UserDAO($conn, $BASE_URL);
$internacaoDao = new internacaoDAO($conn, $BASE_URL);

// Resgata o tipo do formulário
$type = filter_input(INPUT_POST, "type");

// Resgata dados do usuário

if ($type === "alta-int") {

    $internacaoDao = new internacaoDAO($conn, $BASE_URL);

    // Receber os dados dos inputs
    $id_internacao = filter_input(INPUT_POST, "id_internacao");
    $alta = filter_input(INPUT_POST, "alta");
    $data_alta_int = filter_input(INPUT_POST, "data_alta_int");
    $internado_int = filter_input(INPUT_POST, "internado_int");
    $usuario_create_int = filter_input(INPUT_POST, "usuario_create_int");
    $tipo_alta_int = filter_input(INPUT_POST, "tipo_alta_int");

    $internacaoData = $internacaoDao->findById($id_internacao);

    $internacaoData->id_internacao = $id_internacao;
    $internacaoData->data_alta_int = $data_alta_int;
    $internacaoData->internado_int = $internado_int;
    $internacaoData->usuario_create_int = $usuario_create_int;
    $internacaoData->tipo_alta_int = $tipo_alta_int;

    $internacaoDao->alta($internacaoData);

    include_once('list_internacao.php');
}
