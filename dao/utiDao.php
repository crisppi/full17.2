<?php

require_once("./models/uti.php");
require_once("./models/hospital.php");
require_once("./models/internacao.php");
require_once("./models/message.php");

// Review DAO
require_once("dao/utiDao.php");

class utiDAO implements utiDAOInterface
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

    public function buildUti($data)
    {
        $uti = new uti();

        $uti->id_uti = $data["id_uti"];
        $uti->fk_internacao_uti = $data["fk_internacao_uti"];
        $uti->criterios_uti = $data["criterios_uti"];
        $uti->data_alta_uti = $data["data_alta_uti"];
        $uti->dva_uti = $data["dva_uti"];
        $uti->data_internacao_uti = $data["data_internacao_uti"];
        $uti->especialidade_uti = $data["especialidade_uti"];
        $uti->internacao_uti = $data["internacao_uti"];
        $uti->internado_uti = $data["internado_uti"];
        $uti->just_uti = $data["just_uti"];
        $uti->motivo_uti = $data["motivo_uti"];
        $uti->rel_uti = $data["rel_uti"];
        $uti->saps_uti = $data["saps_uti"];
        $uti->score_uti = $data["score_uti"];
        $uti->vm_uti = $data["vm_uti"];
        $uti->fk_user_uti = $data["fk_user_uti"];


        return $uti;
    }
    public function joinUtiHospital()
    {

        $uti = [];

        $stmt = $this->conn->query("SELECT ac.id_uti, ac.valor_aco, ac.uti_aco, ho.id_hospital, ho.nome_hosp
         FROM tb_uti ac 
         iNNER JOIN tb_hospital as ho On  
         ac.fk_hospital = ho.id_hospital
         ORDER BY ac.id_uti asc");
        $stmt->execute();
        $uti = $stmt->fetchAll();
        return $uti;
    }

    // mostrar acomocacao por id_uti
    public function joinutiHospitalshow($id_uti)

    {
        $stmt = $this->conn->query("SELECT ac.id_uti, 
        ac.fk_hospital, 
        ac.valor_aco, 
        ac.uti_aco, 
        ho.id_hospital, 
        ho.nome_hosp
         FROM tb_uti ac          
         iNNER JOIN tb_hospital as ho On  
         ac.fk_hospital = ho.id_hospital
         where id_uti = $id_uti   
         ");

        $stmt->execute();

        $uti = $stmt->fetch();
        return $uti;
    }
    public function findAll()
    {
    }

    public function getuti()
    {

        $uti = [];

        $stmt = $this->conn->query("SELECT * FROM tb_uti ORDER BY id_uti asc");

        $stmt->execute();

        if ($stmt->rowCount() > 0) {

            $utiArray = $stmt->fetchAll();

            foreach ($utiArray as $uti) {
                $uti[] = $this->builduti($uti);
            }
        }

        return $uti;
    }


    public function findById($id_uti)
    {
        $uti = [];
        $stmt = $this->conn->prepare("SELECT * FROM tb_uti
                                    WHERE id_uti = :id_uti");

        $stmt->bindParam(":id_uti", $id_uti);
        $stmt->execute();

        $data = $stmt->fetch();
        $uti = $this->builduti($data);

        return $uti;
    }

    public function findByTitle($pesquisa_hosp)
    {

        $uti = [];

        $stmt = $this->conn->prepare("SELECT * FROM tb_uti
                                    WHERE nome_hosp LIKE :pesquisa_hosp");

        $stmt->bindValue(":nome_hosp", '%' . $pesquisa_hosp . '%');

        $stmt->execute();

        if ($stmt->rowCount() > 0) {

            $utiArray = $stmt->fetchAll();

            foreach ($utiArray as $uti) {
                $uti[] = $this->builduti($uti);
            }
        }

        return $uti;
        $query = $uti;
    }

    public function create(uti $uti)
    {

        $stmt = $this->conn->prepare("INSERT INTO tb_uti (
        fk_internacao_uti, 
        criterios_uti, 
        data_alta_uti, 
        dva_uti, 
        data_internacao_uti, 
        especialidade_uti, 
        internacao_uti, 
        internado_uti, 
        just_uti,
        motivo_uti,
        rel_uti,
        saps_uti,
        score_uti,
        vm_uti
      ) VALUES (
        :fk_internacao_uti, 
        :criterios_uti, 
        :data_alta_uti, 
        :dva_uti, 
        :data_internacao_uti,
        :especialidade_uti, 
        :internacao_uti,
        :internado_uti,
        :just_uti,
        :motivo_uti,
        :rel_uti,
        :saps_uti,
        :score_uti,
        :vm_uti

     )");

        $stmt->bindParam(":fk_internacao_uti", $uti->fk_internacao_uti);
        $stmt->bindParam(":criterios_uti", $uti->criterios_uti);
        $stmt->bindParam(":data_alta_uti", $uti->data_alta_uti);
        $stmt->bindParam(":dva_uti", $uti->dva_uti);
        $stmt->bindParam(":data_internacao_uti", $uti->data_internacao_uti);
        $stmt->bindParam(":especialidade_uti", $uti->especialidade_uti);
        $stmt->bindParam(":internacao_uti", $uti->internacao_uti);
        $stmt->bindParam(":internado_uti", $uti->internado_uti);
        $stmt->bindParam(":just_uti", $uti->just_uti);
        $stmt->bindParam(":motivo_uti", $uti->motivo_uti);
        $stmt->bindParam(":rel_uti", $uti->rel_uti);
        $stmt->bindParam(":saps_uti", $uti->saps_uti);
        $stmt->bindParam(":score_uti", $uti->score_uti);
        $stmt->bindParam(":vm_uti", $uti->vm_uti);

        $stmt->execute();

        // Mensagem de sucesso por adicionar filme
        $this->message->setMessage("uti adicionado com sucesso!", "success", "cad_internacao.php");
    }

    public function update($uti) //ainda nao corrigido
    {

        $stmt = $this->conn->prepare("UPDATE tb_uti SET
        fk_internacao_uti = :fk_internacao_uti,
        criterios_uti = :criterios_uti,
        rel_criterios_uti = :rel_criterios_uti,
        evento_adverso_uti = :evento_adverso_uti,
        rel_evento_adverso_uti = :rel_evento_adverso_uti,
        tipo_evento_adverso_utit = :tipo_evento_adverso_utit,
        opme_uti = :opme_uti,
        rel_opme_uti = :rel_opme_uti,
        home_care_uti = :home_care_uti,
        rel_home_care_uti, = :rel_home_care_uti,
        desospitalizacao_uti, = :desospitalizacao_uti,
        rel_desospitalizacao_uti, = :rel_desospitalizacao_uti

        WHERE id_uti = :id_uti 
      ");

        $stmt->bindParam(":fk_internacao_uti", $uti->fk_internacao_uti);
        $stmt->bindParam(":criterios_uti", $uti->criterios_uti);
        $stmt->bindParam(":rel_criterios_uti", $uti->rel_criterios_uti);
        $stmt->bindParam(":evento_adverso_uti", $uti->evento_adverso_uti);
        $stmt->bindParam(":rel_evento_adverso_uti", $uti->rel_evento_adverso_uti);
        $stmt->bindParam(":tipo_evento_adverso_utit", $uti->tipo_evento_adverso_utit);
        $stmt->bindParam(":opme_uti", $uti->opme_uti);
        $stmt->bindParam(":rel_opme_uti", $uti->rel_opme_uti);
        $stmt->bindParam(":home_care_uti", $uti->home_care_uti);
        $stmt->bindParam(":rel_home_care_uti", $uti->rel_home_care_uti);
        $stmt->bindParam(":rel_home_care_uti", $uti->rel_home_care_uti);
        $stmt->bindParam(":rel_desospitalizacao_uti", $uti->rel_desospitalizacao_uti);

        $stmt->bindParam(":id_uti", $uti->id_uti);
        $stmt->execute();

        // Mensagem de sucesso por editar uti
        $this->message->setMessage("uti atualizado com sucesso!", "success", "list_uti.php");
    }
    public function findByIdUpdate($uti) //ainda nao corrigido
    {

        $stmt = $this->conn->prepare("UPDATE tb_uti SET
        fk_internacao_uti = :fk_internacao_uti,
        criterios_uti = :alto_custo_uti,
        rel_alto_custo_uti = :rel_alto_custo_uti,
        evento_adverso_uti = :evento_adverso_uti,
        rel_evento_adverso_uti = :rel_evento_adverso_uti,
        tipo_evento_adverso_utit = :tipo_evento_adverso_utit,
        opme_uti = :opme_uti,
        rel_opme_uti = :rel_opme_uti,
        home_care_uti = :home_care_uti,
        rel_home_care_uti, = :rel_home_care_uti,
        desospitalizacao_uti, = :desospitalizacao_uti,
        rel_desospitalizacao_uti, = :rel_desospitalizacao_uti

        WHERE id_uti = :id_uti 
      ");

        $stmt->bindParam(":fk_internacao_uti", $uti->fk_internacao_uti);
        $stmt->bindParam(":alto_custo_uti", $uti->alto_custo_uti);
        $stmt->bindParam(":rel_alto_custo_uti", $uti->rel_alto_custo_uti);
        $stmt->bindParam(":evento_adverso_uti", $uti->evento_adverso_uti);
        $stmt->bindParam(":rel_evento_adverso_uti", $uti->rel_evento_adverso_uti);
        $stmt->bindParam(":tipo_evento_adverso_utit", $uti->tipo_evento_adverso_utit);
        $stmt->bindParam(":opme_uti", $uti->opme_uti);
        $stmt->bindParam(":rel_opme_uti", $uti->rel_opme_uti);
        $stmt->bindParam(":home_care_uti", $uti->home_care_uti);
        $stmt->bindParam(":rel_home_care_uti", $uti->rel_home_care_uti);
        $stmt->bindParam(":rel_home_care_uti", $uti->rel_home_care_uti);
        $stmt->bindParam(":rel_desospitalizacao_uti", $uti->rel_desospitalizacao_uti);

        $stmt->bindParam(":id_uti", $uti->id_uti);
        $stmt->execute();

        // Mensagem de sucesso por editar uti
        $this->message->setMessage("uti atualizado com sucesso!", "success", "list_uti.php");
    }

    public function destroy($id_uti)
    {
        $stmt = $this->conn->prepare("DELETE FROM tb_uti WHERE id_uti = :id_uti");

        $stmt->bindParam(":id_uti", $id_uti);

        $stmt->execute();

        // Mensagem de sucesso por remover filme
        $this->message->setMessage("uti removido com sucesso!", "success", "list_uti.php");
    }


    public function findGeral()
    {

        $uti = [];

        $stmt = $this->conn->query("SELECT * FROM tb_uti ORDER BY id_uti asc");

        $stmt->execute();

        $uti = $stmt->fetchAll();

        return $uti;
    }
    // pegar id max da internacao
    public function findMax()
    {

        $uti = [];

        $stmt = $this->conn->query("SELECT max(id_internacao) as ultimoReg from tb_internacao");

        $stmt->execute();

        $utiIdMax = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $utiIdMax;
    }
}

# Limita o número de registros a serem mostrados por página
$limite = 10;

# Se pg não existe atribui 1 a variável pg
$pg = (isset($_GET['pg'])) ? (int)$_GET['pg'] : 1;

# Atribui a variável inicio o inicio de onde os registros vão ser
# mostrados por página, exemplo 0 à 10, 11 à 20 e assim por diante
$inicio = ($pg * $limite) - $limite;
$pesquisa_hosp = "";
# seleciona o total de registros  
$sql_Total = 'SELECT id_uti FROM tb_uti';
