<?php

class Internacao
{
  public $id_internacao;
  public $rel_auditoria_int;
  public $fk_paciente_int;
  public $fk_hospital_int;
  public $data_create_int;
  public $usuario_create_int;
  public $acoes_int;
  public $acomodacao_int;
  public $auditor_int;
  public $conta_finalizada_int;
  public $conta_paga_int;
  public $covid_int;
  public $fk_gestao_int;
  public $data_alta_int;
  public $data_intern_int;
  public $data_visita_int;
  public $especialidade_int;
  public $fk_antecedente_int;
  public $fk_capeante_int;
  public $fk_patologia_int;
  public $fk_patologia2;
  public $fk_user_int;
  public $fk_uti;
  public $grupo_patologia_int;
  public $hospital_int;
  public $internacao_ativa_int;
  public $internacao_uti_int;
  public $internado_int;
  public $internado_uti_int;
  public $isolamento_int;
  public $tipo_admissao_int;
  public $no_visita_int;
  public $obito_int;
  public $paciente_int;
  public $patologia_int;
  public $patologia2_int;
  public $primeira_visita_int;
  public $senha_int;
  public $rel_int;
  public $tipo_alta_int;
  public $modo_internacao_int;
  public $titular_int;
  public $fk_negociacoes_int;
}

interface InternacaoDAOInterface
{
  public function findGeral();
  public function create(internacao $internacao);
  public function findById($id_internacao);

  public function findInternByInternado($where, $ativo, $limite, $inicio);
  public function joininternacaoHospitalshow($id_internacao);
  public function alta($id_internacao);

  public function findByIdUpdate($id_internacao);

  public function update(Internacao $internacao);
  public function buildinternacao($internacao);
  // public function getinternacao();

  //   public function findInternAll($limite, $inicio);
  //   public function findByIdUpdate($id_internacao);

  //   public function findInternByInternado($pesqInternado);
  //   public function findInternByHosp($pesquisa_hosp);

  //   public function update(Internacao $internacao);
  //   public function destroy($id_internacao);
  //   public function joininternacaoHospital();
  //   public function joininternacaoHospitalSelect();
  //   public function joininternacaoHospitalShow($id_internacao);
}
