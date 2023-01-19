<?php

require_once("./models/paciente.php");
require_once("./models/message.php");

// Review DAO

class PacienteDAO implements PacienteDAOInterface
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

    public function buildPaciente($data)
    {
        $paciente = new Paciente();

        $paciente->id_paciente = $data["id_paciente"];
        $paciente->nome_pac = $data["nome_pac"];
        $paciente->endereco_pac = $data["endereco_pac"];
        $paciente->sexo_pac = $data["sexo_pac"];
        $paciente->idade_pac = $data["idade_pac"];
        $paciente->cidade_pac = $data["cidade_pac"];
        $paciente->cpf_pac = $data["cpf_pac"];
        $paciente->telefone01_pac = $data["telefone01_pac"];
        $paciente->email01_pac = $data["email01_pac"];
        $paciente->email02_pac = $data["email02_pac"];
        $paciente->telefone02_pac = $data["telefone02_pac"];
        $paciente->numero_pac = $data["numero_pac"];
        $paciente->bairro_pac = $data["bairro_pac"];
        $paciente->ativo_pac = $data["ativo_pac"];
        $paciente->mae_pac = $data["mae_pac"];
        $paciente->data_create_pac = $data["data_create_pac"];
        $paciente->usuario_create_pac = $data["usuario_create_pac"];


        return $paciente;
    }

    public function findAll()
    {
        $paciente = [];

        $stmt = $this->conn->prepare("SELECT * FROM tb_paciente
        ORDER BY id_paciente asc");

        $stmt->execute();

        $paciente = $stmt->fetchAll();
        return $paciente;
    }

    public function getpacientesBynome_pac($nome_pac)
    {
        $pacientes = [];

        $stmt = $this->conn->prepare("SELECT * FROM tb_paciente
                                    WHERE nome_pac = :nome_pac
                                    ORDER BY id_paciente asc");

        $stmt->bindParam(":nome_pac", $nome_pac);
        $stmt->execute();
        $pacientesArray = $stmt->fetchAll();
        foreach ($pacientesArray as $paciente) {
            $pacientes[] = $this->buildpaciente($paciente);
        }
        return $pacientes;
    }

    public function findById($id_paciente)
    {
        $paciente = [];
        $stmt = $this->conn->prepare("SELECT * FROM tb_paciente
                                    WHERE id_paciente = :id_paciente");
        $stmt->bindParam(":id_paciente", $id_paciente);
        $stmt->execute();

        $data = $stmt->fetch();
        //var_dump($data);
        $paciente = $this->buildPaciente($data);

        return $paciente;
    }

    public function findByPac($pesquisa_nome)
    {
        $paciente = [];

        $stmt = $this->conn->prepare("SELECT * FROM tb_paciente
                                    WHERE nome_pac LIKE :nome_pac ");

        $stmt->bindValue(":nome_pac", '%' . $pesquisa_nome . '%');

        $stmt->execute();

        $paciente = $stmt->fetchAll();
        return $paciente;
    }

    public function create(Paciente $paciente)
    {

        $stmt = $this->conn->prepare("INSERT INTO tb_paciente (
        nome_pac, 
        endereco_pac, 
        bairro_pac, 
        email01_pac, idade_pac, 
        sexo_pac, 
        cpf_pac, 
        email02_pac, 
        telefone01_pac, 
        telefone02_pac, 
        numero_pac, 
        mae_pac, 
        cidade_pac, 
        ativo_pac, 
        data_create_pac, 
        usuario_create_pac
      ) VALUES (
        :nome_pac, 
        :endereco_pac, 
        :bairro_pac, 
        :email01_pac, 
        :idade_pac, 
        :sexo_pac, 
        :cpf_pac, 
        :email02_pac, 
        :telefone01_pac, 
        :telefone02_pac, 
        :numero_pac, 
        :mae_pac, 
        :cidade_pac, 
        :ativo_pac, 
        :data_create_pac, 
        :usuario_create_pac
     )");

        $stmt->bindParam(":nome_pac", $paciente->nome_pac);
        $stmt->bindParam(":endereco_pac", $paciente->endereco_pac);
        $stmt->bindParam(":bairro_pac", $paciente->bairro_pac);
        $stmt->bindParam(":email01_pac", $paciente->email01_pac);
        $stmt->bindParam(":idade_pac", $paciente->idade_pac);
        $stmt->bindParam(":sexo_pac", $paciente->sexo_pac);
        $stmt->bindParam(":cpf_pac", $paciente->cpf_pac);
        $stmt->bindParam(":email02_pac", $paciente->email02_pac);
        $stmt->bindParam(":telefone01_pac", $paciente->telefone01_pac);
        $stmt->bindParam(":telefone02_pac", $paciente->telefone02_pac);
        $stmt->bindParam(":numero_pac", $paciente->numero_pac);
        $stmt->bindParam(":mae_pac", $paciente->mae_pac);
        $stmt->bindParam(":cidade_pac", $paciente->cidade_pac);
        $stmt->bindParam(":ativo_pac", $paciente->ativo_pac);
        $stmt->bindParam(":data_create_pac", $paciente->data_create_pac);
        $stmt->bindParam(":usuario_create_pac", $paciente->usuario_create_pac);


        $stmt->execute();

        // Mensagem de sucesso por adicionar filme
        $this->message->setMessage("Paciente adicionado com sucesso!", "success", "list_paciente.php");
    }

    public function update(Paciente $paciente)
    {

        $stmt = $this->conn->prepare("UPDATE tb_paciente SET
        nome_pac = :nome_pac,
        endereco_pac = :endereco_pac,
        email01_pac = :email01_pac,
        email02_pac = :email02_pac,
        idade_pac = :idade_pac,
        sexo_pac = :sexo_pac,
        cpf_pac = :cpf_pac,
        numero_pac = :numero_pac,
        telefone01_pac = :telefone01_pac,
        telefone02_pac = :telefone02_pac,
        cidade_pac = :cidade_pac,
        bairro_pac = :bairro_pac,
        mae_pac = :mae_pac,
        ativo_pac = :ativo_pac

        WHERE id_paciente = :id_paciente 
      ");

        $stmt->bindParam(":nome_pac", $paciente->nome_pac);
        $stmt->bindParam(":endereco_pac", $paciente->endereco_pac);
        $stmt->bindParam(":email01_pac", $paciente->email01_pac);
        $stmt->bindParam(":email02_pac", $paciente->email02_pac);
        $stmt->bindParam(":idade_pac", $paciente->idade_pac);
        $stmt->bindParam(":cpf_pac", $paciente->cpf_pac);
        $stmt->bindParam(":sexo_pac", $paciente->sexo_pac);
        $stmt->bindParam(":numero_pac", $paciente->numero_pac);
        $stmt->bindParam(":telefone01_pac", $paciente->telefone01_pac);
        $stmt->bindParam(":telefone02_pac", $paciente->telefone02_pac);
        $stmt->bindParam(":cidade_pac", $paciente->cidade_pac);
        $stmt->bindParam(":bairro_pac", $paciente->bairro_pac);
        $stmt->bindParam(":mae_pac", $paciente->mae_pac);
        $stmt->bindParam(":ativo_pac", $paciente->ativo_pac);

        $stmt->bindParam(":id_paciente", $paciente->id_paciente);
        $stmt->execute();

        // Mensagem de sucesso por editar paciente
        $this->message->setMessage("Paciente atualizado com sucesso!", "success", "list_paciente.php");
    }

    public function destroy($id_paciente)
    {
        $stmt = $this->conn->prepare("DELETE FROM tb_paciente WHERE id_paciente = :id_paciente");

        $stmt->bindParam(":id_paciente", $id_paciente);

        $stmt->execute();

        // Mensagem de sucesso por remover filme
        $this->message->setMessage("Paciente removido com sucesso!", "success", "list_paciente.php");
    }


    public function findGeral()
    {

        $pacientes = [];

        $stmt = $this->conn->query("SELECT * FROM tb_paciente ORDER BY id_paciente asc");

        $stmt->execute();

        $pacientes = $stmt->fetchAll();

        return $pacientes;
    }
}



# Limita o número de registros a serem mostrados por página
$limite = 10;

# Se pg não existe atribui 1 a variável pg
$pg = (isset($_GET['pg'])) ? (int)$_GET['pg'] : 1;

# Atribui a variável inicio o inicio de onde os registros vão ser
# mostrados por página, exemplo 0 à 10, 11 à 20 e assim por diante
$inicio = ($pg * $limite) - $limite;
$pesquisa_pac = "";
# seleciona o total de registros  
$sql_Total = 'SELECT id_paciente FROM tb_paciente';
