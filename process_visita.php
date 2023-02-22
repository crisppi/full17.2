<?php

require_once("globals.php");
require_once("db.php");
require_once("models/visita.php");
require_once("dao/visitaDao.php");

require_once("models/message.php");

require_once("models/usuario.php");
require_once("dao/usuarioDao.php");

$message = new Message($BASE_URL);
$userDao = new UserDAO($conn, $BASE_URL);
$visitaDao = new visitaDAO($conn, $BASE_URL);

// Resgata o tipo do formulário
$type = filter_input(INPUT_POST, "type");

// Resgata dados do usuário
// print_r($_SESSION);
// echo "<hr>";
// print_r($_POST);
// exit;
if ($type === "create") {

    // Receber os dados dos inputs
    $fk_internacao_vis = filter_input(INPUT_POST, "fk_internacao_vis");
    $usuario_create = filter_input(INPUT_POST, "usuario_create");
    $rel_visita_vis = filter_input(INPUT_POST, "rel_visita_vis");
    $acoes_int_vis = filter_input(INPUT_POST, "acoes_int_vis");
    $data_visita_vis = filter_input(INPUT_POST, "data_visita_vis");
    $visita_no_vis = filter_input(INPUT_POST, "visita_no_vis");
    $fk_usuario_vis = filter_input(INPUT_POST, "fk_usuario_vis");
    $visita_enf_vis = filter_input(INPUT_POST, "visita_enf_vis");
    $visita_med_vis = filter_input(INPUT_POST, "visita_med_vis");
    $visita_auditor_prof_enf = filter_input(INPUT_POST, "visita_auditor_prof_enf");
    $visita_auditor_prof_med = filter_input(INPUT_POST, "visita_auditor_prof_med");

    $visita = new visita();

    // Validação mínima de dados
    if (3 < 4) {

        $visita->fk_internacao_vis = $fk_internacao_vis;
        $visita->usuario_create = $usuario_create;
        $visita->rel_visita_vis = $rel_visita_vis;
        $visita->acoes_int_vis = $acoes_int_vis;
        $visita->data_visita_vis = $data_visita_vis;
        $visita->visita_no_vis = $visita_no_vis;
        $visita->fk_usuario_vis = $fk_usuario_vis;
        $visita->visita_enf_vis = $visita_enf_vis;
        $visita->visita_med_vis = $visita_med_vis;
        $visita->visita_auditor_prof_enf = $visita_auditor_prof_enf;
        $visita->visita_auditor_prof_med = $visita_auditor_prof_med;

        $visitaDao->create($visita);
    } else {

        $message->setMessage("Você precisa adicionar pelo menos: visita!", "error", "back");
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

    include_once('list_internacao.php');
}

$type = filter_input(INPUT_POST, "type");

if ($type === "delete") {
    // Recebe os dados do form
    $id_visita = filter_input(INPUT_GET, "id_visita");

    $visitaDao = new visitaDAO($conn, $BASE_URL);

    $visita = $visitaDao->findById($id_visita);
    if ($visita) {

        $visitaDao->destroy($id_visita);

        include_once('list_internacao.php');
    } else {

        $message->setMessage("Informações inválidas!", "error", "index.php");
    }
}
