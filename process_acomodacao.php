<?php

require_once("globals.php");
require_once("db.php");
require_once("models/acomodacao.php");
require_once("models/message.php");
require_once("dao/usuarioDao.php");
require_once("dao/acomodacaoDao.php");

$message = new Message($BASE_URL);
$userDao = new UserDAO($conn, $BASE_URL);
$acomodacaoDao = new acomodacaoDAO($conn, $BASE_URL);

// Resgata o tipo do formulário
$type = filter_input(INPUT_POST, "type");

// Resgata dados do usuário

if ($type === "create") {

    // Receber os dados dos inputs
    $acomodacao_aco = filter_input(INPUT_POST, "acomodacao_aco");
    $valor_aco = filter_input(INPUT_POST, "valor_aco");
    $fk_hospital = filter_input(INPUT_POST, "fk_hospital");
    $fk_usuario_aco = filter_input(INPUT_POST, "fk_usuario_aco");

    $acomodacao = new acomodacao();

    // Validação mínima de dados
    if (!empty($acomodacao_aco)) {

        $acomodacao->acomodacao_aco = $acomodacao_aco;
        $acomodacao->valor_aco = $valor_aco;
        $acomodacao->fk_hospital = $fk_hospital;
        $acomodacao->fk_usuario_aco = $fk_usuario_aco;

        $acomodacaoDao->create($acomodacao);
    } else {

        $message->setMessage("Você precisa adicionar pelo menos: acomodacao_aco do acomodacao!", "error", "back");
    }
} else if ($type === "update") {

    $acomodacao = new Acomodacao();

    // Receber os dados dos inputs
    $id_acomodacao = filter_input(INPUT_POST, "id_acomodacao");
    $fk_hospital = filter_input(INPUT_POST, "fk_hospital");
    $acomodacao_aco = filter_input(INPUT_POST, "acomodacao_aco");
    $valor_aco = filter_input(INPUT_POST, "valor_aco");

    $acomodacao = $acomodacaoDao->joinAcomodacaoHospitalshow($id_acomodacao);

    $acomodacao['id_acomodacao'] = $id_acomodacao;
    $acomodacao['fk_hospital'] = $fk_hospital;
    $acomodacao['valor_aco'] = $valor_aco;
    $acomodacao['acomodacao_aco'] = $acomodacao_aco;

    $acomodacaoDao->update($acomodacao);

    include_once('list_acomodacao.php');
}

$type = filter_input(INPUT_GET, "type");

if ($type === "delete") {
    // Recebe os dados do form
    $id_acomodacao = filter_input(INPUT_GET, "id_acomodacao");

    $acomodacaoDao = new acomodacaoDAO($conn, $BASE_URL);

    $acomodacao = $acomodacaoDao->joinAcomodacaoHospitalShow($id_acomodacao);
    if ($acomodacao) {

        $acomodacaoDao->destroy($id_acomodacao);

        include_once('list_acomodacao.php');
    } else {

        $message->setMessage("Informações inválidas!", "error", "index.php");
    }
}
