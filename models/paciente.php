<?php

class Paciente
{
  public $id_paciente;
  public $nome_pac;
  public $idade_pac;
  public $cidade_pac;
  public $endereco_pac;
  public $email01_pac;
  public $email02_pac;
  public $telefone01_pac;
  public $telefone02_pac;
  public $numero_pac;
  public $bairro_pac;
  public $cpf_pac;
  public $mae_pac;
  public $ativo_pac;
  public $sexo_pac;
  public $data_create_pac;
  public $usuario_create_pac;
}

interface PacienteDAOInterface
{

  public function buildPaciente($paciente);
  public function findAll();
  public function findById($id_paciente);
  public function findByPac($pesquisa_nome, $limite, $inicio);
  public function create(Paciente $paciente);
  public function update(Paciente $paciente);
  public function destroy($id_paciente);
  public function findGeral();

  public function selectAllPaciente($where = null, $order = null, $limit = null);
  public function QtdPaciente();
};
