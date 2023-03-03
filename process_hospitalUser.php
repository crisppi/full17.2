<?php
require_once("globals.php");
require_once("db.php");
require_once("models/message.php");
require_once("dao/usuarioDao.php");

require_once("models/hospitalUser.php");
require_once("dao/hospitalUserDao.php");

$message = new Message($BASE_URL);
$userDao = new UserDAO($conn, $BASE_URL);
$hospitalUserDao = new hospitalUserDAO($conn, $BASE_URL);

// Resgata o tipo do formulário
$type = filter_input(INPUT_POST, "type");

// Resgata dados do usuário

if ($type === "create") {

    // Receber os dados dos inputs
    $fk_usuario_hosp = filter_input(INPUT_POST, "fk_usuario_hosp");
    $fk_hospital_user = filter_input(INPUT_POST, "fk_hospital_user");
    $hospitalUser = new hospitalUser();

    // Validação mínima de dados
    if (!empty($fk_usuario_hosp)) {

        $hospitalUser->fk_usuario_hosp = $fk_usuario_hosp;
        $hospitalUser->fk_hospital_user = $fk_hospital_user;


        $hospitalUserDao->create($hospitalUser);
    } else {

        $message->setMessage("Você precisa adicionar pelo menos: hospitalUserNome do hospitalUser!", "error", "back");
    }
} else if ($type === "update") {

    $hospitalUserDao = new hospitalUserDAO($conn, $BASE_URL);

    // // Receber os dados dos inputs
    $id_hospitalUser = filter_input(INPUT_POST, "id_hospitalUser");
    $fk_usuario_hosp = filter_input(INPUT_POST, "fk_usuario_hosp");
    $fk_hospital_user = filter_input(INPUT_POST, "fk_hospital_user");

    $hospitalUserData = $hospitalUserDao->findById($id_hospitalUser);

    $hospitalUserData->id_hospitalUser = $id_hospitalUser;
    $hospitalUserData->fk_usuario_hosp = $fk_usuario_hosp;
    $hospitalUserData->fk_hospital_user = $fk_hospital_user;


    $hospitalUserDao->update($hospitalUserData);

    include_once('list_hospitalUser.php');
}
