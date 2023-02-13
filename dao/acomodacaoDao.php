<?php

require_once("./models/acomodacao.php");
require_once("./models/hospital.php");
require_once("./models/message.php");

// Review DAO
require_once("dao/acomodacaoDao.php");

class acomodacaoDAO implements acomodacaoDAOInterface
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

    public function buildacomodacao($acomodacao)
    {
        $acomod = new acomodacao();

        $acomod->id_acomodacao = $acomodacao["id_acomodacao"];
        $acomod->acomodacao_aco = $acomodacao["acomodacao_aco"];
        $acomod->fk_hospital = $acomodacao["fk_hospital"];
        $acomod->valor_aco = $acomodacao["valor_aco"];
        return $acomodacao;
    }

    public function joinAcomodacaoHospital()
    {

        $acomodacao = [];

        $stmt = $this->conn->query("SELECT ac.id_acomodacao, ac.valor_aco, ac.acomodacao_aco, ho.id_hospital, ho.nome_hosp
         FROM tb_acomodacao ac 
         iNNER JOIN tb_hospital as ho On  
         ac.fk_hospital = ho.id_hospital
         ORDER BY ac.id_acomodacao asc");
        $stmt->execute();
        $acomodacao = $stmt->fetchAll();
        return $acomodacao;
    }

    // mostrar acomocacao por id_acomodacao
    public function joinAcomodacaoHospitalshow($id_acomodacao)

    {
        $stmt = $this->conn->query("SELECT ac.id_acomodacao, ac.fk_hospital, ac.valor_aco, ac.acomodacao_aco, ho.id_hospital, ho.nome_hosp
         FROM tb_acomodacao ac          
         iNNER JOIN tb_hospital as ho On  
         ac.fk_hospital = ho.id_hospital
         where id_acomodacao = $id_acomodacao   
         ");

        $stmt->execute();

        $acomodacao = $stmt->fetch();
        return $acomodacao;
    }
    public function findAll()
    {
    }

    public function getacomodacao()
    {

        $acomodacao = [];

        $stmt = $this->conn->query("SELECT * FROM tb_acomodacao ORDER BY id_acomodacao asc");

        $stmt->execute();

        if ($stmt->rowCount() > 0) {

            $acomodacaoArray = $stmt->fetchAll();

            foreach ($acomodacaoArray as $acomodacao) {
                $acomodacao[] = $this->buildacomodacao($acomodacao);
            }
        }

        return $acomodacao;
    }

    public function getacomodacaoByNome($nome)
    {

        $acomodacao = [];

        $stmt = $this->conn->prepare("SELECT * FROM tb_acomodacao
                                    WHERE acomodacao_aco = :acomodacao_aco
                                    ORDER BY id_acomodacao asc");

        $stmt->bindParam(":acomodacao_aco", $acomodacao_aco);

        $stmt->execute();

        return $acomodacao;
    }

    public function getHospitalByAcomodacao($nome)
    {

        $acomod_hosp = [];

        $stmt = $this->conn->prepare("SELECT * FROM tb_hospital
                                    WHERE acomodacao_aco = :acomodacao_aco
                                    ORDER BY id_acomodacao asc");

        $stmt->bindParam(":acomodacao_aco", $acomodacao_aco);

        $stmt->execute();

        return $acomod_hosp;
    }

    public function findById($id_acomodacao)
    {
        $acomodacao = [];
        $stmt = $this->conn->prepare("SELECT * FROM tb_acomodacao
                                    WHERE id_acomodacao = $id_acomodacao");

        $stmt->bindParam(":id_acomodacao", $id_acomodacao);
        $stmt->execute();

        $data = $stmt->fetch();
        $acomodacao = $this->buildacomodacao($data);

        return $acomodacao;
    }

    public function findByIdUpdate($id_acomodacao)
    {

        $acomodacao = [];

        $stmt = $this->conn->prepare("SELECT * FROM tb_acomodacao
                                    WHERE id_acomodacao = :id_acomodacao");

        $stmt->bindValue(":id_acomodacao", $id_acomodacao);

        $stmt->execute();

        if ($stmt->rowCount() > 0) {

            $acomodacaoArray = $stmt->fetchAll();

            foreach ($acomodacaoArray as $acomodacao) {
                $acomodacao[] = $this->buildacomodacao($acomodacao);
            }
        }

        return $acomodacao;
    }

    public function create(acomodacao $acomodacao)
    {

        $stmt = $this->conn->prepare("INSERT INTO tb_acomodacao (
        acomodacao_aco, 
        fk_hospital, 
        valor_aco
      ) VALUES (
        :acomodacao_aco, 
        :fk_hospital, 
        :valor_aco 
            )");

        $stmt->bindParam(":acomodacao_aco", $acomodacao->acomodacao_aco);
        $stmt->bindParam(":fk_hospital", $acomodacao->fk_hospital);
        $stmt->bindParam(":valor_aco", $acomodacao->valor_aco);

        $stmt->execute();

        // Mensagem de sucesso por adicionar acomodacao
        $this->message->setMessage("acomodacao adicionado com sucesso!", "success", "list_acomodacao.php");
    }

    public function update($acomodacao)
    {

        $stmt = $this->conn->prepare("UPDATE tb_acomodacao SET
        acomodacao_aco = :acomodacao_aco,
        valor_aco = :valor_aco,
        fk_hospital = :fk_hospital
        WHERE id_acomodacao = :id_acomodacao 
      ");

        $stmt->bindParam(":acomodacao_aco", $acomodacao['acomodacao_aco']);
        $stmt->bindParam(":valor_aco", $acomodacao['valor_aco']);
        $stmt->bindParam(":fk_hospital", $acomodacao['fk_hospital']);
        $stmt->bindParam(":id_acomodacao", $acomodacao['id_acomodacao']);

        $stmt->execute();

        // Mensagem de sucesso por editar acomodacao
        $this->message->setMessage("acomodacao atualizado com sucesso!", "success", "list_acomodacao.php");
    }

    public function destroy($id_acomodacao)
    {
        $stmt = $this->conn->prepare("DELETE FROM tb_acomodacao WHERE id_acomodacao = :id_acomodacao");

        $stmt->bindParam(":id_acomodacao", $id_acomodacao);

        $stmt->execute();

        // Mensagem de sucesso por remover filme
        $this->message->setMessage("acomodacao removido com sucesso!", "success", "list_acomodacao.php");
    }


    public function findGeral()
    {

        $acomodacao = [];

        $stmt = $this->conn->query("SELECT * FROM tb_acomodacao ORDER BY id_acomodacao asc");

        $stmt->execute();

        $acomodacao = $stmt->fetchAll();

        return $acomodacao;
    }



    // MODELO DE FILTRO COM SELECT ATUAL COM FILTROS E PAGINACAO

    public function selectAllacomodacao($where = null, $order = null, $limit = null)
    {
        //DADOS DA QUERY
        $where = strlen($where) ? 'WHERE ' . $where : '';
        $order = strlen($order) ? 'ORDER BY ' . $order : '';
        $limit = strlen($limit) ? 'LIMIT ' . $limit : '';

        //MONTA A QUERY
        $query = $this->conn->query('SELECT 
        ac.id_acomodacao,  
        ac.acomodacao_aco, 
        ac.valor_aco,   
        ho.id_hospital, 
        ho.nome_hosp 
    FROM tb_acomodacao ac 

        iNNER JOIN tb_hospital as ho On  
        ac.fk_hospital = ho.id_hospital ' . $where . ' ' . $order . ' ' . $limit);

        $query->execute();

        $acomodacao = $query->fetchAll();

        return $acomodacao;
    }

    public function QtdAcomodacao($where = null, $order = null, $limite = null)
    {
        $hospital = [];
        //DADOS DA QUERY
        $where = strlen($where) ? 'WHERE ' . $where : '';
        $order = strlen($order) ? 'ORDER BY ' . $order : '';
        $limite = strlen($limite) ? 'LIMIT ' . $limite : '';

        $stmt = $this->conn->query('SELECT * ,COUNT(id_acomodacao) as qtd FROM tb_acomodacao ' . $where . ' ' . $order . ' ' . $limite);

        $stmt->execute();

        $QtdTotalAnt = $stmt->fetch();

        return $QtdTotalAnt;
    }
}

# Limita o número de registros a serem mostrados por página
$limite = 20;

# Se pg não existe atribui 1 a variável pg
$pg = (isset($_GET['pg'])) ? (int)$_GET['pg'] : 1;

# Atribui a variável inicio o inicio de onde os registros vão ser
# mostrados por página, exemplo 0 à 10, 11 à 20 e assim por diante
$inicio = ($pg * $limite) - $limite;
$pesquisa_hosp = "";
# seleciona o total de registros  
$sql_Total = 'SELECT id_acomodacao FROM tb_acomodacao';
