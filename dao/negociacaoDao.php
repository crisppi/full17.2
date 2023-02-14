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
        $negociacao->dif_1 = $data["dif_1"];
        $negociacao->dif_2 = $data["dif_2"];
        $negociacao->dif_3 = $data["dif_3"];
        $negociacao->dif_total = $data["dif_total"];
        $negociacao->fk_id_int = $data["fk_id_int"];
        $negociacao->qtd_1 = $data["qtd_1"];
        $negociacao->qtd_2 = $data["qtd_2"];
        $negociacao->qtd_3 = $data["qtd_3"];
        $negociacao->troca_de_1 = $data["troca_de_1"];
        $negociacao->troca_de_2 = $data["troca_de_2"];
        $negociacao->troca_de_3 = $data["troca_de_3"];
        $negociacao->troca_para_1 = $data["troca_para_1"];
        $negociacao->troca_para_2 = $data["troca_para_2"];
        $negociacao->troca_para_3 = $data["troca_para_3"];
        $negociacao->valor_de_1 = $data["valor_de_1"];
        $negociacao->valor_de_2 = $data["valor_de_2"];
        $negociacao->valor_de_3 = $data["valor_de_3"];
        $negociacao->valor_para_1 = $data["valor_para_1"];
        $negociacao->valor_para_2 = $data["valor_para_2"];
        $negociacao->valor_para_3 = $data["valor_para_3"];

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



    public function create(negociacao $negociacao)
    {

        $stmt = $this->conn->prepare("INSERT INTO tb_negociacao (
        dif_1, 
        dif_2, 
        dif_3, 
        dif_total, 
        fk_id_int, 
        qtd_1, 
        qtd_2, 
        qtd_3, 
        troca_de_1, 
        troca_de_2, 
        troca_de_3, 
        troca_para_1, 
        troca_para_2, 
        troca_para_3, 
        valor_de_1, 
        valor_de_2, 
        valor_de_3, 
        valor_para_1, 
        valor_para_2, 
        valor_para_3
      ) VALUES (
        :dif_1, 
        :dif_2, 
        :dif_3, 
        :dif_total, 
        :fk_id_int, 
        :qtd_1, 
        :qtd_2, 
        :qtd_3, 
        :troca_de_1, 
        :troca_de_2, 
        :troca_de_3, 
        :troca_para_1, 
        :troca_para_2, 
        :troca_para_3, 
        :valor_de_1, 
        :valor_de_2, 
        :valor_de_3, 
        :valor_para_1, 
        :valor_para_2, 
        :valor_para_3
     )");

        $stmt->bindParam(":dif_1", $negociacao->dif_1);
        $stmt->bindParam(":dif_2", $negociacao->dif_2);
        $stmt->bindParam(":dif_3", $negociacao->dif_3);
        $stmt->bindParam(":dif_total", $negociacao->dif_total);
        $stmt->bindParam(":fk_id_int", $negociacao->fk_id_int);
        $stmt->bindParam(":qtd_1", $negociacao->qtd_1);
        $stmt->bindParam(":qtd_2", $negociacao->qtd_2);
        $stmt->bindParam(":qtd_3", $negociacao->qtd_3);
        $stmt->bindParam(":troca_de_1", $negociacao->troca_de_1);
        $stmt->bindParam(":troca_de_2", $negociacao->troca_de_2);
        $stmt->bindParam(":troca_de_3", $negociacao->troca_de_3);
        $stmt->bindParam(":troca_para_1", $negociacao->troca_para_1);
        $stmt->bindParam(":troca_para_2", $negociacao->troca_para_2);
        $stmt->bindParam(":troca_para_3", $negociacao->troca_para_3);
        $stmt->bindParam(":valor_de_1", $negociacao->valor_de_1);
        $stmt->bindParam(":valor_de_2", $negociacao->valor_de_2);
        $stmt->bindParam(":valor_de_3", $negociacao->valor_de_3);
        $stmt->bindParam(":valor_para_1", $negociacao->valor_para_1);
        $stmt->bindParam(":valor_para_2", $negociacao->valor_para_2);
        $stmt->bindParam(":valor_para_3", $negociacao->valor_para_3);


        $stmt->execute();

        // Mensagem de sucesso por adicionar filme
        $this->message->setMessage("negociacao adicionado com sucesso!", "success", "list_negociacao.php");
    }

    public function update(negociacao $negociacao) // ainda nao atualizado
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

        $stmt->bindParam(":dif_1", $negociacao->dif_1);
        $stmt->bindParam(":dif_2", $negociacao->dif_2);
        $stmt->bindParam(":dif_3", $negociacao->dif_3);
        $stmt->bindParam(":dif_total", $negociacao->dif_total);
        $stmt->bindParam(":fk_id_int", $negociacao->fk_id_int);
        $stmt->bindParam(":qtd_1", $negociacao->qtd_1);
        $stmt->bindParam(":qtd_2", $negociacao->qtd_2);
        $stmt->bindParam(":qtd_3", $negociacao->qtd_3);
        $stmt->bindParam(":troca_de_1", $negociacao->troca_de_1);
        $stmt->bindParam(":troca_de_2", $negociacao->troca_de_2);
        $stmt->bindParam(":troca_de_3", $negociacao->troca_de_3);
        $stmt->bindParam(":troca_para_1", $negociacao->troca_para_1);
        $stmt->bindParam(":troca_para_2", $negociacao->troca_para_2);
        $stmt->bindParam(":troca_para_3", $negociacao->troca_para_3);
        $stmt->bindParam(":valor_de_1", $negociacao->valor_de_1);
        $stmt->bindParam(":valor_de_2", $negociacao->valor_de_2);
        $stmt->bindParam(":valor_de_3", $negociacao->valor_de_3);
        $stmt->bindParam(":valor_para_1", $negociacao->valor_para_1);
        $stmt->bindParam(":valor_para_2", $negociacao->valor_para_2);
        $stmt->bindParam(":valor_para_3", $negociacao->valor_para_3);

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
        $query = $this->conn->query('SELECT 
        neg.id_negociacao,
        neg.dif_1, 
        neg.dif_2, 
        neg.dif_3, 
        neg.dif_total, 
        neg.fk_id_int, 
        neg.qtd_1, 
        neg.qtd_2, 
        neg.qtd_3, 
        neg.troca_de_1, 
        neg.troca_de_2, 
        neg.troca_de_3, 
        neg.troca_para_1, 
        neg.troca_para_2, 
        neg.troca_para_3, 
        neg.valor_de_1, 
        neg.valor_de_2, 
        neg.valor_de_3, 
        neg.valor_para_1, 
        neg.valor_para_2, 
        neg.valor_para_3
        pa.id_paciente,
        pa.nome_pac,
        ho.id_hospital, 
        ho.nome_hosp,
        ac.id_internacao,
        ac.internado_int,
        ac.fk_hospital_int,
        ac.data_intern_int,
        ac.fk_paciente_int
        
        FROM tb_negociacao neg 
    
            INNER JOIN tb_internacao AS ac ON
            neg.fk_id_int = ac.id_internacao
            
            INNER JOIN tb_hospital AS ho ON  
            ac.fk_hospital_int = ho.id_hospital
    
            INNER JOIN tb_paciente AS pa ON
            ac.fk_paciente_int = pa.id_paciente  ' . $where . ' ' . $order . ' ' . $limit);

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
