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

if ($type === "update") {

    // Receber os dados dos inputs
    $nome = filter_input(INPUT_POST, "nome");
    $endereco = filter_input(INPUT_POST, "endereco");
    $sexo = filter_input(INPUT_POST, "sexo");
    $email01 = filter_input(INPUT_POST, "email01");
    $cidade = filter_input(INPUT_POST, "cidade");
    $bairro = filter_input(INPUT_POST, "bairro");
    $idade = filter_input(INPUT_POST, "idade");
    $numero = filter_input(INPUT_POST, "numero");
    $email02 = filter_input(INPUT_POST, "email02");
    $telefone01 = filter_input(INPUT_POST, "telefone01");
    $telefone02 = filter_input(INPUT_POST, "telefone02");
    $cpf = filter_input(INPUT_POST, "cpf");
    $id_paciente = filter_input(INPUT_POST, "id_paciente");

    //$paciente = new Paciente();

    $pacienteData = $pacienteDao->findById($id_paciente);

    $pacienteData->nome = $nome;
    $pacienteData->endereco = $endereco;
    $pacienteData->email01 = $email01;
    $pacienteData->cidade = $cidade;
    $pacienteData->bairro = $bairro;
    $pacienteData->email02 = $email02;
    $pacienteData->telefone01 = $telefone01;
    $pacienteData->telefone02 = $telefone02;
    $pacienteData->numero = $numero;
    $pacienteData->mae = $mae;
    $pacienteData->sexo = $sexo;
    $pacienteData->id_paciente = $id_paciente;

    $pacienteDao->update($pacienteData);


    include_once('list_paciente.php');
}
