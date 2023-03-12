<?php
ob_start();
require_once("globals.php");
require_once("db.php");
require_once("models/antecedente.php");
require_once("models/message.php");
require_once("dao/usuarioDao.php");
require_once("dao/antecedenteDao.php");

$message = new Message($BASE_URL);
$userDao = new UserDAO($conn, $BASE_URL);
$antecedenteDao = new antecedenteDAO($conn, $BASE_URL);

// Resgata o tipo do formulário
$type = filter_input(INPUT_POST, "type");

// Resgata dados do usuário

if ($type === "create-ant") {

    // Receber os dados dos inputs
    $antecedente_ant = filter_input(INPUT_POST, "antecedente_ant");
    $fk_usuario_ant = filter_input(INPUT_POST, "fk_usuario_ant");

    $antecedente = new antecedente();

    // Validação mínima de dados
    if (!empty($antecedente_ant)) {

        $antecedente->antecedente_ant = $antecedente_ant;
        $antecedente->fk_usuario_ant = $fk_usuario_ant;
        $antecedenteDao->create($antecedente);
    } else {

        $message->setMessage("Você precisa adicionar pelo menos: antecedente_ant do antecedente!", "error", "cad_internacao.php");
    }
} else if ($type === "update-ant") {

    $antecedenteDao = new antecedenteDAO($conn, $BASE_URL);

    // Receber os dados dos inputs
    $id_antecedente = filter_input(INPUT_POST, "id_antecedente");
    $antecedente_ant = filter_input(INPUT_POST, "antecedente_ant");

    $antecedenteData = $antecedenteDao->findById($id_antecedente);

    $antecedenteData->id_antecedente = $id_antecedente;
    $antecedenteData->antecedente_ant = $antecedente_ant;

    $antecedenteDao->update($antecedenteData);

    include_once('list_antecedente.php');
};
