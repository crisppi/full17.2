<?php


class Login
{

    // metodo responsavel por saber se o usuario esta logado.
    public static function islogged()
    {
        return false;
    }

    // metodo responsavel por obrigar usuario estar logado
    public static function requireLogin()
    {
        if (!self::isLogged()) {
            header('location: index.php');
            exit;
        };
    }
    // metodo responsavel por obrigar usuario estar deslogado
    public static function requireLogout()
    {
        if (self::isLogged()) {
            header('location: menu.php');
            exit;
        };
    }
};
