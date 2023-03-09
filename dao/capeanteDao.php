<?php

require_once("./models/capeante.php");
require_once("./models/message.php");

// Review DAO

class capeanteDAO implements capeanteDAOInterface
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

    public function buildcapeante($data)
    {
        $capeante = new capeante();

        $capeante->id_capeante = $data["id_capeante"];
        $capeante->adm_capeante = $data["adm_capeante"];
        $capeante->adm_check = $data["adm_check"];
        $capeante->aud_enf_capeante = $data["aud_enf_capeante"];
        $capeante->aud_med_capeante = $data["aud_med_capeante"];
        $capeante->data_fech_capeante = $data["data_fech_capeante"];
        $capeante->data_final_conta = $data["data_final_conta"];
        $capeante->data_inicial_capeante = $data["data_inicial_capeante"];
        $capeante->diarias_capeante = $data["diarias_capeante"];
        $capeante->glosa_diaria = $data["glosa_diaria"];
        $capeante->glosa_honorarios = $data["glosa_honorarios"];
        $capeante->glosa_matmed = $data["glosa_matmed"];
        $capeante->glosa_oxig = $data["glosa_oxig"];
        $capeante->glosa_sadt = $data["glosa_sadt"];
        $capeante->glosa_taxas = $data["glosa_taxas"];
        $capeante->med_check = $data["med_check"];
        $capeante->enfer_check = $data["enfer_check"];
        $capeante->pacote = $data["pacote"];
        $capeante->parcial_capeante = $data["parcial_capeante"];
        $capeante->parcial_num = $data["parcial_num"];
        $capeante->fk_int_capeante = $data["fk_int_capeante"];
        $capeante->valor_apresentado_capeante = $data["valor_apresentado_capeante"];
        $capeante->valor_diarias = $data["valor_diarias"];
        $capeante->valor_final_capeante = $data["valor_final_capeante"];
        $capeante->valor_glosa_enf = $data["valor_glosa_enf"];
        $capeante->valor_glosa_med = $data["valor_glosa_med"];
        $capeante->valor_glosa_total = $data["valor_glosa_total"];
        $capeante->valor_honorarios = $data["valor_honorarios"];
        $capeante->valor_matmed = $data["valor_matmed"];
        $capeante->valor_oxig = $data["valor_oxig"];
        $capeante->valor_sadt = $data["valor_sadt"];
        $capeante->valor_taxa = $data["valor_taxa"];

        return $capeante;
    }

    public function findAll()
    {
        $capeante = [];

        $stmt = $this->conn->prepare("SELECT * FROM tb_capeante
        ORDER BY id_capeante asc");

        $stmt->execute();

        $capeante = $stmt->fetchAll();
        return $capeante;
    }

    public function getcapeantesBynome_pac($nome_pac)
    {
        $capeantes = [];

        $stmt = $this->conn->prepare("SELECT * FROM tb_capeante
                                    WHERE nome_pac = :nome_pac
                                    ORDER BY id_capeante asc");

        $stmt->bindParam(":nome_pac", $nome_pac);
        $stmt->execute();
        $capeantesArray = $stmt->fetchAll();
        foreach ($capeantesArray as $capeante) {
            $capeantes[] = $this->buildcapeante($capeante);
        }
        return $capeantes;
    }

    public function findById($id_capeante)
    {
        $capeante = [];
        $stmt = $this->conn->prepare("SELECT * FROM tb_capeante
                                    WHERE id_capeante = :id_capeante");
        $stmt->bindParam(":id_capeante", $id_capeante);
        $stmt->execute();

        $data = $stmt->fetch();
        // var_dump($data);
        $capeante = $this->buildcapeante($data);

        return $capeante;
    }

    public function findByPac($pesquisa_nome, $limite, $inicio)
    {
        $capeante = [];

        $stmt = $this->conn->prepare("SELECT * FROM tb_capeante
                                    WHERE nome_pac LIKE :nome_pac order by nome_pac asc limite $inicio, $limite");

        $stmt->bindValue(":nome_pac", '%' . $pesquisa_nome . '%');

        $stmt->execute();

        $capeante = $stmt->fetchAll();
        return $capeante;
    }

    public function create(capeante $capeante)
    {

        $stmt = $this->conn->prepare("INSERT INTO tb_capeante (
       
        adm_capeante, 
        adm_check, 
        aud_enf_capeante, 
        aud_med_capeante, 
        data_fech_capeante, 
        data_final_conta, 
        data_inicial_capeante, 
        diarias_capeante, 
        glosa_diaria, 
        glosa_honorarios, 
        glosa_matmed, 
        glosa_oxig, 
        glosa_sadt, 
        glosa_taxas, 
        med_check,
        enfer_check,
        pacote,
        parcial_capeante,
        parcial_num,
        fk_int_capeante,
        valor_apresentado_capeante,
        valor_diarias,
        valor_final_capeante,
        valor_glosa_enf,
        valor_glosa_med,
        valor_glosa_total,
        valor_honorarios,
        valor_matmed,
        valor_oxig,
        valor_sadt,
        valor_taxa

      ) VALUES (
        :adm_capeante, 
        :adm_check, 
        :aud_enf_capeante, 
        :aud_med_capeante, 
        :data_fech_capeante, 
        :data_final_conta, 
        :data_inicial_capeante, 
        :diarias_capeante, 
        :glosa_diaria, 
        :glosa_honorarios, 
        :glosa_matmed, 
        :glosa_oxig, 
        :glosa_sadt, 
        :glosa_taxas, 
        :med_check,
        :enfer_check,
        :pacote,
        :parcial_capeante,
        :parcial_num,
        :fk_int_capeante,
        :valor_apresentado_capeante,
        :valor_diarias,
        :valor_final_capeante,
        :valor_glosa_enf,
        :valor_glosa_med,
        :valor_glosa_total,
        :valor_honorarios,
        :valor_matmed,
        :valor_oxig,
        :valor_sadt,
        :valor_taxa

     )");

        $stmt->bindParam(":adm_capeante", $capeante->adm_capeante);
        $stmt->bindParam(":adm_check", $capeante->adm_check);
        $stmt->bindParam(":aud_enf_capeante", $capeante->aud_enf_capeante);
        $stmt->bindParam(":aud_med_capeante", $capeante->aud_med_capeante);
        $stmt->bindParam(":data_fech_capeante", $capeante->data_fech_capeante);
        $stmt->bindParam(":data_final_conta", $capeante->data_final_conta);
        $stmt->bindParam(":data_inicial_capeante", $capeante->data_inicial_capeante);
        $stmt->bindParam(":diarias_capeante", $capeante->diarias_capeante);
        $stmt->bindParam(":glosa_diaria", $capeante->glosa_diaria);
        $stmt->bindParam(":glosa_honorarios", $capeante->glosa_honorarios);
        $stmt->bindParam(":glosa_matmed", $capeante->glosa_matmed);
        $stmt->bindParam(":glosa_oxig", $capeante->glosa_oxig);
        $stmt->bindParam(":glosa_sadt", $capeante->glosa_sadt);
        $stmt->bindParam(":glosa_taxas", $capeante->glosa_taxas);
        $stmt->bindParam(":med_check", $capeante->med_check);
        $stmt->bindParam(":enfer_check", $capeante->enfer_check);
        $stmt->bindParam(":pacote", $capeante->pacote);
        $stmt->bindParam(":parcial_capeante", $capeante->parcial_capeante);
        $stmt->bindParam(":parcial_num", $capeante->parcial_num);
        $stmt->bindParam(":fk_int_capeante", $capeante->fk_int_capeante);
        $stmt->bindParam(":valor_apresentado_capeante", $capeante->valor_apresentado_capeante);
        $stmt->bindParam(":valor_diarias", $capeante->valor_diarias);
        $stmt->bindParam(":valor_final_capeante", $capeante->valor_final_capeante);
        $stmt->bindParam(":valor_glosa_enf", $capeante->valor_glosa_enf);
        $stmt->bindParam(":valor_glosa_med", $capeante->valor_glosa_med);
        $stmt->bindParam(":valor_glosa_total", $capeante->valor_glosa_total);
        $stmt->bindParam(":valor_honorarios", $capeante->valor_honorarios);
        $stmt->bindParam(":valor_matmed", $capeante->valor_matmed);
        $stmt->bindParam(":valor_oxig", $capeante->valor_oxig);
        $stmt->bindParam(":valor_sadt", $capeante->valor_sadt);
        $stmt->bindParam(":valor_taxa", $capeante->valor_taxa);

        $stmt->execute();

        // Mensagem de sucesso por adicionar filme
        $this->message->setMessage("capeante adicionado com sucesso!", "success", "cad_capeante.php");
    }

    // public function update(capeante $capeante)
    // {

    //     $stmt = $this->conn->prepare("UPDATE tb_capeante SET
    //     nome_pac = :nome_pac,
    //     endereco_pac = :endereco_pac,
    //     email01_pac = :email01_pac,
    //     email02_pac = :email02_pac,
    //     idade_pac = :idade_pac,
    //     sexo_pac = :sexo_pac,
    //     cpf_pac = :cpf_pac,
    //     numero_pac = :numero_pac,
    //     telefone01_pac = :telefone01_pac,
    //     telefone02_pac = :telefone02_pac,
    //     cidade_pac = :cidade_pac,
    //     bairro_pac = :bairro_pac,
    //     mae_pac = :mae_pac,
    //     ativo_pac = :ativo_pac,
    //     usuario_create_pac = :usuario_create_pac,
    //     data_create_pac = :data_create_pac

    //     WHERE id_capeante = :id_capeante 
    //   ");

    //     $stmt->bindParam(":nome_pac", $capeante->nome_pac);
    //     $stmt->bindParam(":endereco_pac", $capeante->endereco_pac);
    //     $stmt->bindParam(":email01_pac", $capeante->email01_pac);
    //     $stmt->bindParam(":email02_pac", $capeante->email02_pac);
    //     $stmt->bindParam(":idade_pac", $capeante->idade_pac);
    //     $stmt->bindParam(":cpf_pac", $capeante->cpf_pac);
    //     $stmt->bindParam(":sexo_pac", $capeante->sexo_pac);
    //     $stmt->bindParam(":numero_pac", $capeante->numero_pac);
    //     $stmt->bindParam(":telefone01_pac", $capeante->telefone01_pac);
    //     $stmt->bindParam(":telefone02_pac", $capeante->telefone02_pac);
    //     $stmt->bindParam(":cidade_pac", $capeante->cidade_pac);
    //     $stmt->bindParam(":bairro_pac", $capeante->bairro_pac);
    //     $stmt->bindParam(":mae_pac", $capeante->mae_pac);
    //     $stmt->bindParam(":ativo_pac", $capeante->ativo_pac);
    //     $stmt->bindParam(":usuario_create_pac", $capeante->usuario_create_pac);
    //     $stmt->bindParam(":data_create_pac", $capeante->data_create_pac);

    //     $stmt->bindParam(":id_capeante", $capeante->id_capeante);
    //     $stmt->execute();

    //     // Mensagem de sucesso por editar capeante
    //     $this->message->setMessage("capeante atualizado com sucesso!", "success", "list_capeante.php");
    // }

    public function destroy($id_capeante)
    {
        $stmt = $this->conn->prepare("DELETE FROM tb_capeante WHERE id_capeante = $id_capeante");

        // $stmt->bindParam(":id_capeante", $id_capeante);

        $stmt->execute();

        // Mensagem de sucesso por remover filme
        $this->message->setMessage("capeante removido com sucesso!", "success", "list_capeante.php");
    }


    public function findGeral()
    {

        $capeantes = [];

        $stmt = $this->conn->query("SELECT * FROM tb_capeante ORDER BY id_capeante");

        $stmt->execute();

        $capeantes = $stmt->fetchAll();

        return $capeantes;
    }
    public function selectAllcapeante($where = null, $order = null, $limite = null)
    {
        //DADOS DA QUERY
        $where = strlen($where) ? 'WHERE ' . $where : '';
        $order = strlen($order) ? 'ORDER BY ' . $order : '';
        $limite = strlen($limite) ? 'LIMIT ' . $limite : '';

        //MONTA A QUERY
        $query = $this->conn->query('SELECT SELECT SELECT ac.id_internacao, 
        ac.acoes_int, 
        ac.data_intern_int, 
        ac.data_visita_int, 
        ac.fk_paciente_int, 
        ac.usuario_create_int, 
        ac.fk_hospital_int, 
        ac.modo_internacao_int, 
        ac.tipo_admissao_int,
        ac.tipo_alta_int,
        ac.internado_uti_int,
        ac.internacao_uti_int,
        ac.especialidade_int, 
        ac.titular_int, 
        ac.grupo_patologia_int, 
        ac.acomodacao_int, 
        ac.fk_patologia_int, 
        ac.fk_patologia2, 
        ac.internado_int,
        ac.visita_no_int,
        ac.primeira_vis_int,
        pa.id_paciente,
        pa.nome_pac,
        ho.id_hospital, 
        ho.nome_hosp,
        cp.fk_int_capeante,
        cp.id_capeante
    
        FROM tb_capeante cp
    
			inner JOIN tb_internacao as ac On  
            cp.fk_int_capeante = ac.id_internacao
    
            left JOIN tb_hospital as ho On  
            ac.fk_hospital_int = ho.id_hospital
    
            
            left join tb_paciente as pa on
            ac.fk_paciente_int = pa.id_paciente  

            ' . $where . ' ' . $order . ' ' . $limite);

        $query->execute();

        $capeante = $query->fetchAll();

        return $capeante;
    }

    public function Qtdcapeante($where = null, $order = null, $limite = null)
    {
        $capeante = [];
        $internacao = [];
        //DADOS DA QUERY
        $where = strlen($where) ? 'WHERE ' . $where : '';
        $order = strlen($order) ? 'ORDER BY ' . $order : '';
        $limite = strlen($limite) ? 'LIMIT ' . $limite : '';

        $stmt = $this->conn->query('SELECT * ,COUNT(id_capeante) as qtd FROM tb_capeante ' . $where . ' ' . $order . ' ' . $limite);

        $stmt->execute();

        $QtdTotalPac = $stmt->fetch();

        return $QtdTotalPac;
    }
}
