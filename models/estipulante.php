<?php

class Estipulante
{
  public $id_estipulante;
  public $estipulanteNome;
  public $cidade;
  public $endereco;
  public $email01;
  public $email02;
  public $telefone01;
  public $telefone02;
  public $numero;
  public $bairro;
  public $cnpj;
  public $ativo;
  public $coordMedico;
  public $emailCoordMedico;
  public $coordFat;
  public $email_coordFat;
  public $data_create;
  public $usuario_create;
}

interface EstipulanteDAOInterface
{

  public function buildEstipulante($estipulante);
  public function findAll();
  public function getestipulante();
  public function findById($id_estipulante);
  //public function findByTitle($title);
  public function create(Estipulante $estipulante);
  public function update(Estipulante $estipulante);
  public function destroy($id_estipulante);
  public function findGeral();
};
