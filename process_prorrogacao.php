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
    $fk_internacao_pror = filter_input(INPUT_POST, "fk_internacao_pror");
    $acomod1_pror = filter_input(INPUT_POST, "acomod1_pror");
    $isol_1_pror = filter_input(INPUT_POST, "isol_1_pror");
    $prorrog1_fim_pror = filter_input(INPUT_POST, "prorrog1_fim_pror") ?: null;
    $prorrog1_ini_pror = filter_input(INPUT_POST, "prorrog1_ini_pror") ?: null;
    $acomod2_pror = filter_input(INPUT_POST, "acomod2_pror");
    $isol_2_pror = filter_input(INPUT_POST, "isol_2_pror");
    $prorrog2_fim_pror = filter_input(INPUT_POST, "prorrog2_fim_pror") ?: null;
    $prorrog2_ini_pror = filter_input(INPUT_POST, "prorrog2_ini_pror") ?: null;
    $acomod3_pror = filter_input(INPUT_POST, "acomod3_pror");
    $isol_3_pror = filter_input(INPUT_POST, "isol_3_pror");
    $prorrog3_fim_pror = filter_input(INPUT_POST, "prorrog3_fim_pror") ?: null;
    $prorrog3_ini_pror = filter_input(INPUT_POST, "prorrog3_ini_pror") ?: null;
    $fk_usuario_pror = filter_input(INPUT_POST, "fk_usuario_pror");

    $prorrogacao = new prorrogacao();

    // Validação mínima de dados
    if (!empty($acomod1_pror)) {

        $prorrogacao->fk_internacao_pror = $fk_internacao_pror;
        $prorrogacao->acomod1_pror = $acomod1_pror;
        $prorrogacao->isol_1_pror = $isol_1_pror;
        $prorrogacao->prorrog1_fim_pror = $prorrog1_fim_pror;
        $prorrogacao->prorrog1_ini_pror = $prorrog1_ini_pror;
        $prorrogacao->acomod2_pror = $acomod2_pror;
        $prorrogacao->isol_2_pror = $isol_2_pror;
        $prorrogacao->prorrog2_fim_pror = $prorrog2_fim_pror;
        $prorrogacao->prorrog2_ini_pror = $prorrog2_ini_pror;
        $prorrogacao->acomod3_pror = $acomod3_pror;
        $prorrogacao->isol_3_pror = $isol_3_pror;
        $prorrogacao->prorrog3_fim_pror = $prorrog3_fim_pror;
        $prorrogacao->fk_usuario_pror = $fk_usuario_pror;
        $prorrogacao->prorrog3_ini_pror = $prorrog3_ini_pror;

        $prorrogacaoDao->create($prorrogacao);
    } else {

        $message->setMessage("Você precisa adicionar pelo menos: prorrogacao!", "error", "back");
    }
}
if ($type === "create-vis") {

    // Receber os dados dos inputs
    $fk_internacao_pror = filter_input(INPUT_POST, "fk_internacao_pror");
    $acomod1_pror = filter_input(INPUT_POST, "acomod1_pror");
    $isol_1_pror = filter_input(INPUT_POST, "isol_1_pror");
    $prorrog1_fim_pror = filter_input(INPUT_POST, "prorrog1_fim_pror") ?: null;
    $prorrog1_ini_pror = filter_input(INPUT_POST, "prorrog1_ini_pror") ?: null;
    $acomod2_pror = filter_input(INPUT_POST, "acomod2_pror");
    $isol_2_pror = filter_input(INPUT_POST, "isol_2_pror");
    $prorrog2_fim_pror = filter_input(INPUT_POST, "prorrog2_fim_pror") ?: null;
    $prorrog2_ini_pror = filter_input(INPUT_POST, "prorrog2_ini_pror") ?: null;
    $acomod3_pror = filter_input(INPUT_POST, "acomod3_pror");
    $isol_3_pror = filter_input(INPUT_POST, "isol_3_pror");
    $prorrog3_fim_pror = filter_input(INPUT_POST, "prorrog3_fim_pror") ?: null;
    $prorrog3_ini_pror = filter_input(INPUT_POST, "prorrog3_ini_pror") ?: null;

    $prorrogacao = new prorrogacao();

    // Validação mínima de dados
    if (!empty($acomod1_pror)) {

        $prorrogacao->fk_internacao_pror = $fk_internacao_pror;
        $prorrogacao->acomod1_pror = $acomod1_pror;
        $prorrogacao->isol_1_pror = $isol_1_pror;
        $prorrogacao->prorrog1_fim_pror = $prorrog1_fim_pror;
        $prorrogacao->prorrog1_ini_pror = $prorrog1_ini_pror;
        $prorrogacao->acomod2_pror = $acomod2_pror;
        $prorrogacao->isol_2_pror = $isol_2_pror;
        $prorrogacao->prorrog2_fim_pror = $prorrog2_fim_pror;
        $prorrogacao->prorrog2_ini_pror = $prorrog2_ini_pror;
        $prorrogacao->acomod3_pror = $acomod3_pror;
        $prorrogacao->isol_3_pror = $isol_3_pror;
        $prorrogacao->prorrog3_fim_pror = $prorrog3_fim_pror;
        $prorrogacao->prorrog3_ini_pror = $prorrog3_ini_pror;

        $prorrogacaoDao->create($prorrogacao);
    } else {

        $message->setMessage("Você precisa adicionar pelo menos: prorrogacao!", "error", "back");
    }
}
