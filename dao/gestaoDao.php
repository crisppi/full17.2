<?php

require_once("./models/gestao.php");
require_once("./models/hospital.php");
require_once("./models/message.php");

// Review DAO
require_once("dao/gestaoDao.php");

class gestaoDAO implements gestaoDAOInterface
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

    public function buildgestao($data)
    {
        $gestao = new gestao();

        $gestao->id_gestao = $data["id_gestao"];
        $gestao->fk_internacao_ges = $data["fk_internacao_ges"];
        $gestao->alto_custo_ges = $data["alto_custo_ges"];
        $gestao->rel_alto_custo_ges = $data["rel_alto_custo_ges"];
        $gestao->evento_adverso_ges = $data["evento_adverso_ges"];
        $gestao->rel_evento_adverso_ges = $data["rel_evento_adverso_ges"];
        $gestao->rel_evento_adverso_ges = $data["rel_evento_adverso_ges"];
        $gestao->rel_evento_adverso_ges = $data["rel_evento_adverso_ges"];
        $gestao->rel_opme_ges = $data["rel_opme_ges"];
        $gestao->home_care_ges = $data["home_care_ges"];
        $gestao->rel_home_care_ges = $data["rel_home_care_ges"];
        $gestao->desospitalizacao_ges = $data["desospitalizacao_ges"];
        $gestao->rel_desospitalizacao_ges = $data["rel_desospitalizacao_ges"];
        $gestao->fk_user_ges = $data["fk_user_ges"];


        return $gestao;
    }
    public function joingestaoHospital()
    {

        $gestao = [];

        $stmt = $this->conn->query("SELECT ac.id_gestao, ac.valor_aco, ac.gestao_aco, ho.id_hospital, ho.nome_hosp
         FROM tb_gestao ac 
         iNNER JOIN tb_hospital as ho On  
         ac.fk_hospital = ho.id_hospital
         ORDER BY ac.id_gestao asc");
        $stmt->execute();
        $gestao = $stmt->fetchAll();
        return $gestao;
    }

    // mostrar acomocacao por id_gestao
    public function joingestaoHospitalshow($id_gestao)

    {
        $stmt = $this->conn->query("SELECT ac.id_gestao, ac.fk_hospital, ac.valor_aco, ac.gestao_aco, ho.id_hospital, ho.nome_hosp
         FROM tb_gestao ac          
         iNNER JOIN tb_hospital as ho On  
         ac.fk_hospital = ho.id_hospital
         where id_gestao = $id_gestao   
         ");

        $stmt->execute();

        $gestao = $stmt->fetch();
        return $gestao;
    }
    public function findAll()
    {
    }

    public function getgestao()
    {

        $gestao = [];

        $stmt = $this->conn->query("SELECT * FROM tb_gestao ORDER BY id_gestao asc");

        $stmt->execute();

        if ($stmt->rowCount() > 0) {

            $gestaoArray = $stmt->fetchAll();

            foreach ($gestaoArray as $gestao) {
                $gestao[] = $this->buildgestao($gestao);
            }
        }

        return $gestao;
    }



    public function findById($id_gestao)
    {
        $gestao = [];
        $stmt = $this->conn->prepare("SELECT * FROM tb_gestao
                                    WHERE id_gestao = :id_gestao");

        $stmt->bindParam(":id_gestao", $id_gestao);
        $stmt->execute();

        $data = $stmt->fetch();
        $gestao = $this->buildgestao($data);

        return $gestao;
    }


    public function create(gestao $gestao)
    {

        $stmt = $this->conn->prepare("INSERT INTO tb_gestao (
        fk_internacao_ges, 
        fk_visita_ges, 
        alto_custo_ges, 
        rel_alto_custo_ges, 
        evento_adverso_ges, 
        rel_evento_adverso_ges, 
        tipo_evento_adverso_gest, 
        opme_ges, 
        rel_opme_ges, 
        home_care_ges, 
        rel_home_care_ges,
        desospitalizacao_ges,
        rel_desospitalizacao_ges
      ) VALUES (
        :fk_internacao_ges, 
        :fk_visita_ges, 
        :alto_custo_ges, 
        :rel_alto_custo_ges, 
        :evento_adverso_ges, 
        :rel_evento_adverso_ges, 
        :tipo_evento_adverso_gest, 
        :opme_ges, 
        :rel_opme_ges, 
        :home_care_ges, 
        :rel_home_care_ges,
        :desospitalizacao_ges,
        :rel_desospitalizacao_ges

     )");

        $stmt->bindParam(":fk_internacao_ges", $gestao->fk_internacao_ges);
        $stmt->bindParam(":fk_visita_ges", $gestao->fk_visita_ges);
        $stmt->bindParam(":alto_custo_ges", $gestao->alto_custo_ges);
        $stmt->bindParam(":rel_alto_custo_ges", $gestao->rel_alto_custo_ges);
        $stmt->bindParam(":evento_adverso_ges", $gestao->evento_adverso_ges);
        $stmt->bindParam(":rel_evento_adverso_ges", $gestao->rel_evento_adverso_ges);
        $stmt->bindParam(":tipo_evento_adverso_gest", $gestao->tipo_evento_adverso_gest);
        $stmt->bindParam(":opme_ges", $gestao->opme_ges);
        $stmt->bindParam(":rel_opme_ges", $gestao->rel_opme_ges);
        $stmt->bindParam(":home_care_ges", $gestao->home_care_ges);
        $stmt->bindParam(":rel_home_care_ges", $gestao->rel_home_care_ges);
        $stmt->bindParam(":desospitalizacao_ges", $gestao->desospitalizacao_ges);
        $stmt->bindParam(":rel_desospitalizacao_ges", $gestao->rel_desospitalizacao_ges);

        $stmt->execute();

        // Mensagem de sucesso por adicionar filme
        $this->message->setMessage("gestao adicionado com sucesso!", "success", "list_internacao.php");
    }

    public function update($gestao)
    {

        $stmt = $this->conn->prepare("UPDATE tb_gestao SET
        fk_internacao_ges = :fk_internacao_ges,
        alto_custo_ges = :alto_custo_ges,
        rel_alto_custo_ges = :rel_alto_custo_ges,
        evento_adverso_ges = :evento_adverso_ges,
        rel_evento_adverso_ges = :rel_evento_adverso_ges,
        tipo_evento_adverso_gest = :tipo_evento_adverso_gest,
        opme_ges = :opme_ges,
        rel_opme_ges = :rel_opme_ges,
        home_care_ges = :home_care_ges,
        rel_home_care_ges, = :rel_home_care_ges,
        desospitalizacao_ges, = :desospitalizacao_ges,
        rel_desospitalizacao_ges, = :rel_desospitalizacao_ges

        WHERE id_gestao = :id_gestao 
      ");

        $stmt->bindParam(":fk_internacao_ges", $gestao->fk_internacao_ges);
        $stmt->bindParam(":alto_custo_ges", $gestao->alto_custo_ges);
        $stmt->bindParam(":rel_alto_custo_ges", $gestao->rel_alto_custo_ges);
        $stmt->bindParam(":evento_adverso_ges", $gestao->evento_adverso_ges);
        $stmt->bindParam(":rel_evento_adverso_ges", $gestao->rel_evento_adverso_ges);
        $stmt->bindParam(":tipo_evento_adverso_gest", $gestao->tipo_evento_adverso_gest);
        $stmt->bindParam(":opme_ges", $gestao->opme_ges);
        $stmt->bindParam(":rel_opme_ges", $gestao->rel_opme_ges);
        $stmt->bindParam(":home_care_ges", $gestao->home_care_ges);
        $stmt->bindParam(":rel_home_care_ges", $gestao->rel_home_care_ges);
        $stmt->bindParam(":rel_home_care_ges", $gestao->rel_home_care_ges);
        $stmt->bindParam(":rel_desospitalizacao_ges", $gestao->rel_desospitalizacao_ges);

        $stmt->bindParam(":id_gestao", $gestao->id_gestao);
        $stmt->execute();

        // Mensagem de sucesso por editar gestao
        $this->message->setMessage("gestao atualizado com sucesso!", "success", "list_internacao.php");
    }
    public function findByIdUpdate($gestao)
    {

        $stmt = $this->conn->prepare("UPDATE tb_gestao SET
        fk_internacao_ges = :fk_internacao_ges,
        alto_custo_ges = :alto_custo_ges,
        rel_alto_custo_ges = :rel_alto_custo_ges,
        evento_adverso_ges = :evento_adverso_ges,
        rel_evento_adverso_ges = :rel_evento_adverso_ges,
        tipo_evento_adverso_gest = :tipo_evento_adverso_gest,
        opme_ges = :opme_ges,
        rel_opme_ges = :rel_opme_ges,
        home_care_ges = :home_care_ges,
        rel_home_care_ges, = :rel_home_care_ges,
        desospitalizacao_ges, = :desospitalizacao_ges,
        rel_desospitalizacao_ges, = :rel_desospitalizacao_ges

        WHERE id_gestao = :id_gestao 
      ");

        $stmt->bindParam(":fk_internacao_ges", $gestao->fk_internacao_ges);
        $stmt->bindParam(":alto_custo_ges", $gestao->alto_custo_ges);
        $stmt->bindParam(":rel_alto_custo_ges", $gestao->rel_alto_custo_ges);
        $stmt->bindParam(":evento_adverso_ges", $gestao->evento_adverso_ges);
        $stmt->bindParam(":rel_evento_adverso_ges", $gestao->rel_evento_adverso_ges);
        $stmt->bindParam(":tipo_evento_adverso_gest", $gestao->tipo_evento_adverso_gest);
        $stmt->bindParam(":opme_ges", $gestao->opme_ges);
        $stmt->bindParam(":rel_opme_ges", $gestao->rel_opme_ges);
        $stmt->bindParam(":home_care_ges", $gestao->home_care_ges);
        $stmt->bindParam(":rel_home_care_ges", $gestao->rel_home_care_ges);
        $stmt->bindParam(":rel_home_care_ges", $gestao->rel_home_care_ges);
        $stmt->bindParam(":rel_desospitalizacao_ges", $gestao->rel_desospitalizacao_ges);

        $stmt->bindParam(":id_gestao", $gestao->id_gestao);
        $stmt->execute();

        // Mensagem de sucesso por editar gestao
        $this->message->setMessage("gestao atualizado com sucesso!", "success", "list_gestao.php");
    }

    public function destroy($id_gestao)
    {
        $stmt = $this->conn->prepare("DELETE FROM tb_gestao WHERE id_gestao = :id_gestao");

        $stmt->bindParam(":id_gestao", $id_gestao);

        $stmt->execute();

        // Mensagem de sucesso por remover filme
        $this->message->setMessage("gestao removido com sucesso!", "success", "cad_internacao_niveis.php");
    }


    public function findGeral()
    {

        $gestao = [];

        $stmt = $this->conn->query("SELECT * FROM tb_gestao ORDER BY id_gestao asc");

        $stmt->execute();

        $gestao = $stmt->fetchAll();

        return $gestao;
    }
    // pegar id max da internacao
    public function findMax()
    {

        $gestao = [];

        $stmt = $this->conn->query("SELECT max(id_internacao) as ultimoReg from tb_internacao");

        $stmt->execute();

        $gestaoIdMax = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $gestaoIdMax;
    }
    public function findMaxVis()
    {

        $gestao = [];

        $stmt = $this->conn->query("SELECT max(id_visita) as ultimoReg from tb_visita");

        $stmt->execute();

        $gestaoIdMaxVis = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $gestaoIdMaxVis;
    }
    public function findMaxGesInt()
    {

        $gestao = [];

        $stmt = $this->conn->query("SELECT max(id_internacao) as ultimoReg from tb_internacao");

        $stmt->execute();

        $findMaxGesInt = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $findMaxGesInt;
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
$sql_Total = 'SELECT id_gestao FROM tb_gestao';
