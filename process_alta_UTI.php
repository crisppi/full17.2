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
    $rel_int = filter_input(INPUT_POST, "rel_int") ?: null;
    $fk_hospital_int = filter_input(INPUT_POST, "fk_hospital_int");
    $fk_paciente_int = filter_input(INPUT_POST, "fk_paciente_int");
    $fk_patologia_int = filter_input(INPUT_POST, "fk_patologia_int") ?: 1000;
    $fk_patologia2 = filter_input(INPUT_POST, "fk_patologia2");
    $internado_int = filter_input(INPUT_POST, "internado_int");
    $modo_internacao_int = filter_input(INPUT_POST, "modo_internacao_int");
    $tipo_admissao_int = filter_input(INPUT_POST, "tipo_admissao_int");
    $data_visita_int = filter_input(INPUT_POST, "data_visita_int") ?: null;
    $acoes_int = filter_input(INPUT_POST, "acoes_int");
    $titular_int = filter_input(INPUT_POST, "titular_int");
    $especialidade_int = filter_input(INPUT_POST, "especialidade_int");
    $grupo_patologia_int = filter_input(INPUT_POST, "grupo_patologia_int");
    $acomodacao_int = filter_input(INPUT_POST, "acomodacao_int");
    $usuario_create_int = filter_input(INPUT_POST, "usuario_create_int");
    $data_create_int = filter_input(INPUT_POST, "data_create_int") ?: null;

    $internacao = new internacao();

    // Validação mínima de dados
    if (3 < 4) {

        $internacao->fk_paciente_int = $fk_paciente_int;
        $internacao->fk_hospital_int = $fk_hospital_int;
        $internacao->fk_patologia_int = $fk_patologia_int;
        $internacao->fk_patologia2 = $fk_patologia2;
        $internacao->internado_int = $internado_int;
        $internacao->modo_internacao_int = $modo_internacao_int;
        $internacao->tipo_admissao_int = $tipo_admissao_int;
        $internacao->grupo_patologia_int = $grupo_patologia_int;
        $internacao->data_visita_int = $data_visita_int;
        $internacao->especialidade_int = $especialidade_int;
        $internacao->titular_int = $titular_int;
        $internacao->acomodacao_int = $acomodacao_int;
        $internacao->rel_int = $rel_int;
        $internacao->acoes_int = $acoes_int;
        $internacao->usuario_create_int = $usuario_create_int;
        $internacao->data_create_int = $data_create_int;

        $internacaoDao->create($internacao);
        include_once('cad_internacao.php');
    } else {
        header("Location: javascript:history.back(1)");
        $message->setMessage("Você precisa adicionar pelo menos: nome da internacao!", "error", "list_internacao_uti.php");
    }
} else if ($type === "update") {

    // Receber os dados dos inputs
    $id_uti = filter_input(INPUT_POST, "id_uti");
    $data_alta_uti = filter_input(INPUT_POST, "data_alta_uti");
    $internado_uti = filter_input(INPUT_POST, "internado_uti");

    $UTIData->id_uti = $id_uti;
    $UTIData->data_alta_uti = $data_alta_uti;
    $UTIData->internado_uti = $internado_uti;

    $utiDao->findAltaUpdate($UTIData);


    include_once('list_internacao_uti.php');
}
