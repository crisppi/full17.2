<?php

require_once("globals.php");
require_once("db.php");
require_once("models/estipulante.php");
require_once("models/message.php");
require_once("dao/usuarioDao.php");
require_once("dao/estipulanteDao.php");

$message = new Message($BASE_URL);
$userDao = new UserDAO($conn, $BASE_URL);
$estipulanteDao = new estipulanteDAO($conn, $BASE_URL);

// Resgata o tipo do formulário
$type = filter_input(INPUT_POST, "type");

// Resgata dados do usuário

if ($type === "create") {

    // Receber os dados dos inputs
    $nome_est = filter_input(INPUT_POST, "nome_est");
    $endereco_est = filter_input(INPUT_POST, "endereco_est");
    $email01_est = filter_input(INPUT_POST, "email01_est");
    $cidade_est = filter_input(INPUT_POST, "cidade_est");
    $cnpj_est = filter_input(INPUT_POST, "cnpj_est");
    $telefone01_est = filter_input(INPUT_POST, "telefone01_est");
    $telefone02_est = filter_input(INPUT_POST, "telefone02_est");
    $email02_est = filter_input(INPUT_POST, "email02_est");
    $numero_est = filter_input(INPUT_POST, "numero_est");
    $bairro_est = filter_input(INPUT_POST, "bairro_est");

    $estipulante = new estipulante();

    // Validação mínima de dados
    if (!empty($nome_est)) {

        $estipulante->nome_est = $nome_est;
        $estipulante->endereco_est = $endereco_est;
        $estipulante->bairro_est = $bairro_est;
        $estipulante->email02_est = $email02_est;
        $estipulante->email01_est = $email01_est;
        $estipulante->cidade_est = $cidade_est;
        $estipulante->cnpj_est = $cnpj_est;
        $estipulante->telefone01_est = $telefone01_est;
        $estipulante->telefone02_est = $telefone02_est;
        $estipulante->numero_est = $numero_est;
        $estipulante->bairro_est = $bairro_est;


        $estipulanteDao->create($estipulante);
    } else {

        $message->setMessage("Você precisa adicionar pelo menos: nome_est do estipulante!", "error", "back");
    }
} else if ($type === "update") {

    $estipulanteDao = new estipulanteDAO($conn, $BASE_URL);

    // Receber os dados dos inputs
    $id_estipulante = filter_input(INPUT_POST, "id_estipulante");
    $nome_est = filter_input(INPUT_POST, "nome_est");
    $endereco_est = filter_input(INPUT_POST, "endereco_est");
    $email01_est = filter_input(INPUT_POST, "email01_est");
    $cidade_est = filter_input(INPUT_POST, "cidade_est");
    $cnpj_est = filter_input(INPUT_POST, "cnpj_est");
    $telefone01_est = filter_input(INPUT_POST, "telefone01_est");
    $telefone02_est = filter_input(INPUT_POST, "telefone02_est");
    $numero_est = filter_input(INPUT_POST, "numero_est");
    $bairro_est = filter_input(INPUT_POST, "bairro_est");

    $estipulanteData = $estipulanteDao->findById($id_estipulante);

    $estipulanteData->id_estipulante = $id_estipulante;
    $estipulanteData->nome_est = $nome_est;
    $estipulanteData->endereco_est = $endereco_est;
    $estipulanteData->email01_est = $email01_est;
    $estipulanteData->cidade_est = $cidade_est;
    $estipulanteData->telefone01_est = $telefone01_est;
    $estipulanteData->telefone02_est = $telefone02_est;
    $estipulanteData->numero_est = $numero_est;
    $estipulanteData->bairro_est = $bairro_est;

    $estipulanteDao->update($estipulanteData);

    include_once('list_estipulante.php');
}
//$type = "delete";
//$type = filter_input(INPUT_POST, "type");

if ($type === "delete") {
    // Recebe os dados do form
    $id_estipulante = filter_input(INPUT_GET, "id_estipulante");

    $estipulanteDao = new estipulanteDAO($conn, $BASE_URL);

    $estipulante = $estipulanteDao->findById($id_estipulante);

    echo $estipulante;
    if ($estipulante) {

        $estipulanteDao->destroy($id_estipulante);

        include_once('list_estipulante.php');
    } else {

        $message->setMessage("Informações inválidas!", "error", "index.php");
    }
}
