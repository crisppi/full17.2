<?php

class Antecedente
{
  public $id_antecedente;
  public $antecedente_ant;
}

interface antecedenteDAOInterface
{

  public function buildantecedente($antecedente);
  public function findAll();
  public function findById($id_antecedente);
  public function create(antecedente $antecedente);
  public function update(antecedente $antecedente);
  public function destroy($id_antecedente);
  public function findGeral();
  public function selectAllAntecedente($where = null, $order = null, $limit = null);
  public function QtdAntecedente();
};
