<?php

class hospitalUser
{
  public $id_hospitalUser;
  public $fk_usuario_hosp;
  public $fk_hospital_user;
}

interface hospitalUserDAOInterface
{

  public function buildhospitalUser($hospitalUser);
  public function findAll();
  public function gethospitalUser();
  public function findById($id_hospitalUser);
  public function findByHosp($pesquisa_nome);
  public function create(hospitalUser $hospitalUser);
  public function update(hospitalUser $hospitalUser);
  public function destroy($id_hospitalUser);
  public function findGeral();
  public function joinHospitalUser($where, $order, $obLimite);

  public function selectAllhospitalUser($where = null, $order = null, $limit = null);
  public function QtdhospitalUser();
};
