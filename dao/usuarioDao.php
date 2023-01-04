<?php

require_once("models/usuario.php");
require_once("models/message.php");

class UserDAO implements UserDAOInterface
{

    private $conn;
    private $url;
    private $message;

    public function __construct(PDO $conn, $url)
    {
        $this->conn = $conn;
        $this->url = $url;
        $this->message = new Message($url);
    }

    public function buildUser($data)
    {

        $user = new Usuario();

        $user->id_usuario = $data["id_usuario"];
        $user->usuario_user = $data["usuario_user"];
        $user->email_user = $data["email_user"];
        $user->email02_user = $data["email02_user"];
        $user->senha_user = password_hash($data["senha_user"], PASSWORD_BCRYPT);
        $user->endereco_user = $data["endereco_user"];
        $user->numero_user = $data["numero_user"];
        $user->bairro_user = $data["bairro_user"];
        $user->cidade_user = $data["cidade_user"];
        $user->telefone01_user = $data["telefone01_user"];
        $user->telefone02_user = $data["telefone02_user"];
        $user->data_create_user = $data["data_create_user"];
        $user->usuario_create_user = $data["usuario_create_user"];
        $user->vinculo_user = $data["vinculo_user"];
        $user->ativo_user = $data["ativo_user"];
        $user->data_adm_user = $data["data_adm_user"];
        $user->nivel_user = $data["nivel_user"];
        $user->cargo_user = $data["cargo_user"];
        $user->cpf_user = $data["cpf_user"];
        $user->reg_profissional_user = $data["reg_profissional_user"];
        return $user;
    }

    public function create(Usuario $usuario)
    {

        $stmt = $this->conn->prepare("INSERT INTO tb_user(
          usuario_user, email_user , email02_user, senha_user, endereco_user, numero_user, cidade_user, bairro_user, telefone01_user, telefone02_user, data_create_user, usuario_create_user, ativo_user, data_adm_user, vinculo_user, nivel_user, cargo_user, cpf_user, reg_profissional_user
        ) VALUES (
          :usuario_user, :email_user, :email02_user, :senha_user, :endereco_user, :numero_user, :cidade_user, :bairro_user, :telefone01_user, :telefone02_user, :data_create_user, :usuario_create_user, :ativo_user, :data_adm_user, :vinculo_user, :nivel_user, :cargo_user, :cpf_user, :reg_profissional_user
        )");

        $stmt->bindParam(":usuario_user", $usuario->usuario_user);
        $stmt->bindParam(":endereco_user", $usuario->endereco_user);
        $stmt->bindParam(":email_user", $usuario->email_user);
        $stmt->bindParam(":senha_user", $usuario->senha_user);
        $stmt->bindParam(":email02_user", $usuario->email02_user);
        $stmt->bindParam(":telefone01_user", $usuario->telefone01_user);
        $stmt->bindParam(":telefone02_user", $usuario->telefone02_user);
        $stmt->bindParam(":bairro_user", $usuario->bairro_user);
        $stmt->bindParam(":numero_user", $usuario->numero_user);
        $stmt->bindParam(":cidade_user", $usuario->cidade_user);
        $stmt->bindParam(":ativo_user", $usuario->ativo_user);
        $stmt->bindParam(":data_adm_user", $usuario->data_adm_user);
        $stmt->bindParam(":data_create_user", $usuario->data_create_user);
        $stmt->bindParam(":usuario_create_user", $usuario->usuario_create_user);
        $stmt->bindParam(":vinculo_user", $usuario->vinculo_user);
        $stmt->bindParam(":nivel_user", $usuario->nivel_user);
        $stmt->bindParam(":cargo_user", $usuario->cargo_user);
        $stmt->bindParam(":cpf_user", $usuario->cpf_user);
        $stmt->bindParam(":reg_profissional_user", $usuario->reg_profissional_user);

        $stmt->execute();

        // Autenticar usuário, caso auth seja true
        if (5 > 3) {
            $this->setTokenToSession($usuario->token);
        }
    }

