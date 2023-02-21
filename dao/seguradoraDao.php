<?php

require_once("./models/seguradora.php");
require_once("./models/message.php");

// Review DAO
require_once("dao/seguradoraDao.php");

class seguradoraDAO implements seguradoraDAOInterface
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

    public function buildseguradora($data)
    {
        $seguradora = new Seguradora();

        $seguradora->id_seguradora = $data["id_seguradora"];
        $seguradora->seguradora_seg = $data["seguradora_seg"];
        $seguradora->endereco_seg = $data["endereco_seg"];
        $seguradora->cidade_seg = $data["cidade_seg"];
        $seguradora->cnpj_seg = $data["cnpj_seg"];
        $seguradora->telefone01_seg = $data["telefone01_seg"];
        $seguradora->telefone02_seg = $data["telefone02_seg"];
        $seguradora->email01_seg = $data["email01_seg"];
        $seguradora->email02_seg = $data["email02_seg"];
        $seguradora->numero_seg = $data["numero_seg"];
        $seguradora->bairro_seg = $data["bairro_seg"];
        $seguradora->data_create_seg = $data["data_create_seg"];
        $seguradora->usuario_create_seg = $data["usuario_create_seg"];
        $seguradora->fk_usuario_seg = $data["fk_usuario_seg"];

        return $seguradora;
    }

    public function findBySeguradora($pesquisa_nome)
    {

        $seguradora = [];

        $stmt = $this->conn->prepare("SELECT * FROM tb_seguradora
                                    WHERE seguradora_seg LIKE :seguradora_seg ");

        $stmt->bindValue(":seguradora_seg", '%' . $pesquisa_nome . '%');

        $stmt->execute();

        $seguradora = $stmt->fetchAll();
        return $seguradora;
    }

    public function findAll()
    {
        $seguradora = [];

        $stmt = $this->conn->query("SELECT * FROM tb_seguradora ORDER BY id_seguradora asc");

        $stmt->execute();

        $seguradora = $stmt->fetchAll();

        return $seguradora;
    }

    public function getseguradora()
    {

        $seguradora = [];

        $stmt = $this->conn->query("SELECT * FROM tb_seguradora ORDER BY id_seguradora asc");

        $stmt->execute();

        if ($stmt->rowCount() > 0) {

            $seguradoraArray = $stmt->fetchAll();

            foreach ($seguradoraArray as $seguradora) {
                $seguradora[] = $this->buildseguradora($seguradora);
            }
        }

        return $seguradora;
    }

    public function getseguradoraByNome($nome)
    {

        $seguradora = [];

        $stmt = $this->conn->prepare("SELECT * FROM tb_seguradora
                                    WHERE seguradora_seg = :seguradora_seg
                                    ORDER BY id_seguradora asc");

        $stmt->bindParam(":seguradora_seg", $seguradora_seg);

        $stmt->execute();

        if ($stmt->rowCount() > 0) {

            $seguradoraArray = $stmt->fetchAll();

            foreach ($seguradoraArray as $seguradora) {
                $seguradora[] = $this->buildseguradora($seguradora);
            }
        }

        return $seguradora;
    }

    public function findById($id_seguradora)
    {
        $seguradora = [];
        $stmt = $this->conn->prepare("SELECT * FROM tb_seguradora
                                    WHERE id_seguradora = :id_seguradora");

        $stmt->bindParam(":id_seguradora", $id_seguradora);
        $stmt->execute();

        $data = $stmt->fetch();
        //var_dump($data);
        $seguradora = $this->buildseguradora($data);

        return $seguradora;
    }

    public function findByTitle($title)
    {

        $seguradora = [];

        $stmt = $this->conn->prepare("SELECT * FROM tb_seguradora
                                    WHERE title LIKE :nome");

        $stmt->bindValue(":title", '%' . $title . '%');

        $stmt->execute();

        if ($stmt->rowCount() > 0) {

            $seguradoraArray = $stmt->fetchAll();

            foreach ($seguradoraArray as $seguradora) {
                $seguradora[] = $this->buildseguradora($seguradora);
            }
        }

        return $seguradora;
    }

    public function create(seguradora $seguradora)
    {

        $stmt = $this->conn->prepare("INSERT INTO tb_seguradora (
        seguradora_seg, 
        endereco_seg, 
        bairro_seg, 
        email01_seg, 
        cnpj_seg, 
        email02_seg, 
        telefone01_seg, 
        telefone02_seg, 
        numero_seg, 
        cidade_seg, 
        data_create_seg,
        fk_usuario_seg,
        usuario_create_seg
      ) VALUES (
        :seguradora_seg, 
        :endereco_seg, 
        :bairro_seg, 
        :email01_seg, 
        :cnpj_seg, 
        :email02_seg, 
        :telefone01_seg, 
        :telefone02_seg, 
        :numero_seg, 
        :cidade_seg, 
        :data_create_seg,
        :fk_usuario_seg,
        :usuario_create_seg
     )");

        $stmt->bindParam(":seguradora_seg", $seguradora->seguradora_seg);
        $stmt->bindParam(":endereco_seg", $seguradora->endereco_seg);
        $stmt->bindParam(":bairro_seg", $seguradora->bairro_seg);
        $stmt->bindParam(":email01_seg", $seguradora->email01_seg);
        $stmt->bindParam(":cnpj_seg", $seguradora->cnpj_seg);
        $stmt->bindParam(":email02_seg", $seguradora->email02_seg);
        $stmt->bindParam(":telefone01_seg", $seguradora->telefone01_seg);
        $stmt->bindParam(":telefone02_seg", $seguradora->telefone02_seg);
        $stmt->bindParam(":numero_seg", $seguradora->numero_seg);
        $stmt->bindParam(":cidade_seg", $seguradora->cidade_seg);
        $stmt->bindParam(":data_create_seg", $seguradora->data_create_seg);
        $stmt->bindParam(":fk_usuario_seg", $seguradora->fk_usuario_seg);
        $stmt->bindParam(":usuario_create_seg", $seguradora->usuario_create_seg);


        $stmt->execute();

        // Mensagem de sucesso por adicionar filme
        $this->message->setMessage("seguradora adicionado com sucesso!", "success", "list_seguradora.php");
    }

    public function update(seguradora $seguradora)
    {

        $stmt = $this->conn->prepare("UPDATE tb_seguradora SET
        seguradora_seg = :seguradora_seg,
        endereco_seg = :endereco_seg,
        email01_seg = :email01_seg,
        email02_seg = :email02_seg,
        cnpj_seg = :cnpj_seg,
        numero_seg = :numero_seg,
        telefone01_seg = :telefone01_seg,
        telefone02_seg = :telefone02_seg,
        cidade_seg = :cidade_seg,
        bairro_seg = :bairro_seg

        WHERE id_seguradora = :id_seguradora 
      ");

        $stmt->bindParam(":seguradora_seg", $seguradora->seguradora_seg);
        $stmt->bindParam(":endereco_seg", $seguradora->endereco_seg);
        $stmt->bindParam(":email01_seg", $seguradora->email01_seg);
        $stmt->bindParam(":email02_seg", $seguradora->email02_seg);
        $stmt->bindParam(":cnpj_seg", $seguradora->cnpj_seg);
        $stmt->bindParam(":numero_seg", $seguradora->numero_seg);
        $stmt->bindParam(":telefone01_seg", $seguradora->telefone01_seg);
        $stmt->bindParam(":telefone02_seg", $seguradora->telefone02_seg);
        $stmt->bindParam(":cidade_seg", $seguradora->cidade_seg);
        $stmt->bindParam(":bairro_seg", $seguradora->bairro_seg);

        $stmt->bindParam(":id_seguradora", $seguradora->id_seguradora);
        $stmt->execute();

        // Mensagem de sucesso por editar seguradora
        $this->message->setMessage("seguradora atualizado com sucesso!", "success", "list_seguradora.php");
    }

    public function destroy($id_seguradora)
    {
        $stmt = $this->conn->prepare("DELETE FROM tb_seguradora WHERE id_seguradora = :id_seguradora");

        $stmt->bindParam(":id_seguradora", $id_seguradora);

        $stmt->execute();

        // Mensagem de sucesso por remover filme
        $this->message->setMessage("seguradora removido com sucesso!", "success", "list_seguradora.php");
    }


    public function findGeral()
    {

        $seguradora = [];

        $stmt = $this->conn->query("SELECT * FROM tb_seguradora ORDER BY id_seguradora asc");

        $stmt->execute();

        $seguradora = $stmt->fetchAll();

        return $seguradora;
    }

    public function selectAllSeguradora($where = null, $order = null, $limit = null)
    {
        //DADOS DA QUERY
        $where = strlen($where) ? 'WHERE ' . $where : '';
        $order = strlen($order) ? 'ORDER BY ' . $order : '';
        $limit = strlen($limit) ? 'LIMIT ' . $limit : '';

        //MONTA A QUERY
        $query = $this->conn->query('SELECT * FROM tb_seguradora ' . $where . ' ' . $order . ' ' . $limit);

        $query->execute();

        $seguradora = $query->fetchAll();

        return $seguradora;
    }

    public function QtdSeguradora($where = null, $order = null, $limite = null)
    {
        $estipulante = [];
        //DADOS DA QUERY
        $where = strlen($where) ? 'WHERE ' . $where : '';
        $order = strlen($order) ? 'ORDER BY ' . $order : '';
        $limite = strlen($limite) ? 'LIMIT ' . $limite : '';

        $stmt = $this->conn->query('SELECT * ,COUNT(id_seguradora) as qtd FROM tb_seguradora ' . $where . ' ' . $order . ' ' . $limite);

        $stmt->execute();

        $QtdTotalSeg = $stmt->fetch();

        return $QtdTotalSeg;
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
$sql_Total = 'SELECT id_seguradora FROM tb_seguradora';
