<?php

include_once("globals.php");
include_once("db.php");

include_once("models/message.php");
include_once("dao/usuarioDao.php");

include_once("models/internacao.php");
include_once("dao/internacaoDao.php");

include_once("models/uti.php");
include_once("dao/utiDao.php");

$message = new Message($BASE_URL);
$userDao = new UserDAO($conn, $BASE_URL);
$internacaoDao = new internacaoDAO($conn, $BASE_URL);

// Resgata o tipo do formulário
$type = filter_input(INPUT_POST, "type");
// Resgata dados do usuário

$utiDao = new UTIDAO($conn, $BASE_URL);

// Receber os dados dos inputs
$id_internacao = filter_input(INPUT_POST, "id_internacao");
$alta = filter_input(INPUT_POST, "alta");
$data_alta_int = filter_input(INPUT_POST, "data_alta_int");
$internado_int = filter_input(INPUT_POST, "internado_int");
$usuario_create_int = filter_input(INPUT_POST, "usuario_create_int");
$tipo_alta_int = filter_input(INPUT_POST, "tipo_alta_int");

$id_uti = filter_input(INPUT_POST, "id_uti");
$alta_uti = filter_input(INPUT_POST, "alta_uti");
$data_alta_uti = filter_input(INPUT_POST, "data_alta_uti");


$internacaoData = $internacaoDao->findById($id_internacao);

$internacaoData->id_internacao = $id_internacao;
$internacaoData->data_alta_int = $data_alta_int;
$internacaoData->internado_int = $internado_int;
$internacaoData->usuario_create_int = $usuario_create_int;
$internacaoData->tipo_alta_int = $tipo_alta_int;

if ($alta_uti == "alta-ut") {
    $UTIData->id_uti = $id_uti;
    $UTIData->data_alta_uti = $data_alta_uti;
    $UTIData->internado_uti = $internado_uti;

    $utiDao->findAltaUpdate($UTIData);

    include_once('list_internacao.php');
}

$internacaoDao->update($internacaoData);

// include_once('cad_internacao_niveis.php');
// print_r("chegou neste ponto");
// print_r($alta_uti);
if ($alta_uti == "alta_uti") {
    // Receber os dados dos inputs
    $id_uti = filter_input(INPUT_POST, "id_uti");
    $data_alta_uti = filter_input(INPUT_POST, "data_alta_uti");
    $internado_uti = filter_input(INPUT_POST, "internado_uti");
    $fk_internacao_uti = filter_input(INPUT_POST, "fk_internacao_uti");

    print_r($data_alta_uti);
    echo "<br>";
    print_r($id_uti);
    echo "<br>";
    print_r($internado_uti);

    $UTIData = $utiDao->findById($id_uti);

    $UTIData->data_alta_uti = $data_alta_uti;
    $UTIData->fk_internacao_uti = $fk_internacao_uti;
    $UTIData->internado_uti = $internado_uti;
    $UTIData->id_uti = $id_uti;

    print_r($UTIData);
    $utiDao->findAltaUpdate($UTIData);

    include_once('list_internacao.php');
}
