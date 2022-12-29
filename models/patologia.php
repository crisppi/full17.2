<?php

class Patologia
{
  public $id_patologia;
  public $patologia_pat;
  public $dias_pato;
}

interface patologiaDAOInterface
{

  public function buildpatologia($patologia);
  public function findAll();
  public function getpatologia();
  public function findById($id_patologia);
  //public function findByTitle($title);
  public function create(patologia $patologia);
  public function update(patologia $patologia);
  public function destroy($id_patologia);
  public function findGeral();
};
