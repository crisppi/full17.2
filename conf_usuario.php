<?php
// session_start();

require_once("dao/usuarioDao.php");
require_once("models/message.php");
require_once("models/usuario.php");

$usuarioDao = new userDAO($conn, $BASE_URL);

if (isset($_POST["login"])) {

    if (empty($_POST['username']) || empty($_POST['senha_login'])) {
        $message = '<label>Todos campos são obrigatórios</label>';
    } else {

        $query = "SELECT * FROM tb_user WHERE usuario_user = :username AND senha_user = :senha_login";

        $usuarioDao = $conn->prepare($query);
        $usuarioDao->execute(
            array(
                'username'     =>     $_POST["username"],
                'senha_login'     =>     $_POST["senha_login"]
            )
        );

        $count = $usuarioDao->rowCount();
        if ($count > 0) {
            $_SESSION["username"] = $_POST["username"];
            header("Location: menu.php");
        } else {
            $message = '<label>Usuário ou senha incorretas</label>';
        }
    }
}