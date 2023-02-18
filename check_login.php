<?php

session_start();
// if (!$_SESSION['username']) {
//     header("Location: index.php");
// }; 
include_once("globals.php");
include_once("db.php");
require_once("models/usuario.php");
require_once("dao/usuarioDao.php");

// isset($_SESSION['mensagem']) ? "" : null;
// echo "<pre>";
// print_r($_SESSION);
?>

<?php

//include_once("./models/message.php");
//Instanciando a classe
//Instanciando a classe
$usuario = new UserDAO($conn, $BASE_URL);
$QtdTotalUser = new UserDAO($conn, $BASE_URL);

// METODO DE BUSCA DE PAGINACAO
$username = filter_input(INPUT_POST, 'username');
$senha_login = filter_input(INPUT_POST, 'senha_login');
$login = filter_input(INPUT_POST, 'login');

$condicoes = [
    strlen($username) ? 'usuario_user LIKE "%' . $username . '%"' : null,

];
// print_r($condicoes);
$condicoes = array_filter($condicoes);

// REMOVE POSICOES VAZIAS DO FILTRO
$where = implode(' AND ', $condicoes);
// print_r($where);

// QUANTIDADE UsuarioS
$order = null;
$obLimite = null;
$query = $usuario->selectAllUsuario($where, $order, $obLimite);
$query2 = $usuario->findByEmail($username);

print_r($query2);
// print_r($query);
if (!empty($query)) {
    $nivel = $query[0]['nivel_user'];
    $senha_hash = $query[0]['senha_user'];

    if (password_verify($senha_login, $senha_hash)) {
        $_SESSION['nivel'] = $nivel;
        $_SESSION['username'] = $username;
        header('location: menu.php');
    } else {
        $erro_login = "Usuário ou senha inválidos";
        $_SESSION['mensagem'] = $erro_login;
        header('location: index.php');
    };
}

?>