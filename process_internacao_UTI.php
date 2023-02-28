<?php
require_once("globals.php");
require_once("db.php");
require_once("models/internacao.php");
// require_once("models/message.php");
// require_once("dao/usuarioDao.php");
require_once("dao/internacaoDao.php");

require_once("models/uti.php");
require_once("dao/utiDao.php");

// $userDao = new UserDAO($conn, $BASE_URL);
$internacaoDao = new internacaoDAO($conn, $BASE_URL);

$utiDao = new utiDAO($conn, $BASE_URL);

$id_internacao = filter_input(INPUT_POST, "id_internacao");

// Resgata o tipo do formulário
$type = filter_input(INPUT_POST, "type");

// Resgata dados do usuário
if ($type === "create") {

    // Receber os dados dos inputs
    $rel_uti = filter_input(INPUT_POST, "rel_uti") ?: null;

    $fk_paciente_int = filter_input(INPUT_POST, "fk_paciente_int");
    $internado_uti = filter_input(INPUT_POST, "internado_uti");
    $criterios_uti = filter_input(INPUT_POST, "criterios_uti");
    $data_alta_uti = filter_input(INPUT_POST, "data_alta_uti");
    $dva_uti = filter_input(INPUT_POST, "dva_uti");
    $especialidade_uti = filter_input(INPUT_POST, "especialidade_uti");
    $internacao_uti = filter_input(INPUT_POST, "internacao_uti");
    $just_uti = filter_input(INPUT_POST, "just_uti");
    $motivo_uti = filter_input(INPUT_POST, "motivo_uti");
    $saps_uti = filter_input(INPUT_POST, "saps_uti");
    $score_uti = filter_input(INPUT_POST, "score_uti");
    $vm_uti = filter_input(INPUT_POST, "vm_uti");
    $id_internacao = filter_input(INPUT_POST, "id_internacao");

    $data_create_uti = filter_input(INPUT_POST, "data_create_uti") ?: null;
    $fk_usuario_uti = filter_input(INPUT_POST, "fk_usuario_uti");

    $uti = new uti();

    // Validação mínima de dados
    if (3 < 4) {

        $uti->internado_uti = $internado_uti;
        $uti->criterios_uti = $criterios_uti;
        $uti->data_alta_uti = $data_alta_uti;
        $uti->data_internacao_uti = $data_internacao_uti;
        $uti->dva_uti = $dva_uti;
        $uti->especialidade_uti = $especialidade_uti;
        $uti->internacao_uti = $internacao_uti;
        $uti->just_uti = $just_uti;
        $uti->motivo_uti = $motivo_uti;
        $uti->rel_uti = $rel_uti;
        $uti->saps_uti = $saps_uti;
        $uti->score_uti = $score_uti;
        $uti->vm_uti = $vm_uti;
        $uti->id_internacao = $id_internacao;
        $uti->usuario_create_uti = $usuario_create_int;
        $uti->data_create_uti = $data_create_int;

        $utiDao->create($uti);
        include_once('cad_internacao.php');
    } else {
        header("Location: javascript:history.back(1)");
        $message->setMessage("Você precisa adicionar pelo menos: nome da internacao!", "error", "list_internacao.php");
    }
} else if ($type === "update") {

    // Receber os dados dos inputs
    $id_internacao = filter_input(INPUT_POST, "id_internacao");
    $fk_hospital_int = filter_input(INPUT_POST, "fk_hospital_int");
    $fk_paciente_int = filter_input(INPUT_POST, "fk_paciente_int");
    $fk_patologia_int = filter_input(INPUT_POST, "fk_patologia_int");
    $fk_patologia2 = filter_input(INPUT_POST, "fk_patologia2");
    $internado_int = filter_input(INPUT_POST, "internado_int");
    $tipo_admissao_int = filter_input(INPUT_POST, "tipo_admissao_int");
    $modo_internacao_int = filter_input(INPUT_POST, "modo_internacao_int");
    $especialidade_int = filter_input(INPUT_POST, "especialidade_int");
    $grupo_patologia_int = filter_input(INPUT_POST, "grupo_patologia_int");
    $data_visita_int = filter_input(INPUT_POST, "data_visita_int") ?: null;
    $data_alta_int = filter_input(INPUT_POST, "data_alta_int") ?: NULL;
    $titular_int = filter_input(INPUT_POST, "titular_int");
    $acomodacao_int = filter_input(INPUT_POST, "acomodacao_int");
    $acoes_int = filter_input(INPUT_POST, "acoes_int");
    $tipo_alta_int = filter_input(INPUT_POST, "tipo_alta_int");
    $rel_int = filter_input(INPUT_POST, "rel_int");
    $usuario_create_int = filter_input(INPUT_POST, "usuario_create_int");
    $data_create_int = filter_input(INPUT_POST, "data_create_int") ?: null;

    // $internacao = new internacao();

    $internacaoData = $internacaoDao->findById($id_internacao);

    $internacaoData->id_internacao = $id_internacao;
    $internacaoData->fk_hospital_int = $fk_hospital_int;
    $internacaoData->fk_paciente_int = $fk_paciente_int;
    $internacaoData->fk_patologia_int = $fk_patologia_int;
    $internacaoData->fk_patologia2 = $fk_patologia2;
    $internacaoData->internado_int = $internado_int;
    $internacaoData->modo_internacao_int = $modo_internacao_int;
    $internacaoData->tipo_admissao_int = $tipo_admissao_int;
    $internacaoData->grupo_patologia_int = $grupo_patologia_int;
    $internacaoData->especialidade_int = $especialidade_int;
    $internacaoData->data_visita_int = $data_visita_int;
    $internacaoData->data_alta_int = $data_alta_int;
    $internacaoData->titular_int = $titular_int;
    $internacaoData->acomodacao_int = $acomodacao_int;
    $internacaoData->acoes_int = $acoes_int;
    $internacaoData->tipo_alta_int = $tipo_alta_int;
    $internacaoData->rel_int = $rel_int;
    $internacaoData->usuario_create_int = $usuario_create_int;
    $internacaoData->data_create_int = $data_create_int;

    $internacaoDao->update($internacaoData);

    include_once('list_internacao.php');
}
