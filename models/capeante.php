<?php

class capeante
{
  public $adm_capeante;
  public $adm_check;
  public $aud_enf_capeante;
  public $aud_med_capeante;
  public $data_fech_capeante;
  public $data_final_conta;
  public $data_inicial_capeante;
  public $diarias_capeante;
  public $enfer_check;
  public $exchangerate;
  public $glosa_diaria;
  public $glosa_honorarios;
  public $glosa_matmed;
  public $glosa_oxig;
  public $glosa_sadt;
  public $glosa_taxas;
  public $hospital_capeante;
  public $id_capeante;
  public $med_check;
  public $pac_capeante;
  public $pacote;
  public $parcial_capeante;
  public $parcial_num;
  public $fk_int_capeante;
  public $valor_apresentado_capeante;
  public $valor_diarias;
  public $valor_final_capeante;
  public $valor_glosa_enf;
  public $valor_glosa_med;
  public $valor_glosa_total;
  public $valor_honorarios;
  public $valor_matmed;
  public $valor_oxig;
  public $valor_sadt;
  public $valor_taxa;
}

interface capeanteDAOInterface
{

  public function buildcapeante($capeante);
  public function findAll();
  public function findById($id_capeante);
  public function findByPac($pesquisa_nome, $limite, $inicio);
  public function create(capeante $capeante);
  // public function update(capeante $capeante);
  public function destroy($id_capeante);
  public function findGeral();

  public function selectAllcapeante($where = null, $order = null, $limit = null);
  public function Qtdcapeante();
};
