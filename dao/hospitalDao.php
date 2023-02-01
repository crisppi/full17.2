<?php

require_once("./models/hospital.php");
require_once("./models/message.php");

// Review DAO
require_once("dao/hospitalDao.php");

class HospitalDAO implements HospitalDAOInterface
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

    public function buildHospital($data)
    {
        $hospital = new Hospital();

        $hospital->id_hospital = $data["id_hospital"];
        $hospital->nome_hosp = $data["nome_hosp"];
        $hospital->endereco_hosp = $data["endereco_hosp"];
        $hospital->numero_hosp = $data["numero_hosp"];
        $hospital->cidade_hosp = $data["cidade_hosp"];
        $hospital->cnpj_hosp = $data["cnpj_hosp"];
        $hospital->email01_hosp = $data["email01_hosp"];
        $hospital->email02_hosp = $data["email02_hosp"];
        $hospital->telefone01_hosp = $data["telefone01_hosp"];
        $hospital->telefone02_hosp = $data["telefone02_hosp"];
        $hospital->bairro_hosp = $data["bairro_hosp"];


        return $hospital;
    }

    public function findAll()
    {
        $hospital = [];

        $stmt = $this->conn->prepare("SELECT * FROM tb_hospital
        ORDER BY id_hospital asc");

        $stmt->execute();

        $hospital = $stmt->fetchAll();
        return $hospital;
    }


    public function findByHosp($pesquisa_nome)
    {

        $hospital = [];

        $stmt = $this->conn->prepare("SELECT * FROM tb_hospital
                                    WHERE nome_hosp LIKE :nome_hosp ");

        $stmt->bindValue(":nome_hosp", '%' . $pesquisa_nome . '%');

        $stmt->execute();

        $hospital = $stmt->fetchAll();
        return $hospital;
    }

    public function gethospital()
    {

        $hospital = [];

        $stmt = $this->conn->query("SELECT * FROM tb_hospital ORDER BY id_hospital asc");

        $stmt->execute();

        if ($stmt->rowCount() > 0) {

            $hospitalArray = $stmt->fetchAll();

            foreach ($hospitalArray as $hospital) {
                $hospital[] = $this->buildHospital($hospital);
            }
        }

        return $hospital;
    }

    public function gethospitalByNome($nome)
    {

        $hospital = [];

        $stmt = $this->conn->prepare("SELECT * FROM tb_hospital
                                    WHERE nome_hosp = :nome_hosp
                                    ORDER BY id_hospital asc");

        $stmt->bindParam(":nome_hosp", $nome_hosp);

        $stmt->execute();

        if ($stmt->rowCount() > 0) {

            $hospitalArray = $stmt->fetchAll();

            foreach ($hospitalArray as $hospital) {
                $hospital[] = $this->buildHospital($hospital);
            }
        }

        return $hospital;
    }

    public function findById($id_hospital)
    {
        $hospital = [];
        $stmt = $this->conn->prepare("SELECT * FROM tb_hospital
                                    WHERE id_hospital = :id_hospital");

        $stmt->bindParam(":id_hospital", $id_hospital);
        $stmt->execute();

        $data = $stmt->fetch();
        $hospital = $this->buildHospital($data);

        return $hospital;
    }


    public function create(Hospital $hospital)
    {

        $stmt = $this->conn->prepare("INSERT INTO tb_hospital (
        nome_hosp, 
        endereco_hosp, 
        numero_hosp, 
        bairro_hosp, 
        email01_hosp, 
        cnpj_hosp, 
        email02_hosp, 
        telefone01_hosp, 
        telefone02_hosp, 
        cidade_hosp
      ) VALUES (
        :nome_hosp, 
        :endereco_hosp, 
        :numero_hosp, 
        :bairro_hosp, 
        :email01_hosp, 
        :cnpj_hosp, 
        :email02_hosp, 
        :telefone01_hosp, 
        :telefone02_hosp, 
        :cidade_hosp
     )");

        $stmt->bindParam(":nome_hosp", $hospital->nome_hosp);
        $stmt->bindParam(":endereco_hosp", $hospital->endereco_hosp);
        $stmt->bindParam(":numero_hosp", $hospital->numero_hosp);
        $stmt->bindParam(":bairro_hosp", $hospital->bairro_hosp);
        $stmt->bindParam(":email01_hosp", $hospital->email01_hosp);
        $stmt->bindParam(":cnpj_hosp", $hospital->cnpj_hosp);
        $stmt->bindParam(":email02_hosp", $hospital->email02_hosp);
        $stmt->bindParam(":telefone01_hosp", $hospital->telefone01_hosp);
        $stmt->bindParam(":telefone02_hosp", $hospital->telefone02_hosp);
        $stmt->bindParam(":cidade_hosp", $hospital->cidade_hosp);

        $stmt->execute();

        // Mensagem de sucesso por adicionar filme
        $this->message->setMessage("hospital adicionado com sucesso!", "success", "list_hospital.php");
    }

    public function update(Hospital $hospital)
    {

        $stmt = $this->conn->prepare("UPDATE tb_hospital SET
        nome_hosp = :nome_hosp,
        endereco_hosp = :endereco_hosp,
        numero_hosp = :numero_hosp,
        email01_hosp = :email01_hosp,
        email02_hosp = :email02_hosp,
        cnpj_hosp = :cnpj_hosp,
        telefone01_hosp = :telefone01_hosp,
        telefone02_hosp = :telefone02_hosp,
        cidade_hosp = :cidade_hosp,
        bairro_hosp = :bairro_hosp

        WHERE id_hospital = :id_hospital 
      ");

        $stmt->bindParam(":nome_hosp", $hospital->nome_hosp);
        $stmt->bindParam(":endereco_hosp", $hospital->endereco_hosp);
        $stmt->bindParam(":numero_hosp", $hospital->numero_hosp);
        $stmt->bindParam(":email01_hosp", $hospital->email01_hosp);
        $stmt->bindParam(":email02_hosp", $hospital->email02_hosp);
        $stmt->bindParam(":cnpj_hosp", $hospital->cnpj_hosp);
        $stmt->bindParam(":telefone01_hosp", $hospital->telefone01_hosp);
        $stmt->bindParam(":telefone02_hosp", $hospital->telefone02_hosp);
        $stmt->bindParam(":cidade_hosp", $hospital->cidade_hosp);
        $stmt->bindParam(":bairro_hosp", $hospital->bairro_hosp);

        $stmt->bindParam(":id_hospital", $hospital->id_hospital);
        $stmt->execute();

        // Mensagem de sucesso por editar hospital
        $this->message->setMessage("hospital atualizado com sucesso!", "success", "list_hospital.php");
    }

    public function destroy($id_hospital)
    {
        $stmt = $this->conn->prepare("DELETE FROM tb_hospital WHERE id_hospital = :id_hospital");

        $stmt->bindParam(":id_hospital", $id_hospital);

        $stmt->execute();

        // Mensagem de sucesso por remover filme
        $this->message->setMessage("hospital removido com sucesso!", "success", "list_hospital.php");
    }


    public function findGeral()
    {

        $hospital = [];

        $stmt = $this->conn->query("SELECT * FROM tb_hospital ORDER BY id_hospital asc");

        $stmt->execute();

        $hospital = $stmt->fetchAll();

        return $hospital;
    }

    public function selectAllhospital($where = null, $order = null, $limit = null)
    {
        //DADOS DA QUERY
        $where = strlen($where) ? 'WHERE ' . $where : '';
        $order = strlen($order) ? 'ORDER BY ' . $order : '';
        $limit = strlen($limit) ? 'LIMIT ' . $limit : '';

        //MONTA A QUERY
        $query = $this->conn->query('SELECT * FROM tb_hospital ' . $where . ' ' . $order . ' ' . $limit);

        $query->execute();

        $hospital = $query->fetchAll();

        return $hospital;
    }

    public function Qtdhospital()
    {
        $hospital = [];

        $stmt = $this->conn->query("SELECT COUNT(id_hospital) FROM tb_hospital");

        $stmt->execute();

        $QtdTotalHos = $stmt->fetch();

        return $QtdTotalHos;
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
$sql_Total = 'SELECT id_hospital FROM tb_hospital';
