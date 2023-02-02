<?php
session_start();

require_once("templates/headerbase.php");
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
                'username'     =>   $_POST["username"],
                'senha_login'  =>   $_POST["senha_login"]
            )

        );

        $count = $usuarioDao->rowCount();

        if ($count > 0) {
            echo "<pre>";
            echo "session" . "<>";
            print_r($_SESSION);
            echo "post" . "<>";
            print_r($_POST);

            $_SESSION["username"] = $_POST["username"];
            $_SESSION["senha_login"] = $_POST["senha_login"];
            $user = $_POST["username"];
            $senha = $_POST['senha_login'];
            $post = $_POST;
            echo "<pre>";
            echo "session" . "<>";
            print_r($_SESSION);
            echo "post" . "<>";
            print_r($post);
            header("Location: menu.php");
        } else {
            $message = '<label>Usuário ou senha incorretas</label>';
        }
    }
}

?>
<!DOCTYPE html>
<html>

<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
</head>

<body>
    <br />
    <div class="container" style="width:500px;">
        <?php
        if (isset($message)) {
            echo '<label class="text-danger">' . $message . '</label>';
        }
        ?>
    </div>

    <div class="login-wrap">
        <div class="login-html">
            <div style="color:white; text-align:center; font-size:1.6em">
                PAINEL - GESTÃO AUDITORIA
            </div>
            <hr>
            <div>
                <a class="navbar-brand" href="index.php">
                    <img src="img/full-03.jpeg" style="width:70px; height:70px " alt="Full">
                </a> <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
            </div>
            <input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">Logar</label>
            <input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab"></label>

            <div class="login-form">
                <form method="POST">
                    <div class="sign-in-htm">
                        <div class="group">
                            <label for="username" class="label">Usuário</label>
                            <input name="username" type="text" class="input">
                        </div>
                        <div class="group">
                            <label for="senha_login" class="label">Senha</label>
                            <input name="senha_login" type="password" class="input" type="senha_login">
                        </div>
                        <div class="group">
                            <input type="submit" class="button" name="login" class="btn btn-info" value="Login">
                        </div>
                </form>
            </div>

        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

</html>