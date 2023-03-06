<?php

require_once("globals.php");
require_once("db.php");

require_once("models/capeante.php");
require_once("dao/capeanteDao.php");

require_once("models/message.php");
require_once("dao/usuarioDao.php");

$message = new Message($BASE_URL);
// $userDao = new UserDAO($conn, $BASE_URL);

$capeanteDao = new capeanteDAO($conn, $BASE_URL);

// Resgata o tipo do formulário
$type = filter_input(INPUT_POST, "type");

// Resgata dados do usuário

if ($type === "create") {

    // Receber os dados dos inputs
    $adm_capeante = filter_input(INPUT_POST, "adm_capeante");
    $aud_enf_capeante = filter_input(INPUT_POST, "aud_enf_capeante");
    $aud_med_capeante = filter_input(INPUT_POST, "aud_med_capeante");

    $data_inicial_capeante = filter_input(INPUT_POST, "data_inicial_capeante") ?: null;
    $data_fech_capeante = filter_input(INPUT_POST, "data_fech_capeante") ?: null;
    $data_final_conta = filter_input(INPUT_POST, "data_final_conta") ?: null;
    $diarias_capeante = filter_input(INPUT_POST, "diarias_capeante");

    $glosa_diaria = filter_input(INPUT_POST, "glosa_diaria");
    $glosa_diaria = str_replace(',', '.', $glosa_diaria);

    $glosa_honorarios = filter_input(INPUT_POST, "glosa_honorarios");
    $glosa_honorarios = str_replace(',', '.', $glosa_honorarios);

    $glosa_matmed = filter_input(INPUT_POST, "glosa_matmed");
    $glosa_matmed = str_replace(',', '.', $glosa_matmed);

    $glosa_oxig = filter_input(INPUT_POST, "glosa_oxig");
    $glosa_oxig = str_replace(',', '.', $glosa_oxig);

    $glosa_sadt = filter_input(INPUT_POST, "glosa_sadt");
    $glosa_sadt = str_replace(',', '.', $glosa_sadt);

    $glosa_taxas = filter_input(INPUT_POST, "glosa_taxas");
    $glosa_taxas = str_replace(',', '.', $glosa_taxas);


    $adm_check = filter_input(INPUT_POST, "adm_check");
    $med_check = filter_input(INPUT_POST, "med_check");
    $enfer_check = filter_input(INPUT_POST, "enfer_check");

    $pacote = filter_input(INPUT_POST, "pacote");
    $parcial_capeante = filter_input(INPUT_POST, "parcial_capeante");
    $parcial_num = filter_input(INPUT_POST, "parcial_num");
    $fk_int_capeante = filter_input(INPUT_POST, "fk_int_capeante");

    $valor_apresentado_capeante = filter_input(INPUT_POST, "valor_apresentado_capeante");
    $valor_apresentado_capeante = str_replace(',', '.', $valor_apresentado_capeante);

    $valor_final_capeante = filter_input(INPUT_POST, "valor_final_capeante");
    $valor_final_capeante = str_replace(',', '.', $valor_final_capeante);

    $valor_diarias = filter_input(INPUT_POST, "valor_diarias");
    $valor_diarias = str_replace(',', '.', $valor_diarias);

    $valor_matmed = filter_input(INPUT_POST, "valor_matmed");
    $valor_matmed = str_replace(',', '.', $valor_matmed);

    $valor_oxig = filter_input(INPUT_POST, "valor_oxig");
    $valor_oxig = str_replace(',', '.', $valor_oxig);

    $valor_sadt = filter_input(INPUT_POST, "valor_sadt");
    $valor_sadt = str_replace(',', '.', $valor_sadt);

    $valor_taxa = filter_input(INPUT_POST, "valor_taxa");
    $valor_taxa = str_replace(',', '.', $valor_taxa);

    $valor_honorarios = filter_input(INPUT_POST, "valor_honorarios");
    $valor_honorarios = str_replace(',', '.', $valor_honorarios);


    $valor_glosa_enf = filter_input(INPUT_POST, "valor_glosa_enf");
    $valor_glosa_enf = str_replace(',', '.', $valor_glosa_enf);

    $valor_glosa_med = filter_input(INPUT_POST, "valor_glosa_med");
    $valor_glosa_med = str_replace(',', '.', $valor_glosa_med);

    $valor_glosa_total = filter_input(INPUT_POST, "valor_glosa_total");
    $valor_glosa_total = str_replace('.', '', $valor_glosa_total);
    $valor_glosa_total = str_replace(',', '.', $valor_glosa_total);
    $valor_glosa_total = str_replace('R$', '', $valor_glosa_total);

    $capeante = new capeante();

    // Validação mínima de dados
    if (!empty(3 < 4)) {

        $capeante->adm_capeante = $adm_capeante;
        $capeante->adm_check = $adm_check;
        $capeante->aud_enf_capeante = $aud_enf_capeante;
        $capeante->aud_med_capeante = $aud_med_capeante;
        $capeante->data_fech_capeante = $data_fech_capeante;
        $capeante->data_final_conta = $data_final_conta;
        $capeante->data_inicial_capeante = $data_inicial_capeante;
        $capeante->diarias_capeante = $diarias_capeante;
        $capeante->glosa_diaria = $glosa_diaria;
        $capeante->glosa_honorarios = $glosa_honorarios;
        $capeante->glosa_matmed = $glosa_matmed;
        $capeante->glosa_oxig = $glosa_oxig;
        $capeante->glosa_sadt = $glosa_sadt;
        $capeante->glosa_taxas = $glosa_taxas;
        $capeante->med_check = $med_check;
        $capeante->enfer_check = $enfer_check;
        $capeante->pacote = $pacote;
        $capeante->parcial_capeante = $parcial_capeante;
        $capeante->parcial_num = $parcial_num;
        $capeante->fk_int_capeante = $fk_int_capeante;
        $capeante->valor_apresentado_capeante = $valor_apresentado_capeante;
        $capeante->valor_diarias = $valor_diarias;
        $capeante->valor_final_capeante = $valor_final_capeante;
        $capeante->valor_glosa_enf = $valor_glosa_enf;
        $capeante->valor_glosa_med = $valor_glosa_med;
        $capeante->valor_glosa_total = $valor_glosa_total;
        $capeante->valor_honorarios = $valor_honorarios;
        $capeante->valor_matmed = $valor_matmed;
        $capeante->valor_oxig = $valor_oxig;
        $capeante->valor_sadt = $valor_sadt;
        $capeante->valor_taxa = $valor_taxa;

        $capeanteDao->create($capeante);
    } else {

        $message->setMessage("Você precisa adicionar pelo menos: nome_pac do capeante!", "error", "back");
    }
    // } else if ($type === "update") {

    //     $capeanteDao = new capeanteDAO($conn, $BASE_URL);

    //     // Receber os dados dos inputs
    //     $id_capeante = filter_input(INPUT_POST, "id_capeante");
    //     $nome_pac = filter_input(INPUT_POST, "nome_pac");
    //     $endereco_pac = filter_input(INPUT_POST, "endereco_pac");
    //     $sexo_pac = filter_input(INPUT_POST, "sexo_pac");
    //     $email01_pac = filter_input(INPUT_POST, "email01_pac");
    //     $email02_pac = filter_input(INPUT_POST, "email02_pac");
    //     $cidade_pac = filter_input(INPUT_POST, "cidade_pac");
    //     $cpf_pac = filter_input(INPUT_POST, "cpf_pac");
    //     $telefone01_pac = filter_input(INPUT_POST, "telefone01_pac");
    //     $telefone02_pac = filter_input(INPUT_POST, "telefone02_pac");
    //     $numero_pac = filter_input(INPUT_POST, "numero_pac");
    //     $bairro_pac = filter_input(INPUT_POST, "bairro_pac");
    //     $mae_pac = filter_input(INPUT_POST, "mae_pac");
    //     $idade_pac = filter_input(INPUT_POST, "idade_pac");
    //     $status = filter_input(INPUT_POST, "status");

    //     $capeanteData = $capeanteDao->findById($id_capeante);

    //     $capeanteData->id_capeante = $id_capeante;
    //     $capeanteData->nome_pac = $nome_pac;
    //     $capeanteData->endereco_pac = $endereco_pac;
    //     $capeanteData->email01_pac = $email01_pac;
    //     $capeanteData->email02_pac = $email02_pac;
    //     $capeanteData->cidade_pac = $cidade_pac;
    //     $capeanteData->cpf_pac = $cpf_pac;
    //     $capeanteData->telefone01_pac = $telefone01_pac;
    //     $capeanteData->telefone02_pac = $telefone02_pac;
    //     $capeanteData->mae_pac = $mae_pac;
    //     $capeanteData->idade_pac = $idade_pac;
    //     $capeanteData->numero_pac = $numero_pac;
    //     $capeanteData->bairro_pac = $bairro_pac;
    //     $capeanteData->sexo_pac = $sexo_pac;

    //     $capeanteDao->update($capeanteData);

    include_once('cad_capeante.php');
}
//$type = "delete";
//$type = filter_input(INPUT_POST, "type");

// if ($type === "delete") {
//     // Recebe os dados do form
//     $id_capeante = filter_input(INPUT_GET, "id_capeante");

//     $capeanteDao = new capeanteDAO($conn, $BASE_URL);

//     $capeante = $capeanteDao->findById($id_capeante);

//     echo $capeante;
//     if ($capeante) {

//         $capeanteDao->destroy($id_capeante);

//         include_once('list_capeante.php');
//     } else {

//         $message->setMessage("Informações inválidas!", "error", "index.php");
//     }

/**
 * Get the value of parcial_capeante
 */ 
    // public function getParcial_capeante()
    // {
    //     return $this->parcial_capeante;
    // }
