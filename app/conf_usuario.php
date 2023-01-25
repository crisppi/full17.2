<?php
require_once("./models/usuario.php");
require_once("./dao/usuarioDao.php");
$user = new Usuario();
$usuarioDao = new UserDAO($conn, $BASE_URL);
$user = new UserDAO($conn, $BASE_URL);

$usuario = 'crisppi@gmail.com';
$senha_login = '1234';

// $usuario = $usuarioDao->findGeralUsuario();
$user = $usuarioDao->findByLogin($usuario);

print_r($usuarioDao);


if (isset($_POST["senha_login"])) {

    if (empty($_POST['username']) || empty($_POST['senha_login'])) {
        $message = '<label>Todos campos são obrigatórios</label>';
    } else {

        $usuarioDao = $usuarioList->findByLogin($user);

        echo "<pre>";
        print_r($usuarioDao);
        // $count = $usuarioDao->rowCount();
        // if ($count > 0) {
        //     $_SESSION["username"] = $_POST["username"];
        //     // header("Location: ./menu.php");
        // } else {
        //     $message = '<label>Usuário ou senha incorretas</label>';
        // }
    }
}
