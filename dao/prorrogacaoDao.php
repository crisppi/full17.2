<?php

require_once("./models/prorrogacao.php");
require_once("./models/hospital.php");
require_once("./models/message.php");

// Review DAO
require_once("dao/prorrogacaoDao.php");

class prorrogacaoDAO implements prorrogacaoDAOInterface
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

    public function buildprorrogacao($data)
    {
        $prorrogacao = new prorrogacao();

        $prorrogacao->id_prorrogacao = $data["id_prorrogacao"];
        $prorrogacao->acomod1_pror = $data["acomod1_pror"];
        $prorrogacao->isol_1_pror = $data["isol_1_pror"];
        $prorrogacao->prorrog1_fim_pror = $data["prorrog1_fim_pror"];
        $prorrogacao->prorrog1_ini_pror = $data["prorrog1_ini_pror"];

        return $prorrogacao;
    }
    public function create(prorrogacao $prorrogacao)
    {

        $stmt = $this->conn->prepare("INSERT INTO tb_prorrogacao (
        acomod1_pror, 
        isol_1_pror, 
        prorrog1_fim_pror, 
        prorrog1_ini_pror
      ) VALUES (
        :acomod1_pror, 
        :isol_1_pror, 
        :prorrog1_fim_pror, 
        :prorrog1_ini_pror

     )");

        $stmt->bindParam(":acomod1_pror", $prorrogacao->acomod1_pror);
        $stmt->bindParam(":isol_1_pror", $prorrogacao->isol_1_pror);
        $stmt->bindParam(":prorrog1_fim_pror", $prorrogacao->prorrog1_fim_pror);
        $stmt->bindParam(":prorrog1_ini_pror", $prorrogacao->prorrog1_ini_pror);


        $stmt->execute();

        // Mensagem de sucesso por adicionar filme
        $this->message->setMessage("prorrogacao adicionado com sucesso!", "success", "list_prorrogacao.php");
    }
    public function joinprorrogacaoHospital()
    {

        $prorrogacao = [];

        $stmt = $this->conn->query("SELECT ac.id_prorrogacao, 
        ac.valor_aco, 
        ac.prorrogacao_aco, 
        ho.id_hospital, 
        ho.nome_hosp
         FROM tb_prorrogacao ac 
         iNNER JOIN tb_hospital as ho On  
         ac.fk_hospital = ho.id_hospital
         ORDER BY ac.id_prorrogacao asc");
        $stmt->execute();
        $prorrogacao = $stmt->fetchAll();
        return $prorrogacao;
    }

    // mostrar acomocacao por id_prorrogacao
    public function joinprorrogacaoHospitalshow($id_prorrogacao)

    {
        $stmt = $this->conn->query("SELECT ac.id_prorrogacao, ac.fk_hospital, ac.valor_aco, ac.prorrogacao_aco, ho.id_hospital, ho.nome_hosp
         FROM tb_prorrogacao ac          
         iNNER JOIN tb_hospital as ho On  
         ac.fk_hospital = ho.id_hospital
         where id_prorrogacao = $id_prorrogacao   
         ");

        $stmt->execute();

        $prorrogacao = $stmt->fetch();
        return $prorrogacao;
    }
    public function findAll()
    {
    }


    public function findById($id_prorrogacao)
    {
        $prorrogacao = [];
        $stmt = $this->conn->prepare("SELECT * FROM tb_prorrogacao
                                    WHERE id_prorrogacao = :id_prorrogacao");

        $stmt->bindParam(":id_prorrogacao", $id_prorrogacao);
        $stmt->execute();

        $data = $stmt->fetch();
        $prorrogacao = $this->buildprorrogacao($data);

        return $prorrogacao;
    }



    public function update($prorrogacao)
    {

        $stmt = $this->conn->prepare("UPDATE tb_prorrogacao SET
        fk_internacao_pror = :fk_internacao_pror,
        alto_custo_pror = :alto_custo_pror,
        rel_alto_custo_pror = :rel_alto_custo_pror,
        evento_adverso_pror = :evento_adverso_pror,
        rel_evento_adverso_pror = :rel_evento_adverso_pror,
        tipo_evento_adverso_prort = :tipo_evento_adverso_prort,
        opme_pror = :opme_pror,
        rel_opme_pror = :rel_opme_pror,
        home_care_pror = :home_care_pror,
        rel_home_care_pror, = :rel_home_care_pror,
        desospitalizacao_pror, = :desospitalizacao_pror,
        rel_desospitalizacao_pror, = :rel_desospitalizacao_pror

        WHERE id_prorrogacao = :id_prorrogacao 
      ");

        $stmt->bindParam(":fk_internacao_pror", $prorrogacao->fk_internacao_pror);
        $stmt->bindParam(":alto_custo_pror", $prorrogacao->alto_custo_pror);
        $stmt->bindParam(":rel_alto_custo_pror", $prorrogacao->rel_alto_custo_pror);
        $stmt->bindParam(":evento_adverso_pror", $prorrogacao->evento_adverso_pror);
        $stmt->bindParam(":rel_evento_adverso_pror", $prorrogacao->rel_evento_adverso_pror);
        $stmt->bindParam(":tipo_evento_adverso_prort", $prorrogacao->tipo_evento_adverso_prort);
        $stmt->bindParam(":opme_pror", $prorrogacao->opme_pror);
        $stmt->bindParam(":rel_opme_pror", $prorrogacao->rel_opme_pror);
        $stmt->bindParam(":home_care_pror", $prorrogacao->home_care_pror);
        $stmt->bindParam(":rel_home_care_pror", $prorrogacao->rel_home_care_pror);
        $stmt->bindParam(":rel_home_care_pror", $prorrogacao->rel_home_care_pror);
        $stmt->bindParam(":rel_desospitalizacao_pror", $prorrogacao->rel_desospitalizacao_pror);

        $stmt->bindParam(":id_prorrogacao", $prorrogacao->id_prorrogacao);
        $stmt->execute();

        // Mensagem de sucesso por editar prorrogacao
        $this->message->setMessage("prorrogacao atualizado com sucesso!", "success", "list_prorrogacao.php");
    }
    public function findByIdUpdate($prorrogacao)
    {

        $stmt = $this->conn->prepare("UPDATE tb_prorrogacao SET
        fk_internacao_pror = :fk_internacao_pror,
        alto_custo_pror = :alto_custo_pror,
        rel_alto_custo_pror = :rel_alto_custo_pror,
        evento_adverso_pror = :evento_adverso_pror,
        rel_evento_adverso_pror = :rel_evento_adverso_pror,
        tipo_evento_adverso_prort = :tipo_evento_adverso_prort,
        opme_pror = :opme_pror,
        rel_opme_pror = :rel_opme_pror,
        home_care_pror = :home_care_pror,
        rel_home_care_pror, = :rel_home_care_pror,
        desospitalizacao_pror, = :desospitalizacao_pror,
        rel_desospitalizacao_pror, = :rel_desospitalizacao_pror

        WHERE id_prorrogacao = :id_prorrogacao 
      ");

        $stmt->bindParam(":fk_internacao_pror", $prorrogacao->fk_internacao_pror);
        $stmt->bindParam(":alto_custo_pror", $prorrogacao->alto_custo_pror);
        $stmt->bindParam(":rel_alto_custo_pror", $prorrogacao->rel_alto_custo_pror);
        $stmt->bindParam(":evento_adverso_pror", $prorrogacao->evento_adverso_pror);
        $stmt->bindParam(":rel_evento_adverso_pror", $prorrogacao->rel_evento_adverso_pror);
        $stmt->bindParam(":tipo_evento_adverso_prort", $prorrogacao->tipo_evento_adverso_prort);
        $stmt->bindParam(":opme_pror", $prorrogacao->opme_pror);
        $stmt->bindParam(":rel_opme_pror", $prorrogacao->rel_opme_pror);
        $stmt->bindParam(":home_care_pror", $prorrogacao->home_care_pror);
        $stmt->bindParam(":rel_home_care_pror", $prorrogacao->rel_home_care_pror);
        $stmt->bindParam(":rel_home_care_pror", $prorrogacao->rel_home_care_pror);
        $stmt->bindParam(":rel_desospitalizacao_pror", $prorrogacao->rel_desospitalizacao_pror);

        $stmt->bindParam(":id_prorrogacao", $prorrogacao->id_prorrogacao);
        $stmt->execute();

        // Mensagem de sucesso por editar prorrogacao
        $this->message->setMessage("prorrogacao atualizado com sucesso!", "success", "list_prorrogacao.php");
    }

    public function destroy($id_prorrogacao)
    {
        $stmt = $this->conn->prepare("DELETE FROM tb_prorrogacao WHERE id_prorrogacao = :id_prorrogacao");

        $stmt->bindParam(":id_prorrogacao", $id_prorrogacao);

        $stmt->execute();

        // Mensagem de sucesso por remover filme
        $this->message->setMessage("prorrogacao removido com sucesso!", "success", "list_prorrogacao.php");
    }


    public function findGeral()
    {

        $prorrogacao = [];

        $stmt = $this->conn->query("SELECT * FROM tb_prorrogacao ORDER BY id_prorrogacao asc");

        $stmt->execute();

        $prorrogacao = $stmt->fetchAll();

        return $prorrogacao;
    }
    // pegar id max da internacao
    public function findMax()
    {

        $prorrogacao = [];

        $stmt = $this->conn->query("SELECT max(id_internacao) as ultimoReg from tb_internacao");

        $stmt->execute();

        $prorrogacaoIdMax = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $prorrogacaoIdMax;
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
$sql_Total = 'SELECT id_prorrogacao FROM tb_prorrogacao';
