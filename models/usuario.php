<?php
class Usuario
{

    public $id_usuario;
    public $usuario_user;
    public $username;
    public $endereco_user;
    public $bairro_user;
    public $cidade_user;
    public $numero_user;
    public $email02_user;
    public $email_user;
    public $telefone01_user;
    public $telefone02_user;
    public $usuario_create_user;
    public $data_create_user;
    public $ativo_user;
    public $vinculo_user;
    public $data_adm_user;
    public $cargo_user;
    public $nivel_user;
    public $reg_profissional_user;
    public $cpf_user;
    public $senha_user;
    public $token;
    public $fk_usuario_user;


    public function getFullName($user)
    {
        return $user->name . " " . $user->lastname;
    }

    public function generateToken()
    {
        return bin2hex(random_bytes(50));
    }

    public function generatePassword($senha_user)
    {
        return password_hash($senha_user, PASSWORD_DEFAULT);
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
    public function findByEmail($email_user);
    public function findByLogin(Usuario $user);
    public function findById_user($id_usuario);
    public function findByUser($pesquisa_nome);
    public function findByToken($token);
    public function destroy($id_usuario);
    public function changePassword(Usuario $user);
    public function findGeral();
    public function findAll();

    public function selectAllUsuario($where = null, $order = null, $limit = null);
    public function QtdUsuario();
}
