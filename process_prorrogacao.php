<?php

require_once("globals.php");
require_once("db.php");
require_once("models/prorrogacao.php");
require_once("models/message.php");
require_once("dao/usuarioDao.php");
require_once("dao/prorrogacaoDao.php");

$message = new Message($BASE_URL);
$userDao = new UserDAO($conn, $BASE_URL);
$prorrogacaoDao = new prorrogacaoDAO($conn, $BASE_URL);

// Resgata o tipo do formulário
$type = filter_input(INPUT_POST, "type");

// Resgata dados do usuário

if ($type === "create") {

    // Receber os dados dos inputs
    $acomod1_pror = filter_input(INPUT_POST, "acomod1_pror");
    $isol_1_pror = filter_input(INPUT_POST, "isol_1_pror");
    $prorrog1_fim_pror = filter_input(INPUT_POST, "prorrog1_fim_pror");
    $prorrog1_ini_pror = filter_input(INPUT_POST, "prorrog1_ini_pror");

    $prorrogacao = new prorrogacao();

    // Validação mínima de dados
    if (!empty($acomod1_pror)) {

        $prorrogacao->acomod1_pror = $acomod1_pror;
        $prorrogacao->isol_1_pror = $isol_1_pror;
        $prorrogacao->prorrog1_fim_pror = $prorrog1_fim_pror;
        $prorrogacao->prorrog1_ini_pror = $prorrog1_ini_pror;

        $prorrogacaoDao->create($prorrogacao);
    } else {

        $message->setMessage("Você precisa adicionar pelo menos: prorrogacao_aco do prorrogacao!", "error", "back");
    }
} else if ($type === "update") {

    $prorrogacao = new prorrogacao();

    // Receber os dados dos inputs
    $id_prorrogacao = filter_input(INPUT_POST, "id_prorrogacao");
    $fk_hospital = filter_input(INPUT_POST, "fk_hospital");
    $prorrogacao_aco = filter_input(INPUT_POST, "prorrogacao_aco");
    $valor_aco = filter_input(INPUT_POST, "valor_aco");

    $prorrogacao = $prorrogacaoDao->joinprorrogacaoHospitalshow($id_prorrogacao);

    $prorrogacao['id_prorrogacao'] = $id_prorrogacao;
    $prorrogacao['fk_hospital'] = $fk_hospital;
    $prorrogacao['valor_aco'] = $valor_aco;
    $prorrogacao['prorrogacao_aco'] = $prorrogacao_aco;

    $prorrogacaoDao->update($prorrogacao);

    include_once('list_prorrogacao.php');
}

$type = filter_input(INPUT_GET, "type");

if ($type === "delete") {
    // Recebe os dados do form
    $id_prorrogacao = filter_input(INPUT_GET, "id_prorrogacao");

    $prorrogacaoDao = new prorrogacaoDAO($conn, $BASE_URL);

    $prorrogacao = $prorrogacaoDao->joinprorrogacaoHospitalShow($id_prorrogacao);
    if ($prorrogacao) {

        $prorrogacaoDao->destroy($id_prorrogacao);

        //include_once('list_prorrogacao.php');
    } else {

        $message->setMessage("Informações inválidas!", "error", "index.php");
    }
}
