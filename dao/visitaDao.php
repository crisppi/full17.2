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

    public function buildvisita($data)
    {
        $visita = new visita();

        $visita->fk_internacao_vis = $data["fk_internacao_vis"];
        $visita->rel_visita_vis = $data["rel_visita_vis"];
        $visita->acoes_int_vis = $data["acoes_int_vis"];
        $visita->usuario_create = $data["usuario_create"];
        $visita->data_visita_vis = $data["data_visita_vis"];
        $visita->visita_auditor_prof_med = $data["visita_auditor_prof_med"];
        $visita->visita_auditor_prof_enf = $data["visita_auditor_prof_enf"];
        $visita->visita_med_vis = $data["visita_med_vis"];
        $visita->visita_enf_vis = $data["usuario_create"];
        $visita->fk_usuario_vis = $data["fk_usuario_vis"];

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
        fk_internacao_vis, 
        rel_visita_vis, 
        acoes_int_vis, 
        usuario_create,
        visita_auditor_prof_med,
        visita_auditor_prof_enf,
        visita_med_vis,
        visita_enf_vis,
        fk_usuario_vis,
        data_visita_vis

      ) VALUES (
        :fk_internacao_vis, 
        :rel_visita_vis, 
        :acoes_int_vis, 
        :usuario_create,
        :visita_auditor_prof_med,
        :visita_auditor_prof_enf,
        :visita_med_vis,
        :visita_enf_vis,
        :fk_usuario_vis,
        :data_visita_vis

     )");

        $stmt->bindParam(":fk_internacao_vis", $visita->fk_internacao_vis);
        $stmt->bindParam(":rel_visita_vis", $visita->rel_visita_vis);
        $stmt->bindParam(":acoes_int_vis", $visita->acoes_int_vis);
        $stmt->bindParam(":usuario_create", $visita->usuario_create);
        $stmt->bindParam(":visita_auditor_prof_med", $visita->visita_auditor_prof_med);
        $stmt->bindParam(":visita_auditor_prof_enf", $visita->visita_auditor_prof_enf);
        $stmt->bindParam(":visita_med_vis", $visita->visita_med_vis);
        $stmt->bindParam(":visita_enf_vis", $visita->visita_enf_vis);
        $stmt->bindParam(":fk_usuario_vis", $visita->fk_usuario_vis);
        $stmt->bindParam(":data_visita_vis", $visita->data_visita_vis);

        $stmt->execute();

        // Mensagem de sucesso por adicionar visita
        $this->message->setMessage("visita adicionado com sucesso!", "success", "list_internacao.php");
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
