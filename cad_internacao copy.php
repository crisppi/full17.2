<?php
include_once("globals.php");

require_once("templates/header.php");
require_once("dao/internacaoDao.php");
require_once("models/message.php");
include_once("models/hospital.php");
include_once("dao/hospitalDao.php");
include_once("models/patologia.php");
include_once("dao/patologiaDao.php");
require_once("dao/pacienteDAO.php");
include_once("models/gestao.php");
include_once("dao/gestaoDao.php");


$internacaoDao = new internacaoDAO($conn, $BASE_URL);
$hospital_geral = new hospitalDAO($conn, $BASE_URL);
$hospitals = $hospital_geral->findGeral();
$pacienteDao = new pacienteDAO($conn, $BASE_URL);
$pacientes = $pacienteDao->findGeral();
$patologiaDao = new patologiaDAO($conn, $BASE_URL);
$patologias = $patologiaDao->findGeral();
$gestao = new gestaoDAO($conn, $BASE_URL);
$gestaoIdMax = $gestao->findMax();

// Receber id do usuário
$id_internacao = filter_input(INPUT_GET, "id_internacao");

if (empty($id_internacao)) {

    if (!empty($userData)) {

        $id = $userData->id_internacao;
    } else {

        //$message->setMessage("Usuário não encontrado!", "error", "index.php");
    }
} else {

    $userData = $userDao->findById($id_internacao);

    // Se não encontrar usuário
    if (!$userData) {
        $message->setMessage("internacao não encontrada!", "error", "index.php");
    }
}

