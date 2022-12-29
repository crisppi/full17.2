<?php

class Acomodacao
{
  public $id_acomodacao;
  public $acomodacao_aco;
  public $valor_aco;
  public $fk_hospital;
  public $data_create;
  public $usuario_create;
}
interface acomodacaoDAOInterface
{

  public function buildacomodacao($acomodacao);
  public function findAll();
  public function getacomodacao();
  public function findById($id_acomodacao);
  public function findByIdUpdate($id_acomodacao);
  public function create(acomodacao $acomodacao);
  public function update($acomodacao);
  public function destroy($id_acomodacao);
  public function joinAcomodacaoHospital();
  public function joinAcomodacaoHospitalShow($id_acomodacao);
  public function findGeral();
};
