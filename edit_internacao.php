<?php
require_once("models/usuario.php");
require_once("models/internacao.php");
require_once("models/paciente.php");
require_once("models/patologia.php");
require_once("dao/usuarioDao.php");
require_once("dao/internacaoDao.php");
require_once("templates/header.php");
include_once("dao/hospitalDao.php");
include_once("dao/patologiaDao.php");
include_once("dao/pacienteDao.php");


$internacao = new internacao();
$userDao = new UserDAO($conn, $BASE_URL);
$internacaoDao = new internacaoDAO($conn, $BASE_URL);

$hospital_geral = new hospitalDAO($conn, $BASE_URL);
$hospitals = $hospital_geral->findGeral();

$patologia_geral = new patologiaDAO($conn, $BASE_URL);
$patologias = $patologia_geral->findGeral();

$paciente_geral = new pacienteDAO($conn, $BASE_URL);
$pacientes = $paciente_geral->findGeral();

// Receber id do usuário
$id_internacao = filter_input(INPUT_GET, "id_internacao");

//$internacao = $internacaoDao->joininternacaoHospitalShow($id_internacao);
$internacao = $internacaoDao->findById($id_internacao);

?>

<!-- formulario update -->

<div id="main-container" class="container-fluid">
    <div class="row">

        <h1 class="page-title">Atualizar internação</h1>
        <p class="page-description">Selecione as informações sobre a internação</p>

        <form class="formulario" action="<?= $BASE_URL ?>process_internacao.php" id="add-movie-form" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="type" value="update">
            <div class="form-group col-sm-2">

                <label class="control-label" for="id_internacao">ID Internação</label>
                <input value="<?= $internacao->id_internacao ?>" type="text" class="form-control" id="id_internacao" name="id_internacao">
            </div>
            <div class="form-group row">
                <div class="form-group col-sm-3">
                    <label class="control-label col-sm-3 " for="fk_hospital_int">Hospital</label>
                    <select class="form-control" id="fk_hospital_int" name="fk_hospital_int">
                        <option value="<?= $internacaos->fk_hospital_int ?>"><?= $internacao->nome_hosp ?></option>
                        <?php foreach ($hospitals as $hospital) : ?>
                            <option value="<?= $hospital['id_hospital'] ?>"><?= $hospital['nome_hosp'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group col-sm-3">
                    <label class="control-label" for="fk_paciente_int">Paciente</label>
                    <select class="form-control" id="fk_paciente_int" name="fk_paciente_int">
                        <option value="<?= $internacao->fk_paciente_int ?>"><?= $internacao->fk_paciente_int ?></option>
                        <?php foreach ($pacientes as $paciente) : ?>
                            <option value="<?= $paciente["nome_pac"] ?>"><?= $paciente["nome_pac"] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group col-sm-2">
                    <label class="control-label" for="data_intern_int">Data Internação</label>
                    <input type="date" class="form-control" id="data_intern_int" name="data_intern_int">
                </div>
                <div class="form-group col-sm-1">
                    <label for="acoes">Data da Visita</label>

                    <input type="text" class="form-control" value="<?php
                                                                    $hoje = date('d/m/Y');
                                                                    echo $hoje; ?>" id="data_create" name="data_create" placeholder="">
                </div>
                <div class="form-group col-sm-1">
                    <label class="control-label" for="internado_int">Internado</label>
                    <select class="form-control" id="internado_int" name="internado_int">
                        <option value="<?= $internacao->internado ?>"><?= $internacao->internado_int ?></option>
                        <option value="Sim">Sim</option>
                        <option value="Não">Não</option>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-sm-2">
                    <label class="control-label" for="acomodacao_int">Acomodação</label>
                    <select class="form-control" id="acomodacao_int" name="acomodacao_int">
                        <option value="<?= $internacao->acomodacao_int ?>"><?= $internacao->acomodacao_int ?></option>
                        <option value="UTI">UTI</option>
                        <option value="Semi">Semi</option>
                        <option value="Apto">Apto</option>
                        <option value="Enfermaria">Enfermaria</option>
                        <option value="Uco">Uco</option>
                        <option value="Maternidade">Maternidade</option>
                        <option value="Berçário">Berçário</option>
                    </select>
                </div>
                <div class="form-group col-sm-2">
                    <label class="control-label" for="especialidade">Especialidade</label>
                    <select class="form-control" id="especialidade" name="especialidade">
                        <option value="<?= $internacao->especialidade_int ?>"><?= $internacao->especialidade_int ?></option>
                        <option value="Ginecologia">Ginecologia</option>
                        <option value="Cardiologia">Cardiologia</option>
                        <option value="Ortopedia">Ortopedia</option>
                    </select>
                </div>
                <div class="form-group col-sm-3">
                    <label for="titular">Médico</label>
                    <input type="text" value="<?= $internacao->titular_int ?>" class="form-control" id="titular" name="titular" placeholder="Digite o nome do médico">
                </div>
                <div class="form-group col-sm-2">
                    <label class="control-label" for="tipo_admissao_int">Modo Admissão</label>
                    <select class="form-control" id="tipo_admissao_int" name="tipo_admissao_int">
                        <option value="<?= $internacao->tipo_admissao_int ?>"><?= $internacao->tipo_admissao_int ?></option>
                        <option value="Clínica">Clínica</option>
                        <option value="Pediatria">Pediatria</option>
                        <option value="Ortopedia">Ortopedia</option>
                        <option value="Obstetrícia">Obstetrícia</option>
                    </select>
                </div>
                <div class="form-group col-sm-2">
                    <label class="control-label" for="modo_internacao_int">Tipo Internação</label>
                    <select class="form-control" id="modo_internacao_int" name="modo_internacao_int">
                        <option value="<?= $internacao->modo_internacao_int ?>"><?= $internacao->modo_internacao_int ?></option>
                        <option value="Eletiva">Eletiva</option>
                        <option value="Urgência">Urgência</option>

                    </select>
                </div>
                <div class="form-group col-sm-2">
                    <label class="control-label" for="fk_patologia1_int">Patologia</label>
                    <select class="form-control" id="fk_patologia1_int" name="fk_patologia1_int">
                        <option value="<?= $internacao->fk_patologia_int ?>"><?= $internacao->fk_patologia_int ?></option>
                        <?php foreach ($patologias as $patologia) : ?>
                            <option value="<?= $patologia['id_patologia'] ?>"><?= $patologia["patologia_pat"] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group col-sm-2">
                    <label class="control-label" for="fk_patologia2">Patologia</label>
                    <select class="form-control" id="fk_patologia2" name="fk_patologia2">
                        <option value="<?= $internacao->fk_patologia2 ?>"><?= $internacao->fk_patologia2 ?></option>
                        <?php foreach ($patologias as $patologia) : ?>
                            <option value="<?= $patologia["id_patologia"] ?>"><?= $patologia["patologia_pat"] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group col-sm-2">
                    <label class="control-label" for="grupo_patologia_int">Grupo Patologia</label>
                    <select class="form-control" id="grupo_patologia_int" name="grupo_patologia_int">
                        <option value="<?= $internacao->grupo_patologia_int ?>"><?= $internacao->grupo_patologia_int ?></option>
                        <option value="Cardiológica">Cardiológica</option>
                        <option value="Pediatria">Pediatria</option>
                        <option value="Ortopedia">Ortopedia</option>
                        <option value="Obstetrícia">Obstetrícia</option>
                    </select>
                </div>

                <div class="form-group row">
                    <div>
                        <label for="rel_int">Relatório Auditoria</label>
                        <textarea type="textarea" value="<?= $internacao->rel_int ?>" class="form-control" id="rel_int" name="rel_int" placeholder="Relatório da auditoria"><?= $internacao->rel_int ?></textarea>
                    </div>
                    <div>
                        <label for="acoes_int">Ações Auditoria</label>
                        <textarea type="textarea" value="<?= $internacao->acoes_int ?>" class="form-control" id="acoes_int" name="acoes_int" placeholder="Ações de auditoria"><?= $internacao->acoes_int ?></textarea>
                    </div>

                </div>
                <br>
                <div> <button style="margin:10px" type="submit" class="btn-sm btn-info">Atualizar</button>
                </div>
                <br>
            </div>
        </form>
    </div>
</div>

<?php include_once("diversos/backbtn_internacao.php"); ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

<?php
require_once("templates/footer1.php");