?>
<div id="main-container" class="container-fluid">
    <div class="row">

        <h2 class="page-title">Cadastrar internação</h2>
        <p class="page-description">Adicione informações sobre a internação</p>
        <form class="formulario visible" action="<?= $BASE_URL ?>process_internacao.php" id="add-internacao-form" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="type" value="create">

            <div class="form-group row">
                <div class="form-group col-sm-3">
                    <label class="control-label col-sm-3 " for="fk_hospital_int">Hospital</label>
                    <select class="form-control" id="fk_hospital_int" name="fk_hospital_int">
                        <option value="<?= $hospital["nome_hosp"] ?>"></option>
                        <?php foreach ($hospitals as $hospital) : ?>
                            <option value="<?= $hospital["id_hospital"] ?>"><?= $hospital["nome_hosp"] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group col-sm-3">
                    <label class="control-label" for="fk_paciente_int">Paciente</label>
                    <select class="form-control" id="fk_paciente_int" name="fk_paciente_int">
                        <option value=""></option>
                        <?php foreach ($pacientes as $paciente) : ?>
                            <option value="<?= $paciente["id_paciente"] ?>"><?= $paciente["nome_pac"] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group col-sm-2">
                    <label class="control-label" for="data_intern_int">Data Internação</label>
                    <input type="date" class="form-control" id="data_intern_int" name="data_intern_int">
                </div>
                <div class="form-group col-sm-1">
                    <label for="data_visita_int">Data da Visita</label>
                    <input type="date" class="form-control" id="data_visita_int" name="data_visita_int">
                </div>
                <div class="form-group col-sm-1">
                    <label class="control-label" for="internado_int">Internado</label>
                    <select class="form-control" id="internado_int" name="internado_int">
                        <option value="">Sim</option>
                        <option value="Sim">Sim</option>
                        <option value="Não">Não</option>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-sm-2">
                    <label class="control-label" for="acomodacao_int">Acomodação</label>
                    <select class="form-control" id="acomodacao_int" name="acomodacao_int">
                        <option value=""></option>
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
                    <label class="control-label" for="especialidade_int">Especialidade</label>
                    <select class="form-control" id="especialidade_int" name="especialidade_int">
                        <option value=""></option>
                        <option value="Ginecologia">Ginecologia</option>
                        <option value="Cardiologia">Cardiologia</option>
                        <option value="Ortopedia">Ortopedia</option>
                    </select>
                </div>
                <div class="form-group col-sm-3">
                    <label for="titular_int">Médico</label>
                    <input type="text" class="form-control" id="titular_int" name="titular_int" placeholder="Digite o nome do médico">
                </div>
                <div class="form-group col-sm-2">
                    <label class="control-label" for="modo_internacao_int">Modo Admissão</label>
                    <select class="form-control" id="modo_internacao_int" name="modo_internacao_int">
                        <option value=""></option>
                        <option value="Clínica">Clínica</option>
                        <option value="Pediatria">Pediatria</option>
                        <option value="Ortopedia">Ortopedia</option>
                        <option value="Obstetrícia">Obstetrícia</option>
                    </select>
                </div>
                <div class="form-group col-sm-2">
                    <label class="control-label" for="modo_internacao_int">Tipo Internação</label>
                    <select class="form-control" id="modo_internacao_int" name="modo_internacao_int">
                        <option value=""></option>
                        <option value="Eletiva">Eletiva</option>
                        <option value="Urgência">Urgência</option>

                    </select>
                </div>
                <div class="form-group col-sm-2">
                    <label class="control-label" for="fk_patologia_int">Patologia</label>
                    <select class="form-control" id="fk_patologia_int" name="fk_patologia_int">
                        <option value=""></option>
                        <?php foreach ($patologias as $patologia) : ?>
                            <option value="<?= $patologia["id_patologia"] ?>"><?= $patologia["patologia_pat"] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group col-sm-2">
                    <label class="control-label" for="fk_patologia2">Patologia</label>
                    <select class="form-control" id="fk_patologia2" name="fk_patologia2">
                        <option value=""></option>
                        <?php foreach ($patologias as $patologia) : ?>
                            <option value="<?= $patologia["id_patologia"] ?>"><?= $patologia["patologia_pat"] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group col-sm-2">
                    <label class="control-label" for="grupo_patologia_int">Grupo Patologia</label>
                    <select class="form-control" id="grupo_patologia_int" name="grupo_patologia_int">
                        <option value=""></option>
                        <option value="Cardiológica">Cardiológica</option>
                        <option value="Pediatria">Pediatria</option>
                        <option value="Ortopedia">Ortopedia</option>
                        <option value="Obstetrícia">Obstetrícia</option>
                    </select>
                </div>

                <div class="form-group row">

                    <div>
                        <label for="rel_int">Relatório Auditoria</label>
                        <textarea type="textarea" rows="10" class="form-control" id="rel_int" name="rel_int" placeholder="Relatório da auditoria"></textarea>
                    </div>
                    <div>
                        <label for="acoes_int">Ações Auditoria</label>
                        <textarea type="textarea" rows="10" class="form-control" id="acoes_int" name="acoes_int" placeholder="Ações de auditoria"></textarea>
                    </div>
                </div>
                <br>
                <div> <button style="margin:10px" type="submit" class="btn-sm btn-info">Cadastrar</button>
                </div>
                <br>
            </div>
        </form>

    </div>

    <div>
        <button class="btn-primary" id="btn-prorrog">Prorrogação</button>
        <button class="btn-primary" id="btn-gestao">Gestão</button>
        <button class="btn-primary" id="btn-uti">UTI</button>
        <button class="btn-primary" id="btn-negoc">Negociações</button>
    </div>

    <!-- DIV DE GESTÃO -->
    <div id="container-gestao" style="display:none">
        <br>
        <h4 class="page-title">Cadastrar gestão</h4>
        <p class="page-description">Adicione informações sobre a gestão que foi identificada</p>
        <form class="formulario" action="<?= $BASE_URL ?>process_gestao.php" id="add-acomodacao-form" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="type" value="create">


            <div class="form-group row">
                <?php
                $a = ($gestaoIdMax[0]);
                $ultimoReg = ($a["ultimoReg"]);
                ?>
                <div>
                    <label for="fk_internacao_ges">ID Int</label>
                    <input type="text" class="form-control" id="fk_internacao_ges" name="fk_internacao_ges" value="<?= ($ultimoReg) + 1 ?> " placeholder="Relatório da auditoria">
                </div>

                <div class="form-group col-sm-2">
                    <label for="alto_custo_ges">Alto Custo</label>
                    <select class="form-control" id="alto_custo_ges" name="alto_custo_ges">
                        <option value="Sim">Sim</option>
                        <option value="Não">Não</option>
                    </select>
                </div>
                <div>
                    <label for="rel_alto_custo_ges">Relatório alto custo</label>
                    <textarea type="textarea" rows="10" class="form-control" id="rel_alto_custo_ges" name="rel_alto_custo_ges" placeholder="Relatório da gestão alto custo"></textarea>
                </div>
            </div>
            <br>
            <div>
                <button style="margin:10px" type="submit" class="btn-sm btn-info">Cadastrar</button>
            </div>
            <br>
        </form>


        </script>
    </div>

    <!-- DIV DE UTI -->
    <div id="container-uti" class="formulario" style="display:none">
        <br>
        <h4 class="page-title">Cadastrar dados UTI</h4>
        <p class="page-description">Adicione informações sobre a gestão que foi identificada</p>
        <form class="formulario" action="<?= $BASE_URL ?>process_uti.php" id="add-acomodacao-form" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="type" value="create">


            <div class="form-group row">
                <?php
                $a = ($gestaoIdMax[0]);
                $ultimoReg = ($a["ultimoReg"]);
                ?>
                <div>
                    <label for="fk_internacao_ges">ID Int</label>
                    <input type="text" class="form-control" id="fk_internacao_uti" name="fk_internacao_uti" value="<?= ($ultimoReg) + 1 ?> " placeholder="Relatório da auditoria">
                </div>

                <div class="form-group col-sm-2">
                    <label for="internacao_uti">Internação UTI</label>
                    <select class="form-control" id="internacao_uti" name="internacao_uti">
                        <option value="Sim">Sim</option>
                        <option value="Não">Não</option>
                    </select>
                </div>
                <div class="form-group col-sm-2">
                    <label for="internacao_uti">Motivo UTI</label>
                    <select class="form-control" id="motivo_uti" name="motivo_uti">
                        <option value="Insuficência respiratória">Insuficência respiratória</option>
                        <option value="Choque cardiogênico">Choque cardiogênico</option>
                        <option value="Choque séptico">Choque séptico</option>
                        <option value="Distúrbio metabólico">Distúrbio metabólico</option>
                    </select>
                </div>
                <div class="form-group col-sm-2">
                    <label for="internacao_uti">Justificativa UTI</label>
                    <select class="form-control" id="just_uti" name="just_uti">
                        <option value="Pertinente">Pertinente</option>
                        <option value="Não pertinente">Não pertinente</option>
                    </select>
                </div>
                <div>
                    <label for="internacao_uti">Relatório UTI</label>
                    <textarea type="textarea" rows="10" class="form-control" id="rel_uti" name="rel_uti" placeholder="Relatório da visita UTI"></textarea>
                </div>
            </div>
            <br>
            <div>

                <button style="margin:10px" type="submit" class="btn-sm btn-info">Cadastrar</button>
            </div>
            <br>
        </form>
    </div>
    <!-- div de prorrogacoes -->
    <div id="container-prorrog" style="display:none">
        <br>
        <h4 class="page-title">Cadastrar dados de prorrogação</h4>
        <p class="page-description">Adicione informações sobre as diárias da prorrogação</p>
        <form class="formulario" action="<?= $BASE_URL ?>process_prorrogacao.php" id="add-prorrogacao-form" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="type" value="create">
            <div class="form-group col-sm-1">
                <?php
                $a = ($gestaoIdMax[0]);
                $ultimoReg = ($a["ultimoReg"]);
                ?>
                <label for="fk_internacao_pror">ID Int</label>
                <input type="text" class="form-control" id="fk_internacao_pror" name="fk_internacao_pror" value="<?= ($ultimoReg) + 1 ?> " placeholder="Relatório da auditoria">
            </div>
            <!-- PRORROGACAO 2 -->
            <div class="form-group row">
                <div class="form-group col-sm-2">
                    <label class="control-label" for="acomod1_pror">Acomodação</label>
                    <select class="form-control" id="acomod1_pror" name="acomod1_pror">
                        <option value=""></option>
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
                    <label class="control-label" for="prorrog1_ini_pror">Data inicial (1)</label>
                    <input type="date" class="form-control" id="prorrog1_ini_pror" name="prorrog1_ini_pror">
                </div>
                <div class="form-group col-sm-2">
                    <label class="control-label" for="prorrog1_fim_pror">Data final (1)</label>
                    <input type="date" class="form-control" id="prorrog1_fim_pror" name="prorrog1_fim_pror">
                </div>
                <div class="form-group col-sm-1">
                    <label class="control-label" for="isol_1_pror">Isolamento</label>
                    <select class="form-control" id="isol_1_pror" name="isol_1_pror">
                        <option value="Sim">Sim</option>
                        <option value="Sim">Sim</option>
                        <option value="Não">Não</option>
                    </select>
                </div>
            </div>
            <!-- PRORROGACAO 2  -->
            <div class="form-group-row">
                <div style="display:none" id="container-prog2">
                    <div class="form-group col-sm-2">
                        <label class="control-label" for="acomod2_pror">Acomodação</label>
                        <select class="form-control" id="acomod2_pror" name="acomod2_pror">
                            <option value=""></option>
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
                        <label class="control-label" for="prorrog2_ini_pror">Data inicial (2)</label>
                        <input type="date" class="form-control" id="prorrog2_ini_pror" name="prorrog2_ini_pror">
                    </div>
                    <div class="form-group col-sm-2">
                        <label class="control-label" for="prorrog2_fim_pror">Data final (2)</label>
                        <input type="date" class="form-control" id="prorrog2_fim_pror" name="prorrog2_fim_pror">
                    </div>
                    <div class="form-group col-sm-1">
                        <label class="control-label" for="isol_2_pror">Isolamento</label>
                        <select class="form-control" id="isol_2_pror" name="isol_2_pror">
                            <option value="Sim">Sim</option>
                            <option value="Sim">Sim</option>
                            <option value="Não">Não</option>
                        </select>
                    </div>
                </div>
            </div>
            <!-- PRORROGACAO 3 -->
            <div class="form-group row" style="display:none" id="container-prog3">
                <div class="form-group col-sm-2">
                    <label class="control-label" for="acomod3_pror">Acomodação (3)</label>
                    <select class="form-control" id="acomod3_pror" name="acomod3_pror">
                        <option value=""></option>
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
                    <label class="control-label" for="prorrog3_ini_pror">Data inicial (3)</label>
                    <input type="date" class="form-control" id="prorrog3_ini_pror" name="prorrog3_ini_pror">
                </div>
                <div class="form-group col-sm-2">
                    <label class="control-label" for="prorrog3_fim_pror">Data final (3)</label>
                    <input type="date" class="form-control" id="prorrog3_fim_pror" name="prorrog3_fim_pror">
                </div>
                <div class="form-group col-sm-1">
                    <label class="control-label" for="isol_3_pror">Isolamento</label>
                    <select class="form-control" id="isol_3_pror" name="isol_3_pror">
                        <option value="Sim">Sim</option>
                        <option value="Sim">Sim</option>
                        <option value="Não">Não</option>
                    </select>
                </div>
            </div>

            <div>
                <button style="margin:10px" type="submit" class="btn-sm btn-info">Cadastrar</button>
            </div>
        </form>
        <div style="display: inline-block; margin-left:30px" class="form-group col-sm-1">
            <button onclick="mostrarGrupo2('container-prog2')" style="color:blue; border:none; margin-top:85px; margin-right:10px" id="btn-gp1" class="bi bi-plus-square-fill edit-icon"> Adicione 2a</button>
        </div>
        <div style="display: inline-block; margin-left:30px" class="form-group col-sm-1">
            <button onclick="mostrarGrupo3('container-prog3')" style="color:blue; border:none; margin-top:85px; margin-right:10px" id="btn-gp1" class="bi bi-plus-square-fill edit-icon"> Adicione 3a</button>
        </div>
        <br>
    </div>

    <!-- <div de negociacoes -->
    <div id="container-negoc" class="formulario" style="display:none">
        negociações

    </div>

    <script type="text/javascript">
        // script div  de gestao -->

        var btn = document.querySelector("#btn-gestao");

        btn.addEventListener("click", function() {

            var divGes = document.querySelector("#container-gestao");
            var divPro = document.querySelector("#container-prorrog");
            var divUti = document.querySelector("#container-uti");
            var divNeg = document.querySelector("#container-negoc");


            if (divGes.style.display === "none") {
                divGes.style.display = "block";
                divPro.style.display = "none";
                divUti.style.display = "none";
                divNeg.style.display = "none";

            } else {
                divGes.style.display = "none";
            }

        });

        // Script div de prorrogacoes
        var btn = document.querySelector("#btn-prorrog");

        btn.addEventListener("click", function() {

            var divGes = document.querySelector("#container-gestao");
            var divPro = document.querySelector("#container-prorrog");
            var divUti = document.querySelector("#container-uti");
            var divNeg = document.querySelector("#container-negoc");

            if (divPro.style.display === "none") {
                divPro.style.display = "block";
                divGes.style.display = "none";
                divUti.style.display = "none";
                divNeg.style.display = "none";

            } else {
                div.style.display = "none";
            }

        });
        // Script div de uti

        var btn = document.querySelector("#btn-uti");

        btn.addEventListener("click", function() {
            var divGes = document.querySelector("#container-gestao");
            var divPro = document.querySelector("#container-prorrog");
            var divUti = document.querySelector("#container-uti");
            var divNeg = document.querySelector("#container-negoc");

            if (divUti.style.display === "none") {
                divUti.style.display = "block";
                divPro.style.display = "none";
                divGes.style.display = "none";
                divNeg.style.display = "none";

            } else {
                div.style.display = "none";
            }

        });
        // Script div de negociacoes
        var btn = document.querySelector("#btn-negoc");

        btn.addEventListener("click", function() {
            var divGes = document.querySelector("#container-gestao");
            var divPro = document.querySelector("#container-prorrog");
            var divUti = document.querySelector("#container-uti");
            var divNeg = document.querySelector("#container-negoc");

            if (divNeg.style.display === "none") {
                divNeg.style.display = "block";
                divPro.style.display = "none";
                divUti.style.display = "none";
                divGes.style.display = "none";

            } else {
                div.style.display = "none";
            }

        });

        // div de botao prorrog 1
        // var btn2 = document.querySelector("#btn-gp1");

        // btn2.addEventListener("mouseover", function() {

        //     var divGp1 = document.querySelector("#container-prog2");

        //     if (divGp1.style.display === "none") {
        //         divGp1.style.display = "block";

        //     } else {
        //         divGp1.style.display = "none";
        //     }
        // });
        //*** ADICIONAR PRORROGACAO */
        function mostrarGrupo2(el) {
            var display = document.getElementById(el).style.display;
            if (display == "none")
                document.getElementById(el).style.display = 'flex';
            else
                document.getElementById(el).style.display = 'none';
        }

        function mostrarGrupo3(el) {
            var display = document.getElementById(el).style.display;
            if (display == "none")
                document.getElementById(el).style.display = 'block';
            else
                document.getElementById(el).style.display = 'none';
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

    <?php
    require_once("templates/footer.php");
    ?>