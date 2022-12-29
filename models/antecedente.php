<?php

class Antecedente
{
  public $id_antecedente;
  public $antecedenteNome;
}

interface antecedenteDAOInterface
{

  public function buildantecedente($antecedente);
  public function findAll();
  public function getantecedente();
  public function findById($id_antecedente);
  //public function findByTitle($title);
  public function create(antecedente $antecedente);
  public function update(antecedente $antecedente);
  public function destroy($id_antecedente);
  public function findGeral();
};
