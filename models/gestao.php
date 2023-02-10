<?php

class gestao
{
  public $id_gestao;
  public $alto_custo_ges;
  public $rel_alto_custo_ges;
  public $evento_adverso_ges;
  public $rel_evento_adverso_ges;
  public $tipo_evento_adverso_gest;
  public $opme_ges;
  public $rel_opme_ges;
  public $home_care_ges;
  public $rel_home_care_ges;
  public $desospitalizacao_ges;
  public $rel_desospitalizacao_ges;
  public $fk_user_ges;
  public $fk_visita_ges;
  public $fk_internacao_ges;
}

interface gestaoDAOInterface
{

  public function buildgestao($gestao);
  public function findAll();
  public function getgestao();
  public function findById($id_gestao);
  public function findByIdUpdate($id_gestao);
  public function create(gestao $gestao);
  public function update(gestao $gestao);
  public function destroy($id_gestao);
  public function findGeral();
  public function selectAllGestao($where = null, $order = null, $limit = null);
};
