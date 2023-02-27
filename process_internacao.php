<?php
require_once("globals.php");
require_once("db.php");
require_once("models/internacao.php");
require_once("dao/internacaoDao.php");

require_once("models/uti.php");
require_once("dao/utiDao.php");

require_once("models/message.php");

require_once("models/usuario.php");
require_once("dao/usuarioDao.php");


// $message = new Message($BASE_URL);
// $userDao = new UserDAO($conn, $BASE_URL);
$internacaoDao = new InternacaoDAO($conn, $BASE_URL);
$utiDao = new utiDAO($conn, $BASE_URL);
$id_internacao = filter_input(INPUT_POST, "id_internacao");

$internadosUTI = $utiDao->findUTIInternacao($id_internacao);

// Resgata o tipo do formulário
$type = filter_input(INPUT_POST, "type");

// Resgata dados do usuário
if ($type === "create") {

    // Receber os dados dos inputs
    $fk_hospital_int = filter_input(INPUT_POST, "fk_hospital_int");
    $fk_paciente_int = filter_input(INPUT_POST, "fk_paciente_int");
    $fk_patologia_int = filter_input(INPUT_POST, "fk_patologia_int") ?: 1000;
    $fk_patologia2 = filter_input(INPUT_POST, "fk_patologia2") ?: 1000;
    $internado_int = filter_input(INPUT_POST, "internado_int");
    $modo_internacao_int = filter_input(INPUT_POST, "modo_internacao_int");
    $tipo_admissao_int = filter_input(INPUT_POST, "tipo_admissao_int");
    $data_visita_int = filter_input(INPUT_POST, "data_visita_int") ?: null;
    $data_intern_int = filter_input(INPUT_POST, "data_intern_int") ?: null;
    $especialidade_int = filter_input(INPUT_POST, "especialidade_int");
    $titular_int = filter_input(INPUT_POST, "titular_int");
    $acomodacao_int = filter_input(INPUT_POST, "acomodacao_int");
    $acoes_int = filter_input(INPUT_POST, "acoes_int");
    $rel_int = filter_input(INPUT_POST, "rel_int") ?: null;
    $senha_int = filter_input(INPUT_POST, "senha_int");
    $usuario_create_int = filter_input(INPUT_POST, "usuario_create_int");
    $data_create_int = filter_input(INPUT_POST, "data_create_int") ?: null;
    $grupo_patologia_int = filter_input(INPUT_POST, "grupo_patologia_int");
    $primeira_vis_int = filter_input(INPUT_POST, "primeira_vis_int");
    $visita_med_int = filter_input(INPUT_POST, "visita_med_int");
    $visita_enf_int = filter_input(INPUT_POST, "visita_enf_int");
    $visita_no_int = filter_input(INPUT_POST, "visita_no_int");
    $acomodacao_int = filter_input(INPUT_POST, "acomodacao_int");
    $conta_finalizada_int = filter_input(INPUT_POST, "conta_finalizada_int");
    $conta_paga_int = filter_input(INPUT_POST, "conta_paga_int");
    $internacao_ativa_int = filter_input(INPUT_POST, "internacao_ativa_int");
    $tipo_alta_int = filter_input(INPUT_POST, "tipo_alta_int");
    $data_alta_int = filter_input(INPUT_POST, "data_alta_int");
    $visita_auditor_prof_med = filter_input(INPUT_POST, "visita_auditor_prof_med");
    $visita_auditor_prof_enf = filter_input(INPUT_POST, "visita_auditor_prof_enf");
    $internacao_uti_int = filter_input(INPUT_POST, "internacao_uti_int");
    $internado_uti_int = filter_input(INPUT_POST, "internado_uti_int");
    $fk_usuario_int = filter_input(INPUT_POST, "fk_usuario_int");


    $internacao = new internacao();

    // Validação mínima de dados
    if (3 < 4) {

        $internacao->fk_hospital_int = $fk_hospital_int;
        $internacao->fk_paciente_int = $fk_paciente_int;
        $internacao->fk_patologia_int = $fk_patologia_int;
        $internacao->fk_patologia2 = $fk_patologia2;
        $internacao->internado_int = $internado_int;
        $internacao->modo_internacao_int = $modo_internacao_int;
        $internacao->tipo_admissao_int = $tipo_admissao_int;
        $internacao->grupo_patologia_int = $grupo_patologia_int;
        $internacao->data_visita_int = $data_visita_int;
        $internacao->data_intern_int = $data_intern_int;
        $internacao->especialidade_int = $especialidade_int;
        $internacao->titular_int = $titular_int;
        $internacao->acomodacao_int = $acomodacao_int;
        $internacao->rel_int = $rel_int;
        $internacao->acoes_int = $acoes_int;
        $internacao->senha_int = $senha_int;
        $internacao->usuario_create_int = $usuario_create_int;
        $internacao->data_create_int = $data_create_int;
        $internacao->grupo_patologia_int = $grupo_patologia_int;
        $internacao->primeira_vis_int = $primeira_vis_int;
        $internacao->visita_med_int = $visita_med_int;
        $internacao->visita_enf_int = $visita_enf_int;
        $internacao->visita_no_int = $visita_no_int;
        $internacao->acomodacao_int = $acomodacao_int;
        $internacao->conta_finalizada_int = $conta_finalizada_int;
        $internacao->conta_paga_int = $conta_paga_int;
        $internacao->internacao_ativa_int = $internacao_ativa_int;
        $internacao->tipo_alta_int = $tipo_alta_int;
        $internacao->data_alta_int = $data_alta_int;
        $internacao->visita_auditor_prof_med = $visita_auditor_prof_med;
        $internacao->visita_auditor_prof_enf = $visita_auditor_prof_enf;
        $internacao->internacao_uti_int = $internacao_uti_int;
        $internacao->internado_uti_int = $internado_uti_int;
        $internacao->fk_usuario_int = $fk_usuario_int;

        $internacaoDao->create($internacao);

        include_once('cad_internacao_niveis.php');
    } else {
        header("Location: javascript:history.back(1)");
        $message->setMessage("Você precisa adicionar pelo menos: nome da internacao!", "error", "cad_internacao_niveis.php");
    }
} else if ($type === "alta") {

    // Receber os dados dos inputs
    $id_internacao = filter_input(INPUT_POST, "id_internacao");
    $internado_int = filter_input(INPUT_POST, "internado_int");
    $data_alta_int = filter_input(INPUT_POST, "data_alta_int");
    $tipo_alta_int = filter_input(INPUT_POST, "tipo_alta_int");
    $usuario_create_int = filter_input(INPUT_POST, "usuario_create_int");
    $data_create_int = filter_input(INPUT_POST, "data_create_int") ?: null;

    // RECEBER DADOS DO INPUT PARA DARA ALTA DA UTI
    $alta_uti = filter_input(INPUT_POST, "alta_uti");
    $id_uti = filter_input(INPUT_POST, "id_uti");
    $internado_uti_int = filter_input(INPUT_POST, "internado_uti_int");
    $data_alta_uti = filter_input(INPUT_POST, "data_alta_uti") ?: null;

    // $internacao = new internacao();
    $internacaoData = $internacaoDao->findById($id_internacao);

    $internacaoData->id_internacao = $id_internacao;
    $internacaoData->internado_int = $internado_int;
    $internacaoData->data_alta_int = $data_alta_int;
    $internacaoData->tipo_alta_int = $tipo_alta_int;
    $internacaoData->usuario_create_int = $usuario_create_int;
    $internacaoData->data_create_int = $data_create_int;

    if ($alta_uti == "alta-uti") {
        print_r('chegoou');
        exit;
        $UTIData->id_uti = $id_uti;
        $UTIData->data_alta_uti = $data_alta_uti;
        $UTIData->internado_uti = $internado_uti;

        $utiDao->findAltaUpdate($UTIData);

        include_once('list_internacao.php');
    }

    $internacaoDao->update($internacaoData);

    // include_once('cad_internacao_niveis.php');
}
