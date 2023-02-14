<?php

require_once("./models/negociacao.php");
require_once("./models/message.php");

// Review DAO
require_once("dao/negociacaoDao.php");

class negociacaoDAO implements negociacaoDAOInterface
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

    public function buildNegociacao($data)
    {
        $negociacao = new Negociacao();

        $negociacao->id_negociacao = $data["id_negociacao"];
        $negociacao->nome_est = $data["nome_est"];
        $negociacao->endereco_est = $data["endereco_est"];
        $negociacao->cidade_est = $data["cidade_est"];
        $negociacao->cnpj_est = $data["cnpj_est"];
        $negociacao->telefone01_est = $data["telefone01_est"];
        $negociacao->telefone02_est = $data["telefone02_est"];
        $negociacao->email01_est = $data["email01_est"];
        $negociacao->email02_est = $data["email02_est"];
        $negociacao->numero_est = $data["numero_est"];
        $negociacao->bairro_est = $data["bairro_est"];
        $negociacao->data_create_est = $data["data_create_est"];
        $negociacao->usuario_create_est = $data["usuario_create_est"];

        return $negociacao;
    }

    public function findAll()
    {
        $negociacao = [];

        $stmt = $this->conn->prepare("SELECT * FROM tb_negociacao
        ORDER BY id_negociacao asc");

        $stmt->execute();

        $negociacao = $stmt->fetchAll();
        return $negociacao;
    }

    public function findByNegociacao($pesquisa_nome)
    {

        $usuario = [];

        $stmt = $this->conn->prepare("SELECT * FROM tb_negociacao
                                    WHERE nome_est LIKE :nome_est ");

        $stmt->bindValue(":nome_est", '%' . $pesquisa_nome . '%');

        $stmt->execute();

        $usuario = $stmt->fetchAll();
        return $usuario;
    }
    public function getnegociacao()
    {

        $negociacao = [];

        $stmt = $this->conn->query("SELECT * FROM tb_negociacao ORDER BY id_negociacao asc");

        $stmt->execute();

        if ($stmt->rowCount() > 0) {

            $negociacaoArray = $stmt->fetchAll();

            foreach ($negociacaoArray as $negociacao) {
                $negociacao[] = $this->buildNegociacao($negociacao);
            }
        }

        return $negociacao;
    }

    public function getnegociacaoByNome($nome)
    {

        $negociacao = [];

        $stmt = $this->conn->prepare("SELECT * FROM tb_negociacao
                                    WHERE nome_est = :nome_est
                                    ORDER BY id_negociacao asc");

        $stmt->bindParam(":nome_est", $nome_est);

        $stmt->execute();

        if ($stmt->rowCount() > 0) {

            $negociacaoArray = $stmt->fetchAll();

            foreach ($negociacaoArray as $negociacao) {
                $negociacao[] = $this->buildNegociacao($negociacao);
            }
        }

        return $negociacao;
    }

    public function findById($id_negociacao)
    {
        $negociacao = [];
        $stmt = $this->conn->prepare("SELECT * FROM tb_negociacao
                                    WHERE id_negociacao = :id_negociacao");

        $stmt->bindParam(":id_negociacao", $id_negociacao);
        $stmt->execute();

        $data = $stmt->fetch();
        //var_dump($data);
        $negociacao = $this->buildNegociacao($data);

        return $negociacao;
    }

    public function findByTitle($title)
    {

        $negociacao = [];

        $stmt = $this->conn->prepare("SELECT * FROM tb_negociacao
                                    WHERE title LIKE :nome");

        $stmt->bindValue(":title", '%' . $title . '%');

        $stmt->execute();

        if ($stmt->rowCount() > 0) {

            $negociacaoArray = $stmt->fetchAll();

            foreach ($negociacaoArray as $negociacao) {
                $negociacao[] = $this->buildnegociacao($negociacao);
            }
        }

        return $negociacao;
    }

    public function create(negociacao $negociacao)
    {

        $stmt = $this->conn->prepare("INSERT INTO tb_negociacao (
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
        :usuario_create_est
     )");

        $stmt->bindParam(":nome_est", $negociacao->nome_est);
        $stmt->bindParam(":endereco_est", $negociacao->endereco_est);
        $stmt->bindParam(":bairro_est", $negociacao->bairro_est);
        $stmt->bindParam(":email01_est", $negociacao->email01_est);
        $stmt->bindParam(":cnpj_est", $negociacao->cnpj_est);
        $stmt->bindParam(":email02_est", $negociacao->email02_est);
        $stmt->bindParam(":telefone01_est", $negociacao->telefone01_est);
        $stmt->bindParam(":telefone02_est", $negociacao->telefone02_est);
        $stmt->bindParam(":numero_est", $negociacao->numero_est);
        $stmt->bindParam(":cidade_est", $negociacao->cidade_est);
        $stmt->bindParam(":data_create_est", $negociacao->data_create_est);
        $stmt->bindParam(":usuario_create_est", $negociacao->usuario_create_est);


        $stmt->execute();

        // Mensagem de sucesso por adicionar filme
        $this->message->setMessage("negociacao adicionado com sucesso!", "success", "list_negociacao.php");
    }

    public function update(negociacao $negociacao)
    {

        $stmt = $this->conn->prepare("UPDATE tb_negociacao SET
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

        WHERE id_negociacao = :id_negociacao 
      ");

        $stmt->bindParam(":nome_est", $negociacao->nome_est);
        $stmt->bindParam(":endereco_est", $negociacao->endereco_est);
        $stmt->bindParam(":email01_est", $negociacao->email01_est);
        $stmt->bindParam(":email02_est", $negociacao->email02_est);
        $stmt->bindParam(":cnpj_est", $negociacao->cnpj_est);
        $stmt->bindParam(":numero_est", $negociacao->numero_est);
        $stmt->bindParam(":telefone01_est", $negociacao->telefone01_est);
        $stmt->bindParam(":telefone02_est", $negociacao->telefone02_est);
        $stmt->bindParam(":cidade_est", $negociacao->cidade_est);
        $stmt->bindParam(":bairro_est", $negociacao->bairro_est);

        $stmt->bindParam(":id_negociacao", $negociacao->id_negociacao);
        $stmt->execute();

        // Mensagem de sucesso por editar negociacao
        $this->message->setMessage("negociacao atualizado com sucesso!", "success", "list_negociacao.php");
    }

    public function destroy($id_negociacao)
    {
        $stmt = $this->conn->prepare("DELETE FROM tb_negociacao WHERE id_negociacao = :id_negociacao");

        $stmt->bindParam(":id_negociacao", $id_negociacao);

        $stmt->execute();

        // Mensagem de sucesso por remover filme
        $this->message->setMessage("negociacao removido com sucesso!", "success", "list_negociacao.php");
    }


    public function findGeral()
    {

        $negociacao = [];

        $stmt = $this->conn->query("SELECT * FROM tb_negociacao ORDER BY id_negociacao asc");

        $stmt->execute();

        $negociacao = $stmt->fetchAll();

        return $negociacao;
    }

    public function selectAllnegociacao($where = null, $order = null, $limit = null)
    {
        //DADOS DA QUERY
        $where = strlen($where) ? 'WHERE ' . $where : '';
        $order = strlen($order) ? 'ORDER BY ' . $order : '';
        $limit = strlen($limit) ? 'LIMIT ' . $limit : '';

        //MONTA A QUERY
        $query = $this->conn->query('SELECT * FROM tb_negociacao ' . $where . ' ' . $order . ' ' . $limit);

        $query->execute();

        $negociacao = $query->fetchAll();

        return $negociacao;
    }

    public function Qtdnegociacao($where = null, $order = null, $limite = null)
    {
        $negociacao = [];
        //DADOS DA QUERY
        $where = strlen($where) ? 'WHERE ' . $where : '';
        $order = strlen($order) ? 'ORDER BY ' . $order : '';
        $limite = strlen($limite) ? 'LIMIT ' . $limite : '';

        $stmt = $this->conn->query('SELECT * ,COUNT(id_negociacao) as qtd FROM tb_negociacao ' . $where . ' ' . $order . ' ' . $limite);

        $stmt->execute();

        $QtdTotalEst = $stmt->fetch();

        return $QtdTotalEst;
    }
}
