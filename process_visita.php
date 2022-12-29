<?php

require_once("globals.php");
require_once("db.php");
require_once("models/visita.php");
require_once("models/message.php");
require_once("dao/usuarioDao.php");
require_once("dao/visitaDao.php");

$message = new Message($BASE_URL);
$userDao = new UserDAO($conn, $BASE_URL);
$visitaDao = new visitaDAO($conn, $BASE_URL);

// Resgata o tipo do formulário
$type = filter_input(INPUT_POST, "type");

// Resgata dados do usuário

if ($type === "create") {

    // Receber os dados dos inputs
    $visitaNome = filter_input(INPUT_POST, "visitaNome");
    $usuario_create = filter_input(INPUT_POST, "usuario_create");
    $valor_diaria = filter_input(INPUT_POST, "valor_diaria");
    $data_create = filter_input(INPUT_POST, "data_create");
    $fk_hospital = filter_input(INPUT_POST, "fk_hospital");

    $visita = new visita();

    // Validação mínima de dados
    if (!empty($visitaNome)) {

        $visita->visitaNome = $visitaNome;
        $visita->valor_diaria = $valor_diaria;
        $visita->usuario_create = $usuario_create;
        $visita->fk_hospital = $fk_hospital;

        $visitaDao->create($visita);
    } else {

        $message->setMessage("Você precisa adicionar pelo menos: visitaNome do visita!", "error", "back");
    }
} else if ($type === "update") {

    $visita = new visita();

    // Receber os dados dos inputs
    $id_visita = filter_input(INPUT_POST, "id_visita");
    $fk_hospital = filter_input(INPUT_POST, "fk_hospital");
    $valor_diaria = filter_input(INPUT_POST, "valor_diaria");

    $visita = $visitaDao->findById($id_visita);

    $visita['id_visita'] = $id_visita;
    $visita['fk_hospital'] = $fk_hospital;
    $visita['valor_diaria'] = $valor_diaria;

    $visitaDao->update($visita);

    include_once('list_visita.php');
}

$type = filter_input(INPUT_POST, "type");

if ($type === "delete") {
    // Recebe os dados do form
    $id_visita = filter_input(INPUT_GET, "id_visita");

    $visitaDao = new visitaDAO($conn, $BASE_URL);

    $visita = $visitaDao->findById($id_visita);
    if ($visita) {

        $visitaDao->destroy($id_visita);

        include_once('list_visita.php');
    } else {

        $message->setMessage("Informações inválidas!", "error", "index.php");
    }
}
