<?php

class Paciente
{
  public $id_paciente;
  public $nome;
  public $idade;
  public $cidade;
  public $endereco;
  public $email01;
  public $email02;
  public $telefone01;
  public $telefone02;
  public $numero;
  public $bairro;
  public $cpf;
  public $mae;
  public $ativo;
  public $sexo;
  public $data_create;
  public $usuario_create;
}

interface PacienteDAOInterface
{

  public function buildPaciente($paciente);
  public function findAll();
  public function getPacientes();
  public function findById($id_paciente);
  //public function findByTitle($title);
  public function create(Paciente $paciente);
  public function update(Paciente $paciente);
  public function destroy($id_paciente);
  public function findGeral();
};
