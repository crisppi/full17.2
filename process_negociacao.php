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

if ($type === "create") {

    // Receber os dados dos inputs
    $troca_de_1 = filter_input(INPUT_POST, "troca_de_1");
    $troca_para_1 = filter_input(INPUT_POST, "troca_para_1");
    $fk_id_int = filter_input(INPUT_POST, "fk_id_int");

    foreach ($niveis as $query) {
        echo "<pre>";
        // print_r($query);
        print_r($troca_de_1);
        if ($troca_de_1 === $query['acomodacao_aco']) {
            $valor = $query['valor_aco'];
            print_r($valor);
            print_r($query['acomodacao_aco']);
            print_r("chegou");
        }
    };


    exit;
    $negociacao = new negociacao();

    // Validação mínima de dados
    if (3 < 4) {

        $negociacao->troca_de_1 = $troca_de_1;
        $negociacao->troca_para_1 = $troca_para_1;
        $negociacao->fk_id_int = $fk_id_int;

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

// $type = filter_input(INPUT_GET, "type");

// if ($type === "delete") {
//     // Recebe os dados do form
//     $id_negociacao = filter_input(INPUT_GET, "id_negociacao");

//     $negociacaoDao = new negociacaoDAO($conn, $BASE_URL);

//     $negociacao = $negociacaoDao->joinnegociacaoHospitalShow($id_negociacao);
//     if ($negociacao) {

//         $negociacaoDao->destroy($id_negociacao);

//         include_once('list_negociacao.php');
//     } else {

//         $message->setMessage("Informações inválidas!", "error", "index.php");
//     }
// }
