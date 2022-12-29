<?php

require_once("globals.php");
require_once("db.php");
require_once("models/gestao.php");
require_once("models/message.php");
require_once("dao/usuarioDao.php");
require_once("dao/gestaoDao.php");

$message = new Message($BASE_URL);
$userDao = new UserDAO($conn, $BASE_URL);
$gestaoDao = new gestaoDAO($conn, $BASE_URL);

// Resgata o tipo do formulário
$type = filter_input(INPUT_POST, "type");

// Resgata dados do usuário

if ($type === "create") {

    // Receber os dados dos inputs
    $alto_custo_ges = filter_input(INPUT_POST, "alto_custo_ges");
    $rel_alto_custo_ges = filter_input(INPUT_POST, "rel_alto_custo_ges");
    $fk_internacao_ges = filter_input(INPUT_POST, "fk_internacao_ges");

    $gestao = new gestao();

    // Validação mínima de dados
    if (!empty($alto_custo_ges)) {

        $gestao->alto_custo_ges = $alto_custo_ges;
        $gestao->rel_alto_custo_ges = $rel_alto_custo_ges;
        $gestao->fk_internacao_ges = $fk_internacao_ges;

        $gestaoDao->create($gestao);
    } else {

        $message->setMessage("Você precisa adicionar pelo menos: gestao_aco do gestao!", "error", "back");
    }
} else if ($type === "update") {

    $gestao = new gestao();

    // Receber os dados dos inputs
    $id_gestao = filter_input(INPUT_POST, "id_gestao");
    $fk_hospital = filter_input(INPUT_POST, "fk_hospital");
    $gestao_aco = filter_input(INPUT_POST, "gestao_aco");
    $valor_aco = filter_input(INPUT_POST, "valor_aco");

    $gestao = $gestaoDao->joingestaoHospitalshow($id_gestao);

    $gestao['id_gestao'] = $id_gestao;
    $gestao['fk_hospital'] = $fk_hospital;
    $gestao['valor_aco'] = $valor_aco;
    $gestao['gestao_aco'] = $gestao_aco;

    $gestaoDao->update($gestao);

    include_once('list_gestao.php');
}

$type = filter_input(INPUT_GET, "type");

if ($type === "delete") {
    // Recebe os dados do form
    $id_gestao = filter_input(INPUT_GET, "id_gestao");

    $gestaoDao = new gestaoDAO($conn, $BASE_URL);

    $gestao = $gestaoDao->joingestaoHospitalShow($id_gestao);
    if ($gestao) {

        $gestaoDao->destroy($id_gestao);

        include_once('list_gestao.php');
    } else {

        $message->setMessage("Informações inválidas!", "error", "index.php");
    }
}
