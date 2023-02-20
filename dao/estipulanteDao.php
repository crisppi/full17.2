<?php

require_once("./models/estipulante.php");
require_once("./models/message.php");

// Review DAO
require_once("dao/estipulanteDao.php");

class EstipulanteDAO implements EstipulanteDAOInterface
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

    public function buildEstipulante($data)
    {
        $estipulante = new Estipulante();

        $estipulante->id_estipulante = $data["id_estipulante"];
        $estipulante->nome_est = $data["nome_est"];
        $estipulante->endereco_est = $data["endereco_est"];
        $estipulante->cidade_est = $data["cidade_est"];
        $estipulante->cnpj_est = $data["cnpj_est"];
        $estipulante->telefone01_est = $data["telefone01_est"];
        $estipulante->telefone02_est = $data["telefone02_est"];
        $estipulante->email01_est = $data["email01_est"];
        $estipulante->email02_est = $data["email02_est"];
        $estipulante->numero_est = $data["numero_est"];
        $estipulante->bairro_est = $data["bairro_est"];
        $estipulante->data_create_est = $data["data_create_est"];
        $estipulante->usuario_create_est = $data["usuario_create_est"];
        $estipulante->fk_usuario_est = $data["fk_usuario_est"];

        return $estipulante;
    }

    public function findAll()
    {
        $estipulante = [];

        $stmt = $this->conn->prepare("SELECT * FROM tb_estipulante
        ORDER BY id_estipulante asc");

        $stmt->execute();

        $estipulante = $stmt->fetchAll();
        return $estipulante;
    }

    public function findByEstipulante($pesquisa_nome)
    {

        $usuario = [];

        $stmt = $this->conn->prepare("SELECT * FROM tb_estipulante
                                    WHERE nome_est LIKE :nome_est ");

        $stmt->bindValue(":nome_est", '%' . $pesquisa_nome . '%');

        $stmt->execute();

        $usuario = $stmt->fetchAll();
        return $usuario;
    }
    public function getestipulante()
    {

        $estipulante = [];

        $stmt = $this->conn->query("SELECT * FROM tb_estipulante ORDER BY id_estipulante asc");

        $stmt->execute();

        if ($stmt->rowCount() > 0) {

            $estipulanteArray = $stmt->fetchAll();

            foreach ($estipulanteArray as $estipulante) {
                $estipulante[] = $this->buildEstipulante($estipulante);
            }
        }

        return $estipulante;
    }

    public function getestipulanteByNome($nome)
    {

        $estipulante = [];

        $stmt = $this->conn->prepare("SELECT * FROM tb_estipulante
                                    WHERE nome_est = :nome_est
                                    ORDER BY id_estipulante asc");

        $stmt->bindParam(":nome_est", $nome_est);

        $stmt->execute();

        if ($stmt->rowCount() > 0) {

            $estipulanteArray = $stmt->fetchAll();

            foreach ($estipulanteArray as $estipulante) {
                $estipulante[] = $this->buildEstipulante($estipulante);
            }
        }

        return $estipulante;
    }

    public function findById($id_estipulante)
    {
        $estipulante = [];
        $stmt = $this->conn->prepare("SELECT * FROM tb_estipulante
                                    WHERE id_estipulante = :id_estipulante");

        $stmt->bindParam(":id_estipulante", $id_estipulante);
        $stmt->execute();

        $data = $stmt->fetch();
        //var_dump($data);
        $estipulante = $this->buildEstipulante($data);

        return $estipulante;
    }

    public function findByTitle($title)
    {

        $estipulante = [];

        $stmt = $this->conn->prepare("SELECT * FROM tb_estipulante
                                    WHERE title LIKE :nome");

        $stmt->bindValue(":title", '%' . $title . '%');

        $stmt->execute();

        if ($stmt->rowCount() > 0) {

            $estipulanteArray = $stmt->fetchAll();

            foreach ($estipulanteArray as $estipulante) {
                $estipulante[] = $this->buildestipulante($estipulante);
            }
        }

        return $estipulante;
    }

    public function create(Estipulante $estipulante)
    {

        $stmt = $this->conn->prepare("INSERT INTO tb_estipulante (
        nome_est, 
        endereco_est, 
        bairro_est, 
        email01_est, 
        cnpj_est, 
        email02_est, 
        telefone01_est, 
        telefone02_est, 
        numero_est, 
        cidade_est, 
        data_create_est, 
        fk_usuario_est,
        usuario_create_est
      ) VALUES (
        :nome_est, 
        :endereco_est, 
        :bairro_est, 
        :email01_est, 
        :cnpj_est, 
        :email02_est, 
        :telefone01_est, 
        :telefone02_est, 
        :numero_est, 
        :cidade_est, 
        :data_create_est,
        :fk_usuario_est,
        :usuario_create_est
     )");

        $stmt->bindParam(":nome_est", $estipulante->nome_est);
        $stmt->bindParam(":endereco_est", $estipulante->endereco_est);
        $stmt->bindParam(":bairro_est", $estipulante->bairro_est);
        $stmt->bindParam(":email01_est", $estipulante->email01_est);
        $stmt->bindParam(":cnpj_est", $estipulante->cnpj_est);
        $stmt->bindParam(":email02_est", $estipulante->email02_est);
        $stmt->bindParam(":telefone01_est", $estipulante->telefone01_est);
        $stmt->bindParam(":telefone02_est", $estipulante->telefone02_est);
        $stmt->bindParam(":numero_est", $estipulante->numero_est);
        $stmt->bindParam(":cidade_est", $estipulante->cidade_est);
        $stmt->bindParam(":data_create_est", $estipulante->data_create_est);
        $stmt->bindParam(":usuario_create_est", $estipulante->usuario_create_est);
        $stmt->bindParam(":fk_usuario_est", $estipulante->fk_usuario_est);


        $stmt->execute();

        // Mensagem de sucesso por adicionar filme
        $this->message->setMessage("estipulante adicionado com sucesso!", "success", "list_estipulante.php");
    }

    public function update(Estipulante $estipulante)
    {

        $stmt = $this->conn->prepare("UPDATE tb_estipulante SET
        nome_est = :nome_est,
        endereco_est = :endereco_est,
        email01_est = :email01_est,
        email02_est = :email02_est,
        cnpj_est = :cnpj_est,
        numero_est = :numero_est,
        telefone01_est = :telefone01_est,
        telefone02_est = :telefone02_est,
        cidade_est = :cidade_est,
        bairro_est = :bairro_est

        WHERE id_estipulante = :id_estipulante 
      ");

        $stmt->bindParam(":nome_est", $estipulante->nome_est);
        $stmt->bindParam(":endereco_est", $estipulante->endereco_est);
        $stmt->bindParam(":email01_est", $estipulante->email01_est);
        $stmt->bindParam(":email02_est", $estipulante->email02_est);
        $stmt->bindParam(":cnpj_est", $estipulante->cnpj_est);
        $stmt->bindParam(":numero_est", $estipulante->numero_est);
        $stmt->bindParam(":telefone01_est", $estipulante->telefone01_est);
        $stmt->bindParam(":telefone02_est", $estipulante->telefone02_est);
        $stmt->bindParam(":cidade_est", $estipulante->cidade_est);
        $stmt->bindParam(":bairro_est", $estipulante->bairro_est);

        $stmt->bindParam(":id_estipulante", $estipulante->id_estipulante);
        $stmt->execute();

        // Mensagem de sucesso por editar estipulante
        $this->message->setMessage("estipulante atualizado com sucesso!", "success", "list_estipulante.php");
    }

    public function destroy($id_estipulante)
    {
        $stmt = $this->conn->prepare("DELETE FROM tb_estipulante WHERE id_estipulante = :id_estipulante");

        $stmt->bindParam(":id_estipulante", $id_estipulante);

        $stmt->execute();

        // Mensagem de sucesso por remover filme
        $this->message->setMessage("estipulante removido com sucesso!", "success", "list_estipulante.php");
    }


    public function findGeral()
    {

        $estipulante = [];

        $stmt = $this->conn->query("SELECT * FROM tb_estipulante ORDER BY id_estipulante asc");

        $stmt->execute();

        $estipulante = $stmt->fetchAll();

        return $estipulante;
    }

    public function selectAllestipulante($where = null, $order = null, $limit = null)
    {
        //DADOS DA QUERY
        $where = strlen($where) ? 'WHERE ' . $where : '';
        $order = strlen($order) ? 'ORDER BY ' . $order : '';
        $limit = strlen($limit) ? 'LIMIT ' . $limit : '';

        //MONTA A QUERY
        $query = $this->conn->query('SELECT * FROM tb_estipulante ' . $where . ' ' . $order . ' ' . $limit);

        $query->execute();

        $estipulante = $query->fetchAll();

        return $estipulante;
    }

    public function Qtdestipulante($where = null, $order = null, $limite = null)
    {
        $estipulante = [];
        //DADOS DA QUERY
        $where = strlen($where) ? 'WHERE ' . $where : '';
        $order = strlen($order) ? 'ORDER BY ' . $order : '';
        $limite = strlen($limite) ? 'LIMIT ' . $limite : '';

        $stmt = $this->conn->query('SELECT * ,COUNT(id_estipulante) as qtd FROM tb_estipulante ' . $where . ' ' . $order . ' ' . $limite);

        $stmt->execute();

        $QtdTotalEst = $stmt->fetch();

        return $QtdTotalEst;
    }
}


# Limita o número de registros a serem mostrados por página
$limite = 10;

# Se pg não existe atribui 1 a variável pg
$pg = (isset($_GET['pag'])) ? (int)$_GET['pag'] : 1;

# Atribui a variável inicio o inicio de onde os registros vão ser
# mostrados por página, exemplo 0 à 10, 11 à 20 e assim por diante
$inicio = ($pg * $limite) - $limite;
$pesquisa_est = "";
# seleciona o total de registros  
$sql_Total = 'SELECT id_estipulante FROM tb_estipulante';
