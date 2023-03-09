<?php

require_once("templates/header.php");

require_once("models/message.php");

include_once("models/internacao.php");
include_once("dao/internacaoDao.php");

include_once("models/patologia.php");
include_once("dao/patologiaDao.php");

include_once("models/paciente.php");
include_once("dao/pacienteDao.php");

include_once("models/hospital.php");
include_once("dao/hospitalDao.php");

include_once("models/capeante.php");
include_once("dao/capeanteDao.php");

include_once("models/pagination.php");

$Internacao_geral = new internacaoDAO($conn, $BASE_URL);
$Internacaos = $Internacao_geral->findGeral();

$pacienteDao = new pacienteDAO($conn, $BASE_URL);
$pacientes = $pacienteDao->findGeral($limite, $inicio);

$capeante_geral = new capeanteDAO($conn, $BASE_URL);
$capeante = $capeante_geral->findGeral($limite, $inicio);

$hospital_geral = new HospitalDAO($conn, $BASE_URL);
$hospitals = $hospital_geral->findGeral($limite, $inicio);

$patologiaDao = new patologiaDAO($conn, $BASE_URL);
$patologias = $patologiaDao->findGeral();

$internacao = new internacaoDAO($conn, $BASE_URL);

//Instanciando a classe
$QtdTotalInt = new internacaoDAO($conn, $BASE_URL);
// METODO DE BUSCA DE PAGINACAO 
$pesquisa_nome = filter_input(INPUT_GET, 'pesquisa_nome');
$pesqInternado = filter_input(INPUT_GET, 'pesqInternado') ?: "s";
$limite = filter_input(INPUT_GET, 'limite') ? filter_input(INPUT_GET, 'limite') : 10;
$pesquisa_pac = filter_input(INPUT_GET, 'pesquisa_pac');
$id_internacao = filter_input(INPUT_GET, 'id_internacao');

$ordenar = filter_input(INPUT_GET, 'ordenar') ? filter_input(INPUT_GET, 'ordenar') : 1;
// $buscaAtivo = in_array($buscaAtivo, ['s', 'n']) ?: "";

$condicoes = [
    strlen($pesquisa_nome) ? 'ho.nome_hosp LIKE "%' . $pesquisa_nome . '%"' : null,
    strlen($pesquisa_pac) ? 'pa.nome_pac LIKE "%' . $pesquisa_pac . '%"' : null,
    strlen($pesqInternado) ? 'internado_int = "' . $pesqInternado . '"' : NULL,
    strlen($id_internacao) ? 'fk_int_capeante = "' . $id_internacao . '"' : NULL,
];
$condicoes = array_filter($condicoes);
// REMOVE POSICOES VAZIAS DO FILTRO
$where = implode(' AND ', $condicoes);

// PAGINACAO
$order = $ordenar;
$obLimite = null;

// PREENCHIMENTO DO FORMULARIO COM QUERY
$intern = $capeante_geral->selectAllcapeante($where, $order, $obLimite);
extract($intern);
?>

<script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js"></script>

