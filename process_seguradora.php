<?php

require_once("globals.php");
require_once("db.php");
require_once("models/seguradora.php");
require_once("models/message.php");
require_once("dao/usuarioDao.php");
require_once("dao/seguradoraDao.php");

$message = new Message($BASE_URL);
$userDao = new UserDAO($conn, $BASE_URL);
$seguradoraDao = new seguradoraDAO($conn, $BASE_URL);

// Resgata o tipo do formulário
$type = filter_input(INPUT_POST, "type");

// Resgata dados do usuário

if ($type === "create") {

    // Receber os dados dos inputs
    $seguradora_seg = filter_input(INPUT_POST, "seguradora_seg");
    $endereco_seg = filter_input(INPUT_POST, "endereco_seg");
    $email01_seg = filter_input(INPUT_POST, "email01_seg");
    $cidade_seg = filter_input(INPUT_POST, "cidade_seg");
    $cnpj_seg = filter_input(INPUT_POST, "cnpj_seg");
    $telefone01_seg = filter_input(INPUT_POST, "telefone01_seg");
    $telefone02_seg = filter_input(INPUT_POST, "telefone02_seg");
    $email02_seg = filter_input(INPUT_POST, "email02_seg");
    $numero_seg = filter_input(INPUT_POST, "numero_seg");
    $bairro_seg = filter_input(INPUT_POST, "bairro_seg");
    $data_create_seg = filter_input(INPUT_POST, "data_create_seg");
    $usuario_create_seg = filter_input(INPUT_POST, "usuario_create_seg");

    $seguradora = new seguradora();

    // Validação mínima de dados
    if (!empty($seguradora_seg)) {

        $seguradora->seguradora_seg = $seguradora_seg;
        $seguradora->endereco_seg = $endereco_seg;
        $seguradora->bairro_seg = $bairro_seg;
        $seguradora->email02_seg = $email02_seg;
        $seguradora->email01_seg = $email01_seg;
        $seguradora->cidade_seg = $cidade_seg;
        $seguradora->cnpj_seg = $cnpj_seg;
        $seguradora->telefone01_seg = $telefone01_seg;
        $seguradora->telefone02_seg = $telefone02_seg;
        $seguradora->numero_seg = $numero_seg;
        $seguradora->bairro_seg = $bairro_seg;
        $seguradora->data_create_seg = $data_create_seg;
        $seguradora->usuario_create_seg = $usuario_create_seg;


        $seguradoraDao->create($seguradora);
    } else {

        $message->setMessage("Você precisa adicionar pelo menos: seguradora_seg do seguradora!", "error", "back");
    }
} else if ($type === "update") {

    $seguradoraDao = new seguradoraDAO($conn, $BASE_URL);

    // Receber os dados dos inputs
    $id_seguradora = filter_input(INPUT_POST, "id_seguradora");
    $seguradora_seg = filter_input(INPUT_POST, "seguradora_seg");
    $endereco_seg = filter_input(INPUT_POST, "endereco_seg");
    $email01_seg = filter_input(INPUT_POST, "email01_seg");
    $email02_seg = filter_input(INPUT_POST, "email02_seg");
    $cidade_seg = filter_input(INPUT_POST, "cidade_seg");
    $cnpj_seg = filter_input(INPUT_POST, "cnpj_seg");
    $telefone01_seg = filter_input(INPUT_POST, "telefone01_seg");
    $telefone02_seg = filter_input(INPUT_POST, "telefone02_seg");
    $numero_seg = filter_input(INPUT_POST, "numero_seg");
    $bairro_seg = filter_input(INPUT_POST, "bairro_seg");
    $data_create_seg = filter_input(INPUT_POST, "data_create_seg");
    $usuario_create_seg = filter_input(INPUT_POST, "usuario_create_seg");

    $seguradoraData = $seguradoraDao->findById($id_seguradora);

    $seguradoraData->id_seguradora = $id_seguradora;
    $seguradoraData->seguradora_seg = $seguradora_seg;
    $seguradoraData->endereco_seg = $endereco_seg;
    $seguradoraData->email01_seg = $email01_seg;
    $seguradoraData->email02_seg = $email02_seg;
    $seguradoraData->cidade_seg = $cidade_seg;
    $seguradoraData->telefone01_seg = $telefone01_seg;
    $seguradoraData->telefone02_seg = $telefone02_seg;
    $seguradoraData->numero_seg = $numero_seg;
    $seguradoraData->bairro_seg = $bairro_seg;
    $seguradora->data_create_seg = $data_create_seg;
    $seguradora->usuario_create_seg = $usuario_create_seg;


    $seguradoraDao->update($seguradoraData);

    include_once('list_seguradora.php');
}
