<?php

require_once("./models/patologia.php");
require_once("./models/message.php");

// Review DAO
require_once("dao/patologiaDao.php");

class patologiaDAO implements patologiaDAOInterface
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

    public function buildpatologia($data)
    {
        $patologia = new patologia();

        $patologia->id_patologia = $data["id_patologia"];
        $patologia->patologia_pat = $data["patologia_pat"];
        $patologia->dias_pato = $data["dias_pato"];

        return $patologia;
    }

    public function findAll()
    {
    }

    public function getpatologia()
    {

        $patologia = [];

        $stmt = $this->conn->query("SELECT * FROM tb_patologia ORDER BY id_patologia asc");

        $stmt->execute();

        if ($stmt->rowCount() > 0) {

            $patologiaArray = $stmt->fetchAll();

            foreach ($patologiaArray as $patologia) {
                $patologia[] = $this->buildpatologia($patologia);
            }
        }

        return $patologia;
    }

    public function getpatologiaByNome($nome)
    {

        $patologia = [];

        $stmt = $this->conn->prepare("SELECT * FROM tb_patologia
                                    WHERE patologia_pat = :patologia_pat
                                    ORDER BY id_patologia asc");

        $stmt->bindParam(":patologia_pat", $patologia_pat);

        $stmt->execute();

        if ($stmt->rowCount() > 0) {

            $patologiaArray = $stmt->fetchAll();

            foreach ($patologiaArray as $patologia) {
                $patologia[] = $this->buildpatologia($patologia);
            }
        }

        return $patologia;
    }

    public function findById($id_patologia)
    {
        $patologia = [];
        $stmt = $this->conn->prepare("SELECT * FROM tb_patologia
                                    WHERE id_patologia = :id_patologia");

        $stmt->bindParam(":id_patologia", $id_patologia);
        $stmt->execute();

        $data = $stmt->fetch();
        //var_dump($data);
        $patologia = $this->buildpatologia($data);

        return $patologia;
    }

    public function findByTitle($title)
    {

        $patologia = [];

        $stmt = $this->conn->prepare("SELECT * FROM tb_patologia
                                    WHERE patologia_pat LIKE :patologia_pat");

        $stmt->bindValue(":title", '%' . $title . '%');

        $stmt->execute();

        if ($stmt->rowCount() > 0) {

            $patologiaArray = $stmt->fetchAll();

            foreach ($patologiaArray as $patologia) {
                $patologia[] = $this->buildpatologia($patologia);
            }
        }

        return $patologia;
    }

    public function create(patologia $patologia)
    {

        $stmt = $this->conn->prepare("INSERT INTO tb_patologia (
        patologia_pat,
        dias_pato
      ) VALUES (
        :patologia_pat,
        :dias_pato
     )");

        $stmt->bindParam(":patologia_pat", $patologia->patologia_pat);
        $stmt->bindParam(":dias_pato", $patologia->dias_pato);

        $stmt->execute();

        // Mensagem de sucesso por adicionar filme
        $this->message->setMessage("patologia adicionado com sucesso!", "success", "list_patologia.php");
    }

    public function update(patologia $patologia)
    {

        $stmt = $this->conn->prepare("UPDATE tb_patologia SET
        patologia_pat = :patologia_pat,
        dias_pato = :dias_pato
        
        WHERE id_patologia = :id_patologia 
      ");

        $stmt->bindParam(":patologia_pat", $patologia->patologia_pat);
        $stmt->bindParam(":dias_pato", $patologia->dias_pato);

        $stmt->bindParam(":id_patologia", $patologia->id_patologia);
        $stmt->execute();

        // Mensagem de sucesso por editar patologia
        $this->message->setMessage("patologia atualizado com sucesso!", "success", "list_patologia.php");
    }

    public function destroy($id_patologia)
    {
        $stmt = $this->conn->prepare("DELETE FROM tb_patologia WHERE id_patologia = :id_patologia");

        $stmt->bindParam(":id_patologia", $id_patologia);

        $stmt->execute();

        // Mensagem de sucesso por remover filme
        $this->message->setMessage("Patologia removido com sucesso!", "success", "list_patologia.php");
    }


    public function findGeral()
    {

        $patologia = [];

        $stmt = $this->conn->query("SELECT * FROM tb_patologia ORDER BY id_patologia asc");

        $stmt->execute();

        $patologia = $stmt->fetchAll();

        return $patologia;
    }
}