<div class="row">
    <h2 id="titulo" class="page-title titulo"> Capeante - Lançamento</h2>
    <p id="subtitulo" class="page-description">Adicione informações do Capeante</p>

    <form class="formulario visible" action="<?= $BASE_URL ?>process_capeante.php" id="add-internacao-form" method="POST" enctype="multipart/form-data">
        <input type="text" name="type" value="create">
        <br>
        <?php
        $dataFech = date('Y-m-d');
        if ($_SESSION['cargo'] === "Enf_auditor") {
            echo "<div class='logado'>";
            echo "Olá !!! ";
            echo  $_SESSION['login_user'];
            echo "<br>";
            echo "Você está logado como Enfermeiro(a)";
            echo "</div>";
        };
        if ($_SESSION['cargo'] === "Med_auditor") {
            echo "<div class='logado'>";
            echo "Olá !!! ";
            echo  $_SESSION['login_user'];
            echo "Você está logado como Médico(a)";
            echo "</div>";
        };
        if ($_SESSION['cargo'] === "Adm") {
            echo "<div class='logado'>";
            echo "Olá !!! ";
            echo  $_SESSION['login_user'];
            echo "Você está logado como Administrativo(a)";
            echo "</div>";
        };
        ?>
        <hr>
        <!-- profissionais  -->
        <div class="form-group row">
            <div class="form-group row">
                <div class="form-group col-sm-2">
                    <label for="fk_int_capeante">Reg internação</label>
                    <input type="text" class="form-control" id="fk_int_capeante" name="fk_int_capeante" value="<?= $intern['0']['id_internacao'] ?>" placeholder="<?= $intern['0']['id_internacao'] ?>">
                </div>
                <div class="form-group col-sm-2">
                    <label for="fk_hospital_int">Hospital</label>
                    <input type="text" class="form-control" id="fk_hospital_int" name="fk_hospital_int" value="<?= $intern['0']['nome_hosp'] ?>" placeholder="<?= $intern['0']['nome_hosp'] ?>">
                </div>
                <div class="form-group col-sm-2">
                    <label for="valor_final_capeante">Paciente</label>
                    <input type="text" class="form-control" id="fk_paciente_int" name="fk_paciente_int" placeholder="<?= $intern['0']['nome_pac'] ?>">
                </div>
            </div>
            <?php if ($_SESSION['cargo'] === "Adm") { ?>
                <div class="form-group col-sm-2">
                    <label for="adm_capeante">Adm Capeante</label>
                    <input type="text" class="form-control" id="adm_capeante" name="adm_capeante" value="<?php if ($_SESSION['cargo'] === "Adm") echo $_SESSION['login_user'] ?>">
                </div>
            <?php } ?>

            <?php if ($_SESSION['cargo'] === "Enf_auditor") { ?>
                <div class="form-group col-sm-2">
                    <label for="aud_enf_capeante">Enf Auditor</label>
                    <input type="text" class="form-control" id="aud_enf_capeante" name="aud_enf_capeante" value="<?php if ($_SESSION['cargo'] === "Enf_auditor") echo $_SESSION['login_user'] ?>">
                </div>
            <?php } ?>
            <?php if ($_SESSION['cargo'] === "Med_auditor") { ?>
                <div class="form-group col-sm-2">
                    <label for="aud_med_capeante"> Médico Auditor</label>
                    <input type="text" class="form-control" id="aud_med_capeante" name="aud_med_capeante" value="<?php if ($_SESSION['cargo'] === "Med_auditor") echo $_SESSION['login_user'] ?>">
                </div>
            <?php } ?>
            <?php if ($_SESSION['cargo'] === "Adm") { ?>

                <div class="form-group col-sm-2">
                    <label for="adm_check">Check adm</label>
                    <input type="text" class="form-control" id="adm_check" name="adm_check" value="<?php if ($_SESSION['cargo'] === "adm") {
                                                                                                        echo "s";
                                                                                                    } else {
                                                                                                        echo 'n';
                                                                                                    } ?>">
                </div>
            <?php } ?>
            <?php if ($_SESSION['cargo'] === "Med_auditor") { ?>

                <div class="form-group col-sm-2">
                    <label for="med_check">Check Médico</label>
                    <input type="text" class="form-control" id="med_check" name="med_check" value="<?php if ($_SESSION['cargo'] === "Med_auditor") {
                                                                                                        echo "s";
                                                                                                    } else {
                                                                                                        echo 'n';
                                                                                                    } ?>">
                </div>
            <?php } ?>
            <?php if ($_SESSION['cargo'] === "Enf_auditor") { ?>

                <div class="form-group col-sm-2">
                    <label for="enfer_check">Check Enf</label>
                    <input type="text" class="form-control" id="enfer_check" name="enfer_check" value="<?php if ($_SESSION['cargo'] === "Enf_auditor") {
                                                                                                            echo "s";
                                                                                                        } else {
                                                                                                            echo 'n';
                                                                                                        } ?>">
                </div>
            <?php } ?>

        </div>
        <!-- dados de abertura -->
        <hr>
        <div class="form-group row">
            <div class="form-group col-sm-2">
                <label for="valor_apresentado_capeante">Valor Apresentado</label>
                <input type="text" class="form-control dinheiro" id="valor_apresentado_capeante" name="valor_apresentado_capeante" placeholder="Valor apresentado">
            </div>
            <div class="form-group col-sm-2">
                <label for="valor_final_capeante">Valor Final</label>
                <input type="text" class="form-control dinheiro" id="valor_final_capeante" name="valor_final_capeante" placeholder="Valor final">
            </div>
        </div>

        <br>
        <!-- campos de dados gerais  -->
        <div class="form-group row">
            <div id="div_data_inicial_capeante" class="form-group col-sm-2">
                <label for="data_inicial_capeante">Data Inicial</label>
                <input type="date" class="form-control" id="data_inicial_capeante" name="data_inicial_capeante">
                <div class="notif-input">
                    Data inválida !
                </div>
            </div>
            <div class="form-group col-sm-2">
                <label for="data_final_conta">Data Final</label>
                <input type="date" class="form-control" id="data_final_conta" name="data_final_conta">
            </div>
            <div class="form-group col-sm-2">
                <label for="diarias_capeante">Diárias</label>
                <input type="text" class="form-control" id="diarias_capeante" name="diarias_capeante">
            </div>
            <div class="form-group col-sm-2">
                <label for="data_fech_capeante">Data Fechamento</label>
                <input type="date" class="form-control" id="data_fech_capeante" value="<?= $dataFech ?>" name="data_fech_capeante">
            </div>
        </div>
        <hr>
        <!-- campo de valores por grupo -->
        <div class="form-group row">
            <div class="form-group col-sm-2">
                <label for="valor_diarias">Valor Diárias</label>
                <input type="text" class="form-control dinheiro" id="valor_diarias" name="valor_diarias" placeholder="Valor diárias">
            </div>
            <div class="form-group col-sm-2">
                <label for="valor_matmed">Valor MatMed</label>
                <input type="text" class="form-control dinheiro" id="valor_matmed" name="valor_matmed" placeholder="Valor MatMed">
            </div>
            <div class="form-group col-sm-2">
                <label for="valor_oxig">Valor Oxigenioterapia</label>
                <input type="text" class="form-control dinheiro" id="valor_oxig" name="valor_oxig" placeholder="Valor Oxigenioterapia">
            </div>
            <div class="form-group col-sm-2">
                <label for="valor_sadt">Valor SADT</label>
                <input type="text" class="form-control dinheiro" id="valor_sadt" name="valor_sadt" placeholder="Valor SADT">
            </div>
            <div class="form-group col-sm-2">
                <label for="valor_taxa">Valor Taxas</label>
                <input type="text" class="form-control dinheiro" id="valor_taxa" name="valor_taxa" placeholder="Valor Taxa">
            </div>
            <div class="form-group col-sm-2">
                <label for="valor_honorarios">Valor Honorários</label>
                <input type="text" class="form-control dinheiro" id="valor_honorarios" name="valor_honorarios" placeholder="Valor Honorários">
            </div>
        </div>
        <br>

        <!-- campos de glosas -->
        <div class="form-group row">
            <div class="form-group col-sm-2">
                <label for="glosa_diarias">Glosa Diárias</label>
                <input type="text" class="form-control dinheiro" id="glosa_diarias" name="glosa_diarias" placeholder="Glosa diárias">
            </div>
            <div class="form-group col-sm-2">
                <label for="glosa_matmed">Glosa MatMed</label>
                <input type="text" class="form-control dinheiro" id="glosa_matmed" name="glosa_matmed" placeholder="Glosa MatMed">
            </div>
            <div class="form-group col-sm-2">
                <label for="glosa_oxig">Glosa Oxigenioterapia</label>
                <input type="text" class="form-control dinheiro" id="glosa_oxig" name="glosa_oxig" placeholder="Glosa Oxigenioterapia">
            </div>
            <div class="form-group col-sm-2">
                <label for="glosa_sadt">Glosa SADT</label>
                <input type="text" class="form-control dinheiro" id="glosa_sadt" name="glosa_sadt" placeholder="Glosa SADT">
            </div>
            <div class="form-group col-sm-2">
                <label for="glosa_taxa">Glosa Taxas</label>
                <input type="text" class="form-control dinheiro" id="glosa_taxa" name="glosa_taxa" placeholder="Glosa Taxas">
            </div>
            <div class="form-group col-sm-2">
                <label for="glosa_honorarios">Glosa Honorários</label>
                <input type="text" class="form-control dinheiro" id="glosa_honorarios" name="glosa_honorarios" placeholder="Glosa honorários">
            </div>
        </div>
        <br>

        <!-- campos de glosas por profissional-->
        <div class="form-group row">
            <div class="form-group col-sm-2">
                <label for="valor_glosa_enf">Glosa Enfermagem</label>
                <input type="text" class="dinheiro form-control" id="valor_glosa_enf" name="valor_glosa_enf" placeholder="Glosa Enfermagem">
                <p class="oculto mensagem_error" id="err_valor_glosa_enf">Digite um número!</p>
            </div>
            <div class="form-group col-sm-2">
                <label for="valor_glosa_med">Glosa Médica</label>
                <input type="text" class="form-control dinheiro" id="valor_glosa_med" name="valor_glosa_med" placeholder="Glosa Médica">
            </div>
            <div class="form-group col-sm-2">
                <label for="valor_glosa_total">Glosa Total</label>
                <input type="text" class="money2 form-control" id="valor_glosa_total" name="valor_glosa_total" placeholder="Glosa Total">
            </div>
            <div> <button style="margin:10px" type="submit" class="btn-sm btn-success">Cadastrar</button>
            </div>
        </div>
        <br>

    </form>
    <hr>
    <div>
        <a class="btn btn-success styled" style="margin-left:10px" href="cad_capeante.php">Novo Capeante</a>
    </div>
</div>


<script src="js/scriptData.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>