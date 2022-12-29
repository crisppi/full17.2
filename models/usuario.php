<?php
class Usuario
{

    public $id_usuario;
    public $usuarionome;
    public $endereco;
    public $bairro;
    public $cidade;
    public $numero;
    public $email02;
    public $email01;
    public $telefone01;
    public $telefone02;
    public $usuario_create;
    public $ativo;
    public $vinculo;
    public $data_adm;
    public $cargo;
    public $nivel;
    public $reg_profissional;
    public $cpf;
    public $senha;

    public function getFullName($user)
    {
        return $user->name . " " . $user->lastname;
    }

    public function generateToken()
    {
        return bin2hex(random_bytes(50));
    }

    public function generatePassword($senha)
    {
        return password_hash($senha, PASSWORD_DEFAULT);
    }

    public function imageGenerateName()
    {
        return bin2hex(random_bytes(60)) . ".jpg";
    }
}

interface UserDAOInterface
{

    public function buildUser($data);
    public function create(Usuario $usuario);
    public function update(Usuario $usuario);
    public function verifyToken($protected = false);
    public function setTokenToSession($token, $redirect = true);
    public function authenticateUser($email, $senha);
    public function findByEmail($email);
    public function findById_user($id_usuario);
    public function findByToken($token);
    public function destroy($id_usuario);
    public function changePassword(Usuario $user);
    public function findGeral();
}

// faltam dados para corrigir
