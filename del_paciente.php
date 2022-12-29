<?php

require_once("globals.php");
require_once("db.php");
require_once("models/paciente.php");
require_once("models/message.php");
require_once("dao/usuarioDao.php");
require_once("dao/pacienteDao.php");

//$message = new Message($BASE_URL);
$userDao = new UserDAO($conn, $BASE_URL);
$pacienteDao = new PacienteDAO($conn, $BASE_URL);
//$paciente = new Paciente();
// Resgata o tipo do formulário

$type = "delete";
//$type = filter_input(INPUT_POST, "type");

if ($type === "delete") {
    // Recebe os dados do form
    $id_paciente = filter_input(INPUT_POST, "id_paciente");

    $pacienteDao = new PacienteDAO($conn, $BASE_URL);

    $paciente = $pacienteDao->findById($id_paciente);

    if ($paciente) {

        $pacienteDao->destroy($id_paciente);

        include_once('list_paciente.php');
    } else {

        //$message->setMessage("Informações inválidas!", "error", "index.php");
    }
}
