<?php
require_once("globals.php");
require_once("db.php");
require_once("models/hospital.php");
require_once("models/message.php");
require_once("dao/usuarioDao.php");
require_once("dao/hospitalDao.php");

$message = new Message($BASE_URL);
$userDao = new UserDAO($conn, $BASE_URL);
$hospitalDao = new hospitalDAO($conn, $BASE_URL);

// Resgata o tipo do formulário
$type = filter_input(INPUT_POST, "type");

// Resgata dados do usuário

if ($type === "create") {

    // Receber os dados dos inputs
    $nome_hosp = filter_input(INPUT_POST, "nome_hosp");
    $endereco_hosp = filter_input(INPUT_POST, "endereco_hosp");
    $email01_hosp = filter_input(INPUT_POST, "email01_hosp");
    $cidade_hosp = filter_input(INPUT_POST, "cidade_hosp");
    $cnpj_hosp = filter_input(INPUT_POST, "cnpj_hosp");
    $telefone01_hosp = filter_input(INPUT_POST, "telefone01_hosp");
    $telefone02_hosp = filter_input(INPUT_POST, "telefone02_hosp");
    $email02_hosp = filter_input(INPUT_POST, "email02_hosp");
    $numero_hosp = filter_input(INPUT_POST, "numero_hosp");
    $bairro_hosp = filter_input(INPUT_POST, "bairro_hosp");
    $fk_usuario_hosp = filter_input(INPUT_POST, "fk_usuario_hosp");

    $hospital = new hospital();

    // Validação mínima de dados
    if (!empty($nome_hosp)) {

        $hospital->nome_hosp = $nome_hosp;
        $hospital->endereco_hosp = $endereco_hosp;
        $hospital->bairro_hosp = $bairro_hosp;
        $hospital->email02_hosp = $email02_hosp;
        $hospital->email01_hosp = $email01_hosp;
        $hospital->cidade_hosp = $cidade_hosp;
        $hospital->cnpj_hosp = $cnpj_hosp;
        $hospital->telefone01_hosp = $telefone01_hosp;
        $hospital->telefone02_hosp = $telefone02_hosp;
        $hospital->numero_hosp = $numero_hosp;
        $hospital->bairro_hosp = $bairro_hosp;
        $hospital->fk_usuario_hosp = $fk_usuario_hosp;

        $hospitalDao->create($hospital);
    } else {

        $message->setMessage("Você precisa adicionar pelo menos: hospitalNome do hospital!", "error", "back");
    }
} else if ($type === "update") {

    $hospitalDao = new hospitalDAO($conn, $BASE_URL);

    // Receber os dados dos inputs
    $id_hospital = filter_input(INPUT_POST, "id_hospital");
    $nome_hosp = filter_input(INPUT_POST, "nome_hosp");
    $endereco_hosp = filter_input(INPUT_POST, "endereco_hosp");
    $email01_hosp = filter_input(INPUT_POST, "email01_hosp");
    $cidade_hosp = filter_input(INPUT_POST, "cidade_hosp");
    $cnpj_hosp = filter_input(INPUT_POST, "cnpj_hosp");
    $telefone01_hosp = filter_input(INPUT_POST, "telefone01_hosp");
    $telefone02_hosp = filter_input(INPUT_POST, "telefone02_hosp");
    $numero_hosp = filter_input(INPUT_POST, "numero_hosp");
    $bairro_hosp = filter_input(INPUT_POST, "bairro_hosp");

    $hospitalData = $hospitalDao->findById($id_hospital);

    $hospitalData->id_hospital = $id_hospital;
    $hospitalData->nome_hosp = $nome_hosp;
    $hospitalData->endereco_hosp = $endereco_hosp;
    $hospitalData->email01_hosp = $email01_hosp;
    $hospitalData->cidade_hosp = $cidade_hosp;
    $hospitalData->telefone01_hosp = $telefone01_hosp;
    $hospitalData->telefone02_hosp = $telefone02_hosp;
    $hospitalData->numero_hosp = $numero_hosp;
    $hospitalData->bairro_hosp = $bairro_hosp;

    $hospitalDao->update($hospitalData);

    include_once('list_hospital.php');
}
//$type = "delete";
//$type = filter_input(INPUT_POST, "type");

if ($type === "delete") {
    // Recebe os dados do form
    $id_hospital = filter_input(INPUT_GET, "id_hospital");

    $hospitalDao = new hospitalDAO($conn, $BASE_URL);

    $hospital = $hospitalDao->findById($id_hospital);

    echo $hospital;
    if ($hospital) {

        $hospitalDao->destroy($id_hospital);

        include_once('list_hospital.php');
    } else {

        $message->setMessage("Informações inválidas!", "error", "index.php");
    }
}
