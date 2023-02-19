<?php
include_once("check_logado.php");

require_once("globals.php");
require_once("db.php");
require_once("models/acomodacao.php");
require_once("models/message.php");
require_once("dao/usuarioDao.php");
require_once("dao/acomodacaoDao.php");

//$message = new Message($BASE_URL);
$userDao = new UserDAO($conn, $BASE_URL);
$acomodacaoDao = new acomodacaoDAO($conn, $BASE_URL);
//$acomodacao = new Paciente();
// Resgata o tipo do formulário

$type = "delete";
//$type = filter_input(INPUT_POST, "type");

if ($type === "delete") {
    // Recebe os dados do form
    $id_acomodacao = filter_input(INPUT_GET, "id_acomodacao");


    $acomodacaoDao = new acomodacaoDAO($conn, $BASE_URL);

    $acomodacao = $acomodacaoDao->joinAcomodacaoHospitalShow($id_acomodacao);

    if ($acomodacao) {

        $acomodacaoDao->destroy($id_acomodacao);

        include_once('list_acomodacao.php');
    } else {

        //$message->setMessage("Informações inválidas!", "error", "index.php");
    }
}
