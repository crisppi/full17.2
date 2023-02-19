<?php

session_start();

if (!isset($_SESSION['login_user'])) {
    header('location:index.php');
}

if (!$_SESSION['ativo'] == 's') {
    $erro_login = "Usuário inativo";
    $_SESSION['mensagem'] = $erro_login;
    header('location:index.php');
} else {
    $_SESSION['mensagem'] = "";
}

require_once("templates/header.php");
