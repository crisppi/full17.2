<?php

class Seguradora
{
  public $id_seguradora;
  public $seguradora_seg;
  public $cidade_seg;
  public $endereco_seg;
  public $email01_seg;
  public $email02_seg;
  public $telefone01_seg;
  public $telefone02_seg;
  public $numero_seg;
  public $bairro_seg;
  public $cnpj_seg;
  public $ativo_seg;
  public $coordMedico_seg;
  public $emailCoordMedico_seg;
  public $coordFat_seg;
  public $email_coordFat_seg;
  public $data_create_seg;
  public $usuario_create_seg;
}

interface seguradoraDAOInterface
{

  public function buildseguradora($seguradora);
  public function findAll();
  public function getseguradora();
  public function findById($id_seguradora);
  public function findBySeguradora($pesquisa_nome);
  public function create(seguradora $seguradora);
  public function update(seguradora $seguradora);
  public function destroy($id_seguradora);
  public function findGeral();

  public function selectAllSeguradora($where = null, $order = null, $limit = null);
  public function QtdSeguradora($where);
};
