<?php

require_once("./models/internacao.php");
require_once("./models/message.php");

// Review DAO
// require_once("dao/internacaoDao.php");


class InternacaoDao implements InternacaoDAOInterface
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

    public function buildinternacao($data)
    {
        $internacao = new Internacao();

        $internacao->id_internacao = $data['id_internacao'];
        $internacao->fk_hospital_int = $data["fk_hospital_int"];
        $internacao->fk_paciente_int = $data["fk_paciente_int"];
        $internacao->acoes_int = $data["acoes_int"];
        $internacao->fk_patologia_int = $data["fk_patologia_int"];
        $internacao->fk_patologia2 = $data["fk_patologia2"];
        $internacao->acomodacao_int = $data["acomodacao_int"];
        $internacao->modo_internacao_int = $data["modo_internacao_int"];
        $internacao->tipo_admissao_int = $data["tipo_admissao_int"];
        $internacao->data_intern_int = $data["data_intern_int"];
        $internacao->data_visita_int = $data["data_visita_int"];
        $internacao->data_create_int = $internacao["data_create_int"];
        $internacao->usuario_create_int = $internacao["usuario_create_int"];
        $internacao->titular_int = $data["titular_int"];
        $internacao->especialidade_int = $data["especialidade_int"];
        $internacao->grupo_patologia_int = $data["grupo_patologia_int"];
        $internacao->internado_int = $data["internado_int"];
        $internacao->rel_int = $data['rel_int'];

        return $internacao;
    }

    // mostrar acomocacao por id_internacao

    public function create(internacao $internacao)
    {
        $stmt = $this->conn->prepare("INSERT INTO tb_internacao (
         fk_hospital_int, 
         rel_int, 
         fk_paciente_int, 
         fk_patologia_int, 
         fk_patologia2, 
         data_intern_int, 
         internado_int, 
         modo_internacao_int, 
         tipo_admissao_int, 
         acoes_int, 
         titular_int, 
         data_visita_int, 
         grupo_patologia_int,
         data_create_int,
         usuario_create_int,
         especialidade_int

      ) VALUES (
        :fk_hospital_int, 
        :rel_int, 
        :fk_paciente_int,
        :fk_patologia_int, 
        :fk_patologia2, 
        :data_intern_int, 
        :internado_int, 
        :modo_internacao_int, 
        :tipo_admissao_int, 
        :acoes_int, 
        :titular_int, 
        :data_visita_int, 
        :grupo_patologia_int,
        :data_create_int,
        :usuario_create_int,
        :especialidade_int
     )");

        $stmt->bindParam(":fk_hospital_int", $internacao->fk_hospital_int);
        $stmt->bindParam(":fk_paciente_int", $internacao->fk_paciente_int);
        $stmt->bindParam(":rel_int", $internacao->rel_int);
        $stmt->bindParam(":fk_patologia_int", $internacao->fk_patologia_int);
        $stmt->bindParam(":fk_patologia2", $internacao->fk_patologia_int);
        $stmt->bindParam(":data_intern_int", $internacao->data_intern_int);
        $stmt->bindParam(":internado_int", $internacao->internado_int);
        $stmt->bindParam(":acoes_int", $internacao->acoes_int);
        $stmt->bindParam(":modo_internacao_int", $internacao->modo_internacao_int);
        $stmt->bindParam(":tipo_admissao_int", $internacao->tipo_admissao_int);
        $stmt->bindParam(":especialidade_int", $internacao->especialidade_int);
        $stmt->bindParam(":data_create_int", $internacao->data_create_int);
        $stmt->bindParam(":usuario_create_int", $internacao->usuario_create_int);
        $stmt->bindParam(":data_visita_int", $internacao->data_visita_int);
        $stmt->bindParam(":grupo_patologia_int", $internacao->grupo_patologia_int);
        $stmt->bindParam(":titular_int", $internacao->titular_int);

        $stmt->execute();
    }

    public function findGeral()
    {

        $internacao = [];

        $stmt = $this->conn->query("SELECT * FROM tb_internacao ORDER BY id_internacao asc");

        $stmt->execute();

        $internacao = $stmt->fetchAll();

        return $internacao;
    }

    public function findById($id_internacao)
    {
        $internacao = [];
        $stmt = $this->conn->prepare("SELECT 
        ac.id_internacao, 
        ac.acoes_int, 
        ac.data_intern_int, 
        ac.rel_int, 
        ac.fk_paciente_int, 
        ac.usuario_create_int, 
        ac.fk_hospital_int, 
        ac.modo_internacao_int, 
        ac.tipo_admissao_int,
        ac.especialidade_int, 
        ac.titular_int, 
        ac.grupo_patologia_int, 
        ac.acomodacao_int, 
        ac.fk_patologia_int, 
        ac.fk_patologia2, 
        ac.internado_int,
        pa.id_paciente,
        pa.nome_pac,
        ho.id_hospital, 
        ho.nome_hosp,
        pat.patologia_pat 

        FROM tb_internacao ac 

        iNNER JOIN tb_hospital as ho On  
        ac.fk_hospital_int = ho.id_hospital

        left join tb_paciente as pa on
        ac.fk_paciente_int = pa.id_paciente

        left join tb_patologia as pat on
        ac.fk_patologia_int = pat.id_patologia

        WHERE id_internacao = :id_internacao
        ");

        $stmt->bindParam(":id_internacao", $id_internacao);
        $stmt->execute();

        $data = $stmt->fetch();
        $internacao = $this->buildinternacao($data);

        return $internacao;
    }
    // PESQUISAR INTERNACAO POR HOSPITAL
    public function findInternByInternado($where, $ativo, $limite, $inicio)
    {

        $stmt = $this->conn->query("SELECT 
        ac.id_internacao, 
        ac.acoes_int, 
        ac.data_intern_int, 
        ac.data_visita_int, 
        ac.rel_int, 
        ac.fk_paciente_int, 
        ac.usuario_create_int, 
        ac.fk_hospital_int, 
        ac.modo_internacao_int, 
        ac.tipo_admissao_int,
        ac.especialidade_int, 
        ac.titular_int, 
        ac.grupo_patologia_int, 
        ac.acomodacao_int, 
        ac.fk_patologia_int, 
        ac.fk_patologia2, 
        ac.internado_int,
        pa.id_paciente,
        pa.nome_pac,
        ho.id_hospital, 
        ho.nome_hosp

        FROM tb_internacao ac 

        iNNER JOIN tb_hospital as ho On  
        ac.fk_hospital_int = ho.id_hospital

        left join tb_paciente as pa on
        ac.fk_paciente_int = pa.id_paciente

        WHERE nome_hosp LIKE '$where' AND internado_int = '$ativo' LIMIT $limite ");

        $stmt->execute();

        $internacao = $stmt->fetchAll();

        return $internacao;
    }

    public function joininternacaoHospitalshow($id_internacao)

    {
        $stmt = $this->conn->query("SELECT ac.id_internacao, ac.acoes_int,  ac.internado_int, ac.fk_patologia_int, ac.data_intern_int, ac.rel_int, ac.fk_paciente_int, ac.acomodacao_int, pa.id_paciente, pa.nome_pac, ac.usuario_create_int, ac.fk_hospital_int, ac.modo_internacao_int, ac.tipo_admissao_int, ho.id_hospital, ho.nome_hosp, ac.especialidade_int, ac.titular_int, ac.data_visita_int, ac.grupo_patologia_int, ac.acomodacao_int, ac.fk_patologia_int, pat.patologia_pat
        FROM tb_internacao ac 

        iNNER JOIN tb_hospital as ho On  
        ac.fk_hospital_int = ho.id_hospital

        left join tb_paciente as pa on
        ac.fk_paciente_int = pa.id_paciente

        left join tb_patologia as pat on
        ac.fk_patologia_int = pat.id_patologia

        WHERE id_internacao = $id_internacao
         
         ");

        $stmt->execute();

        $internacao = $stmt->fetch();
        return $internacao;
    }

    public static function sellect()
    {
        $where = null;
        $order = null;
        $limite = null;
    }
}
