<?php
require_once("globals.php");
require_once("db.php");
require_once("models/uti.php");
require_once("models/message.php");
require_once("dao/usuarioDao.php");
require_once("dao/utiDao.php");


$message = new Message($BASE_URL);
$userDao = new UserDAO($conn, $BASE_URL);
$utiDao = new utiDAO($conn, $BASE_URL);

// Resgata o tipo do formulário
$type = filter_input(INPUT_POST, "type");

// Resgata dados do usuário

if ($type === "create") {

    // Receber os dados dos inputs
    $fk_internacao_uti = filter_input(INPUT_POST, "fk_internacao_uti");
    $fk_visita_uti = filter_input(INPUT_POST, "fk_visita_uti");
    $criterios_uti = filter_input(INPUT_POST, "criterios_uti");
    $data_alta_uti = filter_input(INPUT_POST, "data_alta_uti");
    $dva_uti = filter_input(INPUT_POST, "dva_uti");
    $data_internacao_uti = filter_input(INPUT_POST, "data_internacao_uti") ?: null;
    $especialidade_uti = filter_input(INPUT_POST, "especialidade_uti");
    $internacao_uti = filter_input(INPUT_POST, "internacao_uti");
    $internado_uti = filter_input(INPUT_POST, "internado_uti");
    $just_uti = filter_input(INPUT_POST, "just_uti");
    $motivo_uti = filter_input(INPUT_POST, "motivo_uti");
    $rel_uti = filter_input(INPUT_POST, "rel_uti");
    $saps_uti = filter_input(INPUT_POST, "saps_uti");
    $score_uti = filter_input(INPUT_POST, "score_uti");
    $vm_uti = filter_input(INPUT_POST, "vm_uti");
    $id_internacao = filter_input(INPUT_POST, "id_internacao");
    $internacao_uti_int = filter_input(INPUT_POST, "internacao_uti_int");

    $uti = new uti();

    // Validação mínima de dados
    if (!empty($fk_internacao_uti)) {

        $uti->fk_internacao_uti = $fk_internacao_uti;
        $uti->fk_visita_uti = $fk_visita_uti;
        $uti->criterios_uti = $criterios_uti;
        $uti->data_alta_uti = $data_alta_uti;
        $uti->dva_uti = $dva_uti;
        $uti->data_internacao_uti = $data_internacao_uti;
        $uti->especialidade_uti = $especialidade_uti;
        $uti->internacao_uti = $internacao_uti;
        $uti->internado_uti = $internado_uti;
        $uti->just_uti = $just_uti;
        $uti->motivo_uti = $motivo_uti;
        $uti->rel_uti = $rel_uti;
        $uti->saps_uti = $saps_uti;
        $uti->score_uti = $score_uti;
        $uti->vm_uti = $vm_uti;
        $uti->id_internacao = $id_internacao;
        $uti->internacao_uti_int = $internacao_uti_int;

        $utiDao->create($uti);
    } else {

        $message->setMessage("Você precisa adicionar pelo menos: utiNome do uti!", "error", "back");
    }
    // } else if ($type === "update") {

    //     $utiDao = new utiDAO($conn, $BASE_URL);

    //     // Receber os dados dos inputs
    //     $id_uti = filter_input(INPUT_POST, "id_uti");
    //     $nome_uti = filter_input(INPUT_POST, "nome_uti");
    //     $endereco_uti = filter_input(INPUT_POST, "endereco_uti");
    //     $email01_uti = filter_input(INPUT_POST, "email01_uti");
    //     $cidade_uti = filter_input(INPUT_POST, "cidade_uti");
    //     $cnpj_uti = filter_input(INPUT_POST, "cnpj_uti");
    //     $telefone01_uti = filter_input(INPUT_POST, "telefone01_uti");
    //     $telefone02_uti = filter_input(INPUT_POST, "telefone02_uti");
    //     $numero_uti = filter_input(INPUT_POST, "numero_uti");
    //     $bairro_uti = filter_input(INPUT_POST, "bairro_uti");

    //     $utiData = $utiDao->findById($id_uti);

    //     $utiData->id_uti = $id_uti;
    //     $utiData->nome_uti = $nome_uti;
    //     $utiData->endereco_uti = $endereco_uti;
    //     $utiData->email01_uti = $email01_uti;
    //     $utiData->cidade_uti = $cidade_uti;
    //     $utiData->telefone01_uti = $telefone01_uti;
    //     $utiData->telefone02_uti = $telefone02_uti;
    //     $utiData->numero_uti = $numero_uti;
    //     $utiData->bairro_uti = $bairro_uti;

    //     $utiDao->update($utiData);

    include_once('cad_internacao.php');
}
//$type = "delete";
//$type = filter_input(INPUT_POST, "type");

if ($type === "delete") {
    // Recebe os dados do form
    $id_uti = filter_input(INPUT_GET, "id_uti");

    $utiDao = new utiDAO($conn, $BASE_URL);

    $uti = $utiDao->findById($id_uti);

    echo $uti;
    if ($uti) {

        $utiDao->destroy($id_uti);

        include_once('list_uti.php');
    } else {

        $message->setMessage("Informações inválidas!", "error", "index.php");
    }
}
