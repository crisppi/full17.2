<?php

class negociacao
{
  public $id_negociacao;
  public $dif_1;
  public $dif_2;
  public $dif_3;
  public $dif_total;
  public $fk_id_int;
  public $qtd_1;
  public $qtd_2;
  public $qtd_3;
  public $troca_de_1;
  public $troca_de_2;
  public $troca_de_3;
  public $troca_para_1;
  public $troca_para_2;
  public $troca_para_3;
  public $valor_de_1;
  public $valor_de_2;
  public $valor_de_3;
  public $valor_para_1;
  public $valor_para_2;
  public $valor_para_3;
  public $fk_usuario_neg;
}

interface negociacaoDAOInterface
{

  public function buildnegociacao($negociacao);
  public function findById($id_negociacao);
  public function create(negociacao $negociacao);
  public function update(negociacao $negociacao);
  public function destroy($id_negociacao);
  public function findGeral();
  public function findByLastId($lastId);
};
