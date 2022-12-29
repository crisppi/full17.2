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

        //$seguradora->id_seguradora = $userData->id_seguradora;

        // Upload de imagem do filme ****** nao usaar if para imagem *******
        /* if (isset($_FILES["image"]) && !empty($_FILES["image"]["tmp_name"])) {

            $image = $_FILES["image"];
            $imageTypes = ["image/jpeg", "image/jpg", "image/png"];
            $jpgArray = ["image/jpeg", "image/jpg"];

            // Checando tipo da imagem
            if (in_array($image["type"], $imageTypes)) {

                // Checa se imagem é jpg
                if (in_array($image["type"], $jpgArray)) {
                    $imageFile = imagecreatefromjpeg($image["tmp_name"]);
                } else {
                    $imageFile = imagecreatefrompng($image["tmp_name"]);
                }

                // Gerando o seguradora_seg da imagem
                $imageName = $movie->imageGenerateName();

                imagejpeg($imageFile, "./img/movies/" . $imageName, 100);

                $movie->image = $imageName;
            } else {

                $message->setMessage("Tipo inválido de imagem, insira png ou jpg!", "error", "back");
            }
        }
*/
        $seguradoraDao->create($seguradora);
    } else {

        $message->setMessage("Você precisa adicionar pelo menos: seguradora_seg do seguradora!", "error", "back");
    }/*
} else if ($type === "delete") {
    // Recebe os dados do form
    $id_seguradora = filter_input(INPUT_POST, "id_seguradora");

    $seguradoraDao = new seguradoraDAO($conn, $BASE_URL);

    $seguradora = $seguradoraDao->findById($id_seguradora);

    if ($seguradora) {

        $seguradoraDao->destroy($id_seguradora);
    } else {

        //$message->setMessage("Informações inválidas!", "error", "index.php");
    }*/
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

    $seguradoraDao->update($seguradoraData);

    include_once('list_seguradora.php');
}
//$type = "delete";
//$type = filter_input(INPUT_POST, "type");

if ($type === "delete") {
    // Recebe os dados do form
    $id_seguradora = filter_input(INPUT_GET, "id_seguradora");

    $seguradoraDao = new seguradoraDAO($conn, $BASE_URL);

    $seguradora = $seguradoraDao->findById($id_seguradora);

    echo $seguradora;
    if ($seguradora) {

        $seguradoraDao->destroy($id_seguradora);

        include_once('list_seguradora.php');
    } else {

        $message->setMessage("Informações inválidas!", "error", "index.php");
    }
}
