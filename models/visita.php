<?php

class visita
{
  public $id_visita;
  public $visitaNome;
  public $valor_diaria;
  public $fk_hospital;
  public $data_create;
  public $usuario_create;
  public $rel_visita_vis;
  public $acoes_int_vis;
  public $fk_internacao_vis;
  public $fk_usuario_vis;
}

interface visitaDAOInterface
{

  public function buildvisita($visita);
  public function findAll();
  public function getvisita();
  public function findById($id_visita);
  public function findByIdUpdate($id_visita);
  public function create(visita $visita);
  public function update($visita);
  public function destroy($id_visita);
  public function joinvisitaHospital();
  public function joinvisitaHospitalShow($id_visita);
  public function findGeral();
};
