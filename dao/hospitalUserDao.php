<?php

require_once("./models/hospitalUser.php");
require_once("./models/message.php");

// Review DAO
require_once("dao/hospitalUserDao.php");

class hospitalUserDAO implements hospitalUserDAOInterface
{

    private $conn;
    private $url;
    public $message;

    public function __construct(PDO $conn, $url)
    {
        $this->conn = $conn;
        $this->url = $url;
        $this->message = new Message($url);
    }

    public function buildhospitalUser($data)
    {
        $hospitalUser = new hospitalUser();

        $hospitalUser->id_hospitalUser = $data["id_hospitalUser"];
        $hospitalUser->fk_usuario_hosp = $data["fk_usuario_hosp"];
        $hospitalUser->fk_hospital_user = $data["fk_hospital_user"];

        return $hospitalUser;
    }

    public function findAll()
    {
        $hospitalUser = [];

        $stmt = $this->conn->prepare("SELECT * FROM tb_hospitalUser
        ORDER BY id_hospitalUser asc");

        $stmt->execute();

        $hospitalUser = $stmt->fetchAll();
        return $hospitalUser;
    }


    public function findByHosp($pesquisa_nome)
    {

        $hospitalUser = [];

        $stmt = $this->conn->prepare("SELECT * FROM tb_hospitalUser
                                    WHERE nome_hosp LIKE :nome_hosp ");

        $stmt->bindValue(":nome_hosp", '%' . $pesquisa_nome . '%');

        $stmt->execute();

        $hospitalUser = $stmt->fetchAll();
        return $hospitalUser;
    }

    public function gethospitalUser()
    {

        $hospitalUser = [];

        $stmt = $this->conn->query("SELECT * FROM tb_hospitalUser ORDER BY id_hospitalUser asc");

        $stmt->execute();

        if ($stmt->rowCount() > 0) {

            $hospitalUserArray = $stmt->fetchAll();

            foreach ($hospitalUserArray as $hospitalUser) {
                $hospitalUser[] = $this->buildhospitalUser($hospitalUser);
            }
        }

        return $hospitalUser;
    }


    public function findById($id_hospitalUser)
    {
        $hospitalUser = [];
        $stmt = $this->conn->prepare("SELECT * FROM tb_hospitalUser
                                    WHERE id_hospitalUser = :id_hospitalUser");

        $stmt->bindParam(":id_hospitalUser", $id_hospitalUser);
        $stmt->execute();

        $data = $stmt->fetch();
        $hospitalUser = $this->buildhospitalUser($data);

        return $hospitalUser;
    }

    public function create(hospitalUser $hospitalUser)
    {

        $stmt = $this->conn->prepare("INSERT INTO tb_hospitalUser (
        fk_usuario_hosp, 
        fk_hospital_user 
        
      ) VALUES (
        :fk_usuario_hosp, 
        :fk_hospital_user
        
     )");

        $stmt->bindParam(":fk_usuario_hosp", $hospitalUser->fk_usuario_hosp);
        $stmt->bindParam(":fk_hospital_user", $hospitalUser->fk_hospital_user);


        $stmt->execute();

        // Mensagem de sucesso por adicionar filme
        $this->message->setMessage("hospitalUser adicionado com sucesso!", "success", "list_hospitalUser.php");
    }

    public function update(hospitalUser $hospitalUser)
    {

        $stmt = $this->conn->prepare("UPDATE tb_hospitalUser SET
        fk_usuario_hosp = :fk_usuario_hosp,
        fk_hospital_user = :fk_hospital_user

        WHERE id_hospitalUser = :id_hospitalUser 
      ");

        $stmt->bindParam(":fk_usuario_hosp", $hospitalUser->fk_usuario_hosp);
        $stmt->bindParam(":fk_hospital_user", $hospitalUser->fk_hospital_user);

        $stmt->bindParam(":id_hospitalUser", $hospitalUser->id_hospitalUser);
        $stmt->execute();

        // Mensagem de sucesso por editar hospitalUser
        $this->message->setMessage("hospitalUser atualizado com sucesso!", "success", "list_hospitalUser.php");
    }

    public function destroy($id_hospitalUser)
    {
        $stmt = $this->conn->prepare("DELETE FROM tb_hospitalUser WHERE id_hospitalUser = :id_hospitalUser");

        $stmt->bindParam(":id_hospitalUser", $id_hospitalUser);

        $stmt->execute();

        // Mensagem de sucesso por remover filme
        $this->message->setMessage("hospitalUser removido com sucesso!", "success", "list_hospitalUser.php");
    }


    public function findGeral()
    {

        $hospitalUser = [];

        $stmt = $this->conn->query("SELECT * FROM tb_hospitalUser ORDER BY id_hospitalUser asc");

        $stmt->execute();

        $hospitalUser = $stmt->fetchAll();

        return $hospitalUser;
    }

    public function selectAllhospitalUser($where = null, $order = null, $limit = null)
    {
        //DADOS DA QUERY
        $where = strlen($where) ? 'WHERE ' . $where : '';
        $order = strlen($order) ? 'ORDER BY ' . $order : '';
        $limit = strlen($limit) ? 'LIMIT ' . $limit : '';

        //MONTA A QUERY
        $query = $this->conn->query('SELECT * FROM tb_hospitalUser ' . $where . ' ' . $order . ' ' . $limit);

        $query->execute();

        $hospitalUser = $query->fetchAll();

        return $hospitalUser;
    }

    public function QtdhospitalUser($where = null, $order = null, $limite = null)
    {
        $hospitalUser = [];
        //DADOS DA QUERY
        $where = strlen($where) ? 'WHERE ' . $where : '';
        $order = strlen($order) ? 'ORDER BY ' . $order : '';
        $limite = strlen($limite) ? 'LIMIT ' . $limite : '';

        $stmt = $this->conn->query('SELECT * ,COUNT(id_hospitalUser) as qtd FROM tb_hospitalUser ' . $where . ' ' . $order . ' ' . $limite);

        $stmt->execute();

        $QtdTotalHosp = $stmt->fetch();

        return $QtdTotalHosp;
    }

    public function joinHospitalUser($id_usuario)

    {
        $stmt = $this->conn->query("SELECT 
        
        hu.id_hospitalUser,
        hu.fk_usuario_hosp,
        hu.fk_hospital_user,
        ho.id_hospital,
        us.id_usuario,
        us.usuario_user,
        ho.nome_hosp 
        
        FROM tb_hospitalUser hu 

        left JOIN tb_hospital as ho On  
        hu.fk_hospital_user = ho.id_hospital
        
		left JOIN tb_user as us On  
        hu.fk_usuario_hosp = us.id_usuario
         
        where us.id_usuario = $id_usuario
         ");

        $stmt = $this->conn->query(
            'SELECT 
        hu.id_hospitalUser,
        hu.fk_usuario_hosp,
        hu.fk_hospital_user,
        ho.id_hospital, 
        ho.nome_hosp,
        us.id_usuario,
        us.usuario_user

        FROM tb_user us 

        iNNER JOIN tb_hospital as ho On  
        hu.fk_hospital_user = ho.id_hospital

        iNNER JOIN tb_hospitalUser as hu On  
        hu.fk_hospital_user = ho.id_hospital'


        );

        $stmt->execute();

        $hospitalUser = $stmt->fetch();
        return $hospitalUser;
    }
}
