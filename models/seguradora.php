<?php

class Seguradora
{
  public $id_seguradora;
  public $seguradoraNome;
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

interface seguradoraDAOInterface
{

  public function buildseguradora($seguradora);
  public function findAll();
  public function getseguradora();
  public function findById($id_seguradora);
  //public function findByTitle($title);
  public function create(seguradora $seguradora);
  public function update(seguradora $seguradora);
  public function destroy($id_seguradora);
  public function findGeral();
};
