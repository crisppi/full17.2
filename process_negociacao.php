<?php

require_once("globals.php");
require_once("db.php");
require_once("models/negociacao.php");
require_once("models/message.php");
require_once("dao/usuarioDao.php");
require_once("dao/negociacaoDao.php");
include_once("models/internacao.php");
require_once("dao/internacaoDao.php");

$message = new Message($BASE_URL);
$userDao = new UserDAO($conn, $BASE_URL);
$negociacaoDao = new negociacaoDAO($conn, $BASE_URL);

$internacaoDAO = new internacaoDAO($conn, $BASE_URL);
$internacaoID = $internacaoDAO->findLastId();
$internacaoID = $internacaoID['0'];

$a = $internacaoID['0'];

$niveis = $internacaoDAO->findLast($a);


// Resgata o tipo do formulário
$type = filter_input(INPUT_POST, "type");

// Resgata dados do usuário
$valor_de_1 = $valor_para_1 = null;
$valor_de_2 = $valor_para_2 = null;
$valor_de_3 = $valor_para_3 = null;

if ($type === "create") {

    // Receber os dados dos inputs
    $troca_de_1 = filter_input(INPUT_POST, "troca_de_1");
    $troca_para_1 = filter_input(INPUT_POST, "troca_para_1");
    $fk_id_int = filter_input(INPUT_POST, "fk_id_int");
    $qtd_1 = filter_input(INPUT_POST, "qtd_1");

    $troca_de_2 = filter_input(INPUT_POST, "troca_de_2");
    $troca_para_2 = filter_input(INPUT_POST, "troca_para_2");
    $qtd_2 = filter_input(INPUT_POST, "qtd_2");

    $troca_de_3 = filter_input(INPUT_POST, "troca_de_3");
    $troca_para_3 = filter_input(INPUT_POST, "troca_para_3");
    $qtd_3 = filter_input(INPUT_POST, "qtd_3");


    foreach ($niveis as $query) {

        if ($troca_de_1 === $query['acomodacao_aco']) {
            $valor_de_1 = $query['valor_aco'];
        }
    };
    foreach ($niveis as $query) {

        if ($troca_para_1 === $query['acomodacao_aco']) {
            $valor_para_1 = $query['valor_aco'];
        }
    };

    foreach ($niveis as $query) {

        if ($troca_de_2 === $query['acomodacao_aco']) {
            $valor_de_2 = $query['valor_aco'];
        }
    };
    foreach ($niveis as $query) {

        if ($troca_para_2 === $query['acomodacao_aco']) {
            $valor_para_2 = $query['valor_aco'];
        }
    };

    foreach ($niveis as $query) {

        if ($troca_de_3 === $query['acomodacao_aco']) {
            $valor_de_3 = $query['valor_aco'];
        }
    };
    foreach ($niveis as $query) {

        if ($troca_para_3 === $query['acomodacao_aco']) {
            $valor_para_3 = $query['valor_aco'];
        }
    };
    // valorozacao das diarias
    $dif_aco_1 = $valor_de_1 - $valor_para_1;
    $dif_1 = $dif_aco_1 * $qtd_1;
    $dif_aco_2 = $valor_de_2 - $valor_para_2;
    $dif_2 = $dif_aco_2 * $qtd_2;
    $dif_aco_3 = $valor_de_3 - $valor_para_3;
    $dif_3 = $dif_aco_3 * $qtd_3;

    $negociacao = new negociacao();

    // Validação mínima de dados
    if (3 < 4) {

        $negociacao->troca_de_1 = $troca_de_1;
        $negociacao->troca_para_1 = $troca_para_1;
        $negociacao->fk_id_int = $fk_id_int;
        $negociacao->valor_de_1 = $valor_de_1;
        $negociacao->valor_para_1 = $valor_para_1;
        $negociacao->dif_1 = $dif_1;
        $negociacao->qtd_1 = $qtd_1;

        $negociacao->troca_de_2 = $troca_de_2;
        $negociacao->troca_para_2 = $troca_para_2;
        $negociacao->valor_de_2 = $valor_de_2;
        $negociacao->valor_para_2 = $valor_para_2;
        $negociacao->dif_2 = $dif_2;
        $negociacao->qtd_2 = $qtd_2;

        $negociacao->troca_de_3 = $troca_de_3;
        $negociacao->troca_para_3 = $troca_para_3;
        $negociacao->valor_de_3 = $valor_de_3;
        $negociacao->valor_para_3 = $valor_para_3;
        $negociacao->dif_3 = $dif_3;
        $negociacao->qtd_3 = $qtd_3;

        $negociacaoDao->create($negociacao);
    } else {

        $message->setMessage("Você precisa adicionar pelo menos: negociacao_aco do negociacao!", "error", "back");
    }
} else if ($type === "update") {

    $negociacao = new negociacao();

    // Receber os dados dos inputs
    $id_negociacao = filter_input(INPUT_POST, "id_negociacao");
    $fk_hospital = filter_input(INPUT_POST, "fk_hospital");
    $negociacao_aco = filter_input(INPUT_POST, "negociacao_aco");
    $valor_aco = filter_input(INPUT_POST, "valor_aco");

    $negociacao = $negociacaoDao->joinnegociacaoHospitalshow($id_negociacao);

    $negociacao['id_negociacao'] = $id_negociacao;
    $negociacao['fk_hospital'] = $fk_hospital;
    $negociacao['valor_aco'] = $valor_aco;
    $negociacao['negociacao_aco'] = $negociacao_aco;

    $negociacaoDao->update($negociacao);

    include_once('cad_internacao_niveis.php');
}