    public function update(Usuario $usuario)
    {

        $stmt = $this->conn->prepare("UPDATE tb_user SET
        usuario_user = :usuario_user,
        endereco_user = :endereco_user,
        email_user = :email_user,
        email02_user = :email02_user,
        telefone01_user = :telefone01_user,
        telefone02_user = :telefone02_user,
        numero_user = :numero_user,
        bairro_user = :bairro_user,
        cidade_user = :cidade_user,
        usuario_create_user = :usuario_create_user,
        ativo_user = :ativo_user,
        data_adm_user = :data_adm_user,
        vinculo_user = :vinculo_user,
        nivel_user = :nivel_user,
        cargo_user = :cargo_user,
        cpf_user = :cpf_user,
        reg_profissional_user = :reg_profissional_user,
        senha_user = :senha_user

        WHERE id_usuario = :id_usuario
      ");

        $stmt->bindParam(":usuario_user", $usuario->usuario_user);
        $stmt->bindParam(":endereco_user", $usuario->endereco_user);
        $stmt->bindParam(":email_user", $usuario->email_user);
        $stmt->bindParam(":email02_user", $usuario->email02_user);
        $stmt->bindParam(":telefone01_user", $usuario->telefone01_user);
        $stmt->bindParam(":telefone02_user", $usuario->telefone02_user);
        $stmt->bindParam(":numero_user", $usuario->numero_user);
        $stmt->bindParam(":bairro_user", $usuario->bairro_user);
        $stmt->bindParam(":cidade_user", $usuario->cidade_user);
        $stmt->bindParam(":usuario_create_user", $usuario->usuario_create_user);
        $stmt->bindParam(":ativo_user", $usuario->ativo_user);
        $stmt->bindParam(":data_adm_user", $usuario->data_adm_user);
        $stmt->bindParam(":vinculo_user", $usuario->vinculo_user);
        $stmt->bindParam(":nivel_user", $usuario->nivel_user);
        $stmt->bindParam(":cargo_user", $usuario->cargo_user);
        $stmt->bindParam(":cpf_user", $usuario->cpf_user);
        $stmt->bindParam(":reg_profissional_user", $usuario->reg_profissional_user);
        $stmt->bindParam(":senha_user", $senhaHash);

        $stmt->bindParam(":id_usuario", $usuario->id_usuario);

        $stmt->execute();

        if (5 > 3) {

            // Redireciona para o perfil do usuario
            $this->message->setMessage("Dados atualizados com sucesso!", "success", "list_usuario.php");
        }
    }

    public function verifyToken($protected = false)
    {

        if (!empty($_SESSION["token"])) {

            // Pega o token da session
            $token = $_SESSION["token"];

            $usuario = $this->findByToken($token);

            if ($usuario) {
                return $usuario;
            } else if ($protected) {

                // Redireciona usuário não autenticado
                $this->message->setMessage("Faça a autenticação para acessar esta página!", "error", "index.php");
            }
        } else if ($protected) {

            // Redireciona usuário não autenticado
            $this->message->setMessage("Faça a autenticação para acessar esta página!", "error", "index.php");
        }
    }

    public function setTokenToSession($token, $redirect = true)
    {

        // Salvar token na session
        $_SESSION["token"] = $token;

        if ($redirect) {

            // Redireciona para o perfil do usuario
            $this->message->setMessage("Seja bem-vindo!", "success", "list_usuario.php");
        }
    }

    public function authenticateUser($email_user, $senha_user)
    {

        $user = $this->findByEmail($email_user);

        if ($user) {

            // Checar se as senha_users batem
            if (password_verify($senha_user, $user->senha_user)) {

                // Gerar um token e inserir na session
                $token = $user->generateToken();

                $this->setTokenToSession($token, false);

                // Atualizar token no usuário
                $user->token = $token;

                $this->update($user, false);

                return true;
            } else {
                return false;
            }
        } else {

            return false;
        }
    }

    public function findByEmail($email_user)
    {

        if ($email_user != "") {

            $stmt = $this->conn->prepare("SELECT * FROM tb_user WHERE email_user = :email_user");

            $stmt->bindParam(":email_user", $email_user);

            $stmt->execute();

            if ($stmt->rowCount() > 0) {

                $data = $stmt->fetch();
                $user = $this->buildUser($data);

                return $user;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function findById_user($id_usuario)
    {

        if ($id_usuario != "") {

            $stmt = $this->conn->prepare("SELECT * FROM tb_user WHERE id_usuario = :id_usuario");

            $stmt->bindParam(":id_usuario", $id_usuario);

            $stmt->execute();

            if ($stmt->rowCount() > 0) {

                $data = $stmt->fetch();
                $usuario = $this->buildUser($data);

                return $usuario;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function findByToken($token)
    {

        if ($token != "") {

            $stmt = $this->conn->prepare("SELECT * FROM tb_user WHERE token = :token");

            $stmt->bindParam(":token", $token);

            $stmt->execute();

            if ($stmt->rowCount() > 0) {

                $data = $stmt->fetch();
                $user = $this->buildUser($data);

                return $user;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function destroy($id_usuario)
    {

        // Remove o token da session
        $stmt = $this->conn->prepare("DELETE FROM tb_user WHERE id_usuario = :id_usuario");

        $stmt->bindParam(":id_usuario", $id_usuario);

        $stmt->execute();

        // Redirecionar e apresentar a mensagem de sucesso
        $this->message->setMessage("Deletado!", "success", "/list_usuario.php");
    }

    public function changePassword(Usuario $user)
    {

        $stmt = $this->conn->prepare("UPDATE tb_user SET
        senha_user = :senha_user
        WHERE id_usuario = :id_usuario
      ");

        $stmt->bindParam(":senha_user", $user->senha_user);
        $stmt->bindParam(":id_usuario", $user->id_usuario);

        $stmt->execute();

        // Redirecionar e apresentar a mensagem de sucesso
        $this->message->setMessage("senha alterada com sucesso!", "success", "editprofile.php");
    }

    public function findGeral()
    {

        $usuarios = [];

        $stmt = $this->conn->query("SELECT * FROM tb_user ORDER BY id_usuario asc");

        $stmt->execute();

        $pacientes = $stmt->fetchAll();

        return $usuarios;
    }
    public function findGeralUsuario()
    {

        $pacientes = [];

        $stmt = $this->conn->query("SELECT * FROM tb_user ORDER BY id_usuario asc");

        $stmt->execute();

        $usuarios = $stmt->fetchAll();

        return $usuarios;
    }
}
