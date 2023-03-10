<?php
include_once("check_logado.php");

require_once("templates/header.php");
include_once("models/internacao.php");
require_once("dao/internacaoDao.php");
require_once("models/message.php");

include_once("models/hospital.php");
include_once("dao/hospitalDao.php");

include_once("models/patologia.php");
include_once("dao/patologiaDao.php");

include_once("models/paciente.php");
require_once("dao/pacienteDAO.php");

include_once("models/gestao.php");
include_once("dao/gestaoDao.php");

include_once("models/prorrogacao.php");
include_once("dao/prorrogacaoDao.php");

include_once("models/uti.php");
include_once("dao/utiDao.php");

include_once("array_dados.php");

$internacaoDao = new internacaoDAO($conn, $BASE_URL);

$hospital_geral = new hospitalDAO($conn, $BASE_URL);
$hospitals = $hospital_geral->findGeral($limite, $inicio);

$pacienteDao = new pacienteDAO($conn, $BASE_URL);
$pacientes = $pacienteDao->findGeral($limite, $inicio);

$patologiaDao = new patologiaDAO($conn, $BASE_URL);
$patologias = $patologiaDao->findGeral();

$gestao = new gestaoDAO($conn, $BASE_URL);
$findMaxVis = $gestao->findMaxVis();

$uti = new utiDAO($conn, $BASE_URL);
$utiIdMax = $uti->findMaxUTI();

$prorrogacao = new prorrogacaoDAO($conn, $BASE_URL);
$prorrogacaoIdMax = $prorrogacao->findMaxPror();

$id_internacao = filter_input(INPUT_GET, 'id_internacao', FILTER_VALIDATE_INT);
$internacaoList = $internacaoDao->joininternacaoHospitalshow($id_internacao);
extract($internacaoList);
?>
<div id="main-container" class="container">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <!-- FORMULARIO INTERNACAO -->
    <?php include_once('formularios/form_cad_visita.php'); ?>

    <div>
        <button class="btn-primary" id="btn-prorrog">Prorrogação</button>
        <button class="btn-primary" id="btn-gestao">Gestão</button>
        <button class="btn-primary" id="btn-uti">UTI</button>
        <button class="btn-primary" id="btn-negoc">Negociações</button>
    </div>

    <!-- FORMULARIO DE GESTÃO -->
    <?php include_once('formularios/form_cad_visita_gestao.php'); ?>

    <!-- FORMULARIO DE UTI -->
    <?php include_once('formularios/form_cad_visita_uti.php'); ?>

    <!-- FORMULARIO DE PRORROGACOES -->
    <?php include_once('formularios/form_cad_visita_prorrog.php'); ?>

    <!-- <FORMULARO DE NEGOCIACOES -->
    <?php include_once('formularios/form_cad_visita_negoc.php'); ?>

    <script type="text/javascript">
        // script div de gestao -->

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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
    <?php
    require_once("templates/footer.php");
    ?>