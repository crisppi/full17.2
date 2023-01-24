<?php

class prorrogacao
{
  public $id_prorrogacao;
  public $acomod1_pror;
  public $acomod2_pror;
  public $acomod3_pror;
  public $isol_1_pror;
  public $isol_2_pror;
  public $isol_3_pror;
  public $data_fim_pror;
  public $data_ini_pror;
  public $fk_internacao_pror;
  public $fk_user_pror;
  public $prorrog1_fim_pror;
  public $prorrog1_ini_pror;
  public $prorrog2_fim_pror;
  public $prorrog2_ini_pror;
  public $prorrog3_fim_pror;
  public $prorrog3_ini_pror;
  public $prorrogacao_pror;
}

interface prorrogacaoDAOInterface
{

  public function buildprorrogacao($prorrogacao);
  public function findById($id_prorrogacao);
  public function findByIdUpdate($id_prorrogacao);
  public function create(prorrogacao $prorrogacao);
  public function update(prorrogacao $prorrogacao);
  public function destroy($id_prorrogacao);
  public function findGeral();
};
