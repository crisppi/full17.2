<?php

require_once("globals.php");
require_once("db.php");
require_once("models/paciente.php");
require_once("models/message.php");
require_once("dao/usuarioDao.php");
require_once("dao/pacienteDao.php");

$message = new Message($BASE_URL);
$userDao = new UserDAO($conn, $BASE_URL);
$pacienteDao = new PacienteDAO($conn, $BASE_URL);

// Resgata o tipo do formulário
$type = filter_input(INPUT_POST, "type");

// Resgata dados do usuário

if ($type === "create") {

    // Receber os dados dos inputs
    $nome_pac = filter_input(INPUT_POST, "nome_pac");
    $endereco_pac = filter_input(INPUT_POST, "endereco_pac");
    $email01_pac = filter_input(INPUT_POST, "email01_pac");
    $cidade_pac = filter_input(INPUT_POST, "cidade_pac");
    $cpf_pac = filter_input(INPUT_POST, "cpf_pac");
    $mae_pac = filter_input(INPUT_POST, "mae_pac");
    $idade_pac = filter_input(INPUT_POST, "idade_pac");
    $telefone01_pac = filter_input(INPUT_POST, "telefone01_pac");
    $telefone02_pac = filter_input(INPUT_POST, "telefone02_pac");
    $email02_pac = filter_input(INPUT_POST, "email02_pac");
    $numero_pac = filter_input(INPUT_POST, "numero_pac");
    $bairro_pac = filter_input(INPUT_POST, "bairro_pac");
    $ativo_pac = filter_input(INPUT_POST, "ativo_pac");
    $sexo_pac = filter_input(INPUT_POST, "sexo_pac");
    $usuario_create_pac = filter_input(INPUT_POST, "usuario_create_pac");
    $data_create_pac = filter_input(INPUT_POST, "data_create_pac");

    $paciente = new Paciente();

    // Validação mínima de dados
    if (!empty($nome_pac)) {

        $paciente->nome_pac = $nome_pac;
        $paciente->endereco_pac = $endereco_pac;
        $paciente->sexo_pac = $sexo_pac;
        $paciente->bairro_pac = $bairro_pac;
        $paciente->idade_pac = $idade_pac;
        $paciente->email02_pac = $email02_pac;
        $paciente->email01_pac = $email01_pac;
        $paciente->cidade_pac = $cidade_pac;
        $paciente->cpf_pac = $cpf_pac;
        $paciente->telefone01_pac = $telefone01_pac;
        $paciente->telefone02_pac = $telefone02_pac;
        $paciente->numero_pac = $numero_pac;
        $paciente->bairro_pac = $bairro_pac;
        $paciente->ativo_pac = $ativo_pac;
        $paciente->data_create_pac = $data_create_pac;
        $paciente->usuario_create_pac = $usuario_create_pac;

        //$data_create_pac->id_paciente = $userData->id_paciente;

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

                // Gerando o nome_pac da imagem
                $imageName = $movie->imageGenerateName();

                imagejpeg($imageFile, "./img/movies/" . $imageName, 100);

                $movie->image = $imageName;
            } else {

                $message->setMessage("Tipo inválido de imagem, insira png ou jpg!", "error", "back");
            }
        }
*/
        $pacienteDao->create($paciente);
    } else {

        $message->setMessage("Você precisa adicionar pelo menos: nome_pac do paciente!", "error", "back");
    }/*
} else if ($type === "delete") {
    // Recebe os dados do form
    $id_paciente = filter_input(INPUT_POST, "id_paciente");

    $pacienteDao = new PacienteDAO($conn, $BASE_URL);

    $paciente = $pacienteDao->findById($id_paciente);

    if ($paciente) {

        $pacienteDao->destroy($id_paciente);
    } else {

        //$message->setMessage("Informações inválidas!", "error", "index.php");
    }*/
} else if ($type === "update") {

    $pacienteDao = new PacienteDAO($conn, $BASE_URL);

    // Receber os dados dos inputs
    $id_paciente = filter_input(INPUT_POST, "id_paciente");
    $nome_pac = filter_input(INPUT_POST, "nome_pac");
    $endereco_pac = filter_input(INPUT_POST, "endereco_pac");
    $sexo_pac = filter_input(INPUT_POST, "sexo_pac");
    $email01_pac = filter_input(INPUT_POST, "email01_pac");
    $email02_pac = filter_input(INPUT_POST, "email02_pac");
    $cidade_pac = filter_input(INPUT_POST, "cidade_pac");
    $cpf_pac = filter_input(INPUT_POST, "cpf_pac");
    $telefone01_pac = filter_input(INPUT_POST, "telefone01_pac");
    $telefone02_pac = filter_input(INPUT_POST, "telefone02_pac");
    $numero_pac = filter_input(INPUT_POST, "numero_pac");
    $bairro_pac = filter_input(INPUT_POST, "bairro_pac");
    $mae_pac = filter_input(INPUT_POST, "mae_pac");
    $idade_pac = filter_input(INPUT_POST, "idade_pac");
    $status = filter_input(INPUT_POST, "status");

    $pacienteData = $pacienteDao->findById($id_paciente);

    $pacienteData->id_paciente = $id_paciente;
    $pacienteData->nome_pac = $nome_pac;
    $pacienteData->endereco_pac = $endereco_pac;
    $pacienteData->email01_pac = $email01_pac;
    $pacienteData->email02_pac = $email02_pac;
    $pacienteData->cidade_pac = $cidade_pac;
    $pacienteData->cpf_pac = $cpf_pac;
    $pacienteData->telefone01_pac = $telefone01_pac;
    $pacienteData->telefone02_pac = $telefone02_pac;
    $pacienteData->mae_pac = $mae_pac;
    $pacienteData->idade_pac = $idade_pac;
    $pacienteData->numero_pac = $numero_pac;
    $pacienteData->bairro_pac = $bairro_pac;
    $pacienteData->sexo_pac = $sexo_pac;

    $pacienteDao->update($pacienteData);

    include_once('list_paciente.php');
}
//$type = "delete";
//$type = filter_input(INPUT_POST, "type");

if ($type === "delete") {
    // Recebe os dados do form
    $id_paciente = filter_input(INPUT_GET, "id_paciente");

    $pacienteDao = new PacienteDAO($conn, $BASE_URL);

    $paciente = $pacienteDao->findById($id_paciente);

    echo $paciente;
    if ($paciente) {

        $pacienteDao->destroy($id_paciente);

        include_once('list_paciente.php');
    } else {

        $message->setMessage("Informações inválidas!", "error", "index.php");
    }
}
