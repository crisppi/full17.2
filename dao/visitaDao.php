<?php

require_once("./models/visita.php");
require_once("./models/message.php");

// Review DAO
require_once("dao/visitaDao.php");

class visitaDAO implements visitaDAOInterface
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

    public function buildvisita($visita)
    {
        $acomod = new visita();

        $acomod->id_visita = $visita["id_visita"];
        $acomod->visitaNome = $visita["visitaNome"];
        $acomod->fk_hospital = $visita["fk_hospital"];
        $acomod->valor_diaria = $visita["valor_diaria"];
        $acomod->data_create = $visita["data_create"];
        //$visita->usuario_create = $visita["usuario_create"];

        return $visita;
    }

    public function joinvisitaHospital()
    {

        $visita = [];

        $stmt = $this->conn->query("SELECT ac.id_visita, ac.valor_diaria, ac.visitaNome, ho.id_hospital, ho.hospitalNome
         FROM tb_visita ac 
         iNNER JOIN tb_hospital as ho On  
         ac.fk_hospital = ho.id_hospital
         ORDER BY ac.id_visita asc");
        $stmt->execute();
        $visita = $stmt->fetchAll();
        return $visita;
    }

    // mostrar acomocacao por id_visita
    public function joinvisitaHospitalshow($id_visita)

    {
        $stmt = $this->conn->query("SELECT ac.id_visita, ac.fk_hospital, ac.valor_diaria, ac.visitaNome, ho.id_hospital, ho.hospitalNome
         FROM tb_visita ac          
         iNNER JOIN tb_hospital as ho On  
         ac.fk_hospital = ho.id_hospital
         where id_visita = $id_visita   
         ");

        $stmt->execute();

        $visita = $stmt->fetch();
        return $visita;
    }
    public function findAll()
    {
    }

    public function getvisita()
    {

        $visita = [];

        $stmt = $this->conn->query("SELECT * FROM tb_visita ORDER BY id_visita asc");

        $stmt->execute();

        if ($stmt->rowCount() > 0) {

            $visitaArray = $stmt->fetchAll();

            foreach ($visitaArray as $visita) {
                $visita[] = $this->buildvisita($visita);
            }
        }

        return $visita;
    }

    public function getvisitaByNome($nome)
    {

        $visita = [];

        $stmt = $this->conn->prepare("SELECT * FROM tb_visita
                                    WHERE visitaNome = :visitaNome
                                    ORDER BY id_visita asc");

        $stmt->bindParam(":visitaNome", $visitaNome);

        $stmt->execute();

        return $visita;
    }

    public function findById($id_visita)
    {
        $visita = [];
        $stmt = $this->conn->prepare("SELECT * FROM tb_visita
                                    WHERE id_visita = $id_visita");

        $stmt->bindParam(":id_visita", $id_visita);
        $stmt->execute();

        $data = $stmt->fetch();
        //var_dump($data);
        $visita = $this->buildvisita($data);

        return $visita;
    }

    public function findByIdUpdate($id_visita)
    {

        $visita = [];

        $stmt = $this->conn->prepare("SELECT * FROM tb_visita
                                    WHERE id_visita = :id_visita");

        $stmt->bindValue(":id_visita", $id_visita);

        $stmt->execute();

        if ($stmt->rowCount() > 0) {

            $visitaArray = $stmt->fetchAll();

            foreach ($visitaArray as $visita) {
                $visita[] = $this->buildvisita($visita);
            }
        }

        return $visita;
    }

    public function create(visita $visita)
    {

        $stmt = $this->conn->prepare("INSERT INTO tb_visita (
        visitaNome, fk_hospital, valor_diaria, data_create, usuario_create
      ) VALUES (
        :visitaNome, :fk_hospital, :valor_diaria, :data_create, :usuario_create
     )");

        $stmt->bindParam(":visitaNome", $visita->visitaNome);
        $stmt->bindParam(":fk_hospital", $visita->fk_hospital);
        $stmt->bindParam(":valor_diaria", $visita->valor_diaria);
        $stmt->bindParam(":data_create", $visita->data_create);
        $stmt->bindParam(":usuario_create", $visita->usuario_create);

        $stmt->execute();

        // Mensagem de sucesso por adicionar visita
        $this->message->setMessage("visita adicionado com sucesso!", "success", "list_visita.php");
    }

    public function update($visita)
    {

        $stmt = $this->conn->prepare("UPDATE tb_visita SET
        visitaNome = :visitaNome,
        valor_diaria = :valor_diaria,
        fk_hospital = :fk_hospital
        WHERE id_visita = :id_visita 
      ");

        $stmt->bindParam(":visitaNome", $visita['visitaNome']);
        $stmt->bindParam(":valor_diaria", $visita['valor_diaria']);
        $stmt->bindParam(":fk_hospital", $visita['fk_hospital']);
        $stmt->bindParam(":id_visita", $visita['id_visita']);

        // $stmt->bindParam(":data_create", $visita['data_create']);
        // $stmt->bindParam(":usuario_create", $visita['usuario_create']);
        $stmt->execute();

        // Mensagem de sucesso por editar visita
        $this->message->setMessage("visita atualizado com sucesso!", "success", "list_visita.php");
    }

    public function destroy($id_visita)
    {
        $stmt = $this->conn->prepare("DELETE FROM tb_visita WHERE id_visita = :id_visita");

        $stmt->bindParam(":id_visita", $id_visita);

        $stmt->execute();

        // Mensagem de sucesso por remover filme
        $this->message->setMessage("visita removido com sucesso!", "success", "list_visita.php");
    }


    public function findGeral()
    {

        $visita = [];

        $stmt = $this->conn->query("SELECT * FROM tb_visita ORDER BY id_visita asc");

        $stmt->execute();

        $visita = $stmt->fetchAll();

        return $visita;
    }
}
