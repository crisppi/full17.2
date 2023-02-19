<?php

require_once("globals.php");
require_once("db.php");
require_once("models/message.php");
require_once("dao/usuarioDao.php");

$message = new Message($BASE_URL);
$userDao = new UserDAO($conn, $BASE_URL);

// Resgata o tipo do formulário
$type = filter_input(INPUT_POST, "type");

// Resgata dados do usuário

if ($type === "create") {

    // Receber os dados dos inputs
    $usuario_user = filter_input(INPUT_POST, "usuario_user");
    $endereco_user = filter_input(INPUT_POST, "endereco_user");
    $email01_user = filter_input(INPUT_POST, "email01_user");
    $cidade_user = filter_input(INPUT_POST, "cidade_user");
    $cpf_user = filter_input(INPUT_POST, "cpf_user");
    $telefone01_user = filter_input(INPUT_POST, "telefone01_user");
    $telefone02_user = filter_input(INPUT_POST, "telefone02_user");
    $email02_user = filter_input(INPUT_POST, "email02_user");
    $numero_user = filter_input(INPUT_POST, "numero_user");
    $bairro_user = filter_input(INPUT_POST, "bairro_user");
    $ativo_user = filter_input(INPUT_POST, "ativo_user");
    $vinculo_user = filter_input(INPUT_POST, "vinculo_user");
    $usuario_create_user = filter_input(INPUT_POST, "usuario_create_user");
    $data_create_user = filter_input(INPUT_POST, "data_create_user");
    $data_adm = filter_input(INPUT_POST, "data_adm");
    $cpf_user = filter_input(INPUT_POST, "cpf_user");
    $cargo_user = filter_input(INPUT_POST, "cargo_user");
    $reg_profissional_user = filter_input(INPUT_POST, "reg_profissional_user");
    $senha_user = password_hash(filter_input(INPUT_POST, "senha_user"), PASSWORD_DEFAULT);


    $senha_user = password_hash($hash_user, PASSWORD_DEFAULT);

    $usuario = new Usuario();

    // Validação mínima de dados
    if (!empty($usuario_user)) {

        $usuario->usuario_user = $usuario_user;
        $usuario->endereco_user = $endereco_user;
        $usuario->bairro_user = $bairro_user;
        $usuario->email02_user = $email02_user;
        $usuario->email_user = $email01_user;
        $usuario->cidade_user = $cidade_user;
        $usuario->telefone01_user = $telefone01_user;
        $usuario->telefone02_user = $telefone02_user;
        $usuario->numero_user = $numero_user;
        $usuario->ativo_user = $ativo_user;
        $usuario->reg_profissional_user = $reg_profissional_user;
        $usuario->cpf_user = $cpf_user;
        $usuario->senha_user = $senha_user;
        $usuario->usuario_create_user = $usuario_create_user;
        $usuario->data_adm_user = $data_adm_user;
        $usuario->vinculo_user = $vinculo_user;
        $usuario->cargo_user = $cargo_user;

        $userDao->create($usuario);
    } else {

        //$message->setMessage("Você precisa adicionar pelo menos: nome do paciente!", "error", "back");
    }
} else if ($type === "update") {

    $usuarioDao = new userDAO($conn, $BASE_URL);

    // Receber os dados dos inputs
    $id_usuario = filter_input(INPUT_POST, "id_usuario");
    $usuario_user = filter_input(INPUT_POST, "usuario_user");
    $endereco_user = filter_input(INPUT_POST, "endereco_user");
    $email_user = filter_input(INPUT_POST, "email_user");
    $email02_user = filter_input(INPUT_POST, "email02_user");
    $cidade_user = filter_input(INPUT_POST, "cidade_user");
    $cpf_user = filter_input(INPUT_POST, "cpf_user");
    $telefone01_user = filter_input(INPUT_POST, "telefone01_user");
    $telefone02_user = filter_input(INPUT_POST, "telefone02_user");
    $numero_user = filter_input(INPUT_POST, "numero_user");
    $bairro_user = filter_input(INPUT_POST, "bairro_user");
    $ativo_user = filter_input(INPUT_POST, "ativo_user");
    $usuario_create_user = filter_input(INPUT_POST, "usuario_create_user");
    $vinculo_user = filter_input(INPUT_POST, "vinculo_user");
    $cargo_user = filter_input(INPUT_POST, "cargo_user");
    $senha_user = filter_input(INPUT_POST, "senha_user");
    $reg_profissional_user = filter_input(INPUT_POST, "reg_profissional_user");
    $data_adm = filter_input(INPUT_POST, "data_adm");
    $nivel_user = filter_input(INPUT_POST, "nivel_user");

    $usuarioData = $usuarioDao->findById_user($id_usuario);

    $usuarioData->id_usuario = $id_usuario;
    $usuarioData->usuario_user = $usuario_user;
    $usuarioData->endereco_user = $endereco_user;
    $usuarioData->email_user = $email_user;
    $usuarioData->email02_user = $email02_user;
    $usuarioData->cpf_user = $cpf_user;
    $usuarioData->telefone01_user = $telefone01_user;
    $usuarioData->telefone02_user = $telefone02_user;
    $usuarioData->cidade_user = $cidade_user;
    $usuarioData->numero_user = $numero_user;
    $usuarioData->bairro_user = $bairro_user;
    $usuarioData->usuario_create_user = $usuario_create_user;
    $usuarioData->vinculo_user = $vinculo_user;
    $usuarioData->cargo_user = $cargo_user;
    $usuarioData->senha_user = $senha_user;
    $usuarioData->reg_profissional_user = $reg_profissional_user;
    $usuarioData->data_adm_user = $data_adm_user;
    $usuarioData->ativo_user = $ativo_user;
    $usuarioData->nivel_user = $nivel_user;

    $usuarioDao->update($usuarioData);

    include_once('list_usuario.php');
}
