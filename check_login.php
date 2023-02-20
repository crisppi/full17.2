<?php

session_start();
// if (!$_SESSION['username']) {
//     header("Location: index.php");
// }; 
include_once("globals.php");
include_once("db.php");
require_once("models/usuario.php");
require_once("dao/usuarioDao.php");

?>

<?php

//Instanciando a classe
$usuario = new UserDAO($conn, $BASE_URL);
$QtdTotalUser = new UserDAO($conn, $BASE_URL);

// METODO DE BUSCA DE LOGIN
$email_login = filter_input(INPUT_POST, 'email_login');
$senha_login = filter_input(INPUT_POST, 'senha_login');
$login = filter_input(INPUT_POST, 'login');
$condicoes = [
    strlen($email_login) ? 'email_user LIKE "%' . $email_login . '%"' : null,
];

$condicoes = array_filter($condicoes);

// REMOVE POSICOES VAZIAS DO FILTRO
$where = implode(' AND ', $condicoes);

// QUANTIDADE USUARIOS
$order = null;
$obLimite = null;
$query = $usuario->selectAllUsuario($where, $order, $obLimite);

if (!empty($query)) {

    $nivel = $query[0]['nivel_user'];
    $login_user = $query[0]['login_user'];
    $email_user = $query[0]['email_user'];
    $ativo = $query[0]['ativo_user'];
    $cargo = $query[0]['cargo_user'];
    $id_user = $query[0]['id_usuario'];
    $senha_hash = $query[0]['senha_user'];

    if (password_verify($senha_login, $senha_hash)) {

        $_SESSION['nivel'] = $nivel;
        $_SESSION['login_user'] = $login_user;
        $_SESSION['email_user'] = $email_user;
        $_SESSION['ativo'] = $ativo;
        $_SESSION['id_usuario'] = $id_user;
        $_SESSION['cargo'] = $cargo;
        header('location: menu.php');
    } else {

        $erro_login = "Usuário ou senha inválidos";
        $_SESSION['mensagem'] = $erro_login;
        header('location: index.php');
    }
} else {
    $erro_login = "Usuário ou senha inválidos";
    $_SESSION['mensagem'] = $erro_login;
    header('location: index.php');
}

?>