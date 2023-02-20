<?php

require_once("./models/antecedente.php");
require_once("./models/message.php");

// Review DAO
require_once("dao/antecedenteDao.php");

class antecedenteDAO implements antecedenteDAOInterface
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

    public function buildantecedente($data)
    {
        $antecedente = new antecedente();

        $antecedente->id_antecedente = $data["id_antecedente"];
        $antecedente->antecedente_ant = $data["antecedente_ant"];
        $antecedente->fk_usuario_ant = $data["fk_usuario_ant"];

        return $antecedente;
    }

    public function findAll()
    {
        $antecedente = [];

        $stmt = $this->conn->prepare("SELECT * FROM tb_antecedente
        ORDER BY id_antecedente asc");

        $stmt->execute();

        $antecedente = $stmt->fetchAll();
        return $antecedente;
    }

    public function getantecedenteByNome($nome)
    {

        $antecedente = [];

        $stmt = $this->conn->prepare("SELECT * FROM tb_antecedente
                                    WHERE antecedente_ant = :antecedente_ant
                                    ORDER BY id_antecedente asc");

        $stmt->bindParam(":antecedente_ant", $antecedente_ant);

        $stmt->execute();

        if ($stmt->rowCount() > 0) {

            $antecedenteArray = $stmt->fetchAll();

            foreach ($antecedenteArray as $antecedente) {
                $antecedente[] = $this->buildantecedente($antecedente);
            }
        }

        return $antecedente;
    }

    public function findById($id_antecedente)
    {
        $antecedente = [];
        $stmt = $this->conn->prepare("SELECT * FROM tb_antecedente
                                    WHERE id_antecedente = :id_antecedente");

        $stmt->bindParam(":id_antecedente", $id_antecedente);
        $stmt->execute();

        $data = $stmt->fetch();
        //var_dump($data);
        $antecedente = $this->buildantecedente($data);

        return $antecedente;
    }



    public function create(antecedente $antecedente)
    {

        $stmt = $this->conn->prepare("INSERT INTO tb_antecedente (
        antecedente_ant,
        fk_usuario_ant
      ) VALUES (
        :antecedente_ant,
        :fk_usuario_ant
     )");

        $stmt->bindParam(":antecedente_ant", $antecedente->antecedente_ant);
        $stmt->bindParam(":fk_usuario_ant", $antecedente->fk_usuario_ant);
        $stmt->execute();
        $cad_antec = 1;
        // Mensagem de sucesso por adicionar antecedente
        // Mensagem de sucesso por adicionar filme
        $this->message->setMessage("Adicionado com sucesso!", "success", "cad_antecedente.php");
    }

    public function update(antecedente $antecedente)
    {

        $stmt = $this->conn->prepare("UPDATE tb_antecedente SET
        antecedente_ant = :antecedente_ant
        
        WHERE id_antecedente = :id_antecedente 
      ");

        $stmt->bindParam(":antecedente_ant", $antecedente->antecedente_ant);
        $stmt->bindParam(":id_antecedente", $antecedente->id_antecedente);
        $stmt->execute();

        // Mensagem de sucesso por editar antecedente
        $this->message->setMessage("Atualizado com sucesso!", "success", "list_antecedente.php");
    }

    public function destroy($id_antecedente)
    {
        $stmt = $this->conn->prepare("DELETE FROM tb_antecedente WHERE id_antecedente = :id_antecedente");

        $stmt->bindParam(":id_antecedente", $id_antecedente);

        $stmt->execute();

        // Mensagem de sucesso por remover filme
        $this->message->setMessage("Removido com sucesso!", "success", "list_antecedente.php");
    }


    public function findGeral()
    {

        $antecedente = [];

        $stmt = $this->conn->query("SELECT * FROM tb_antecedente ORDER BY id_antecedente asc");

        $stmt->execute();

        $antecedente = $stmt->fetchAll();

        return $antecedente;
    }
    public function selectAllantecedente($where = null, $order = null, $limit = null)
    {
        //DADOS DA QUERY
        $where = strlen($where) ? 'WHERE ' . $where : '';
        $order = strlen($order) ? 'ORDER BY ' . $order : '';
        $limit = strlen($limit) ? 'LIMIT ' . $limit : '';

        //MONTA A QUERY
        $query = $this->conn->query('SELECT * FROM tb_antecedente ' . $where . ' ' . $order . ' ' . $limit);

        $query->execute();

        $antecedente = $query->fetchAll();

        return $antecedente;
    }

    public function QtdAntecedente($where = null, $order = null, $limite = null)
    {
        $hospital = [];
        //DADOS DA QUERY
        $where = strlen($where) ? 'WHERE ' . $where : '';
        $order = strlen($order) ? 'ORDER BY ' . $order : '';
        $limite = strlen($limite) ? 'LIMIT ' . $limite : '';

        $stmt = $this->conn->query('SELECT * ,COUNT(id_antecedente) as qtd FROM tb_antecedente ' . $where . ' ' . $order . ' ' . $limite);

        $stmt->execute();

        $QtdTotalAnt = $stmt->fetch();

        return $QtdTotalAnt;
    }
}




# Limita o número de registros a serem mostrados por página
$limite = 10;

# Se pg não existe atribui 1 a variável pg
$pg = (isset($_GET['pag'])) ? (int)$_GET['pag'] : 1;

# Atribui a variável inicio o inicio de onde os registros vão ser
# mostrados por página, exemplo 0 à 10, 11 à 20 e assim por diante
$inicio = ($pg * $limite) - $limite;
$pesquisa_hosp = "";
# seleciona o total de registros  
$sql_Total = 'SELECT id_antecedente FROM tb_antecedente';
