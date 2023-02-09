<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>

<body>
    <?php
    require_once("dao/internacaoDao.php");
    require_once("models/message.php");
    include_once("models/hospital.php");
    include_once("dao/hospitalDao.php");
    include_once("models/patologia.php");
    include_once("dao/patologiaDao.php");
    require_once("dao/pacienteDAO.php");

    $internacaoDAO = new internacaoDAO($conn, $base_url);
    $internacaoID = $internacaoDAO->findLastId();
    $internacaoID = $internacaoID['0'];

    $a = $internacaoID['0'];

    $niveis = $internacaoDAO->findLast($a);
    //Instanciar o metodo internacao   
    ?>

    <br>
    <h4>Prorrogando paciente</h4>
    <div id="view-contact-container" class="container-fluid" style="align-items:center">
        <span style="font-weight: 500; margin:0px 5px 0px 0px " class="card-title bold">Internação:</span>
        <span class="card-title bold" style="font-weight: 500; margin:0px 80px 0px 5px "><?= $niveis['0']['id_internacao'] ?></span>
        <span style="font-weight: 500; margin:0px 5px 0px 0px">Visita:</span>
        <span style="font-weight: 500; margin:0px 80px 0px 0px"><?= date("d/m/Y", strtotime($niveis['0']['data_visita_int']))  ?></span>
        <span style="font-weight: 500; margin:0px 5px 0px 80px">Hospital:</span>
        <span style=" font-weight: 500; margin:0px 10px 0px 0px"><?= $niveis['0']['fk_hospital_int'] ?></span>
        <br>
    </div>
    <br>

    <hr>
    <div>
        <button class="btn-primary" id="btn-prorrog">Prorrogação</button>
        <button class="btn-primary" id="btn-gestao">Gestão</button>
        <button class="btn-primary" id="btn-uti">UTI</button>
        <button class="btn-primary" id="btn-negoc">Negociações</button>
    </div>

    <!-- FORMULARIO DE GESTÃO -->

    <?php include_once('formularios/form_cad_internacao_gestao.php'); ?>

    <!-- FORMULARIO DE UTI -->
    <?php include_once('formularios/form_cad_internacao_uti.php'); ?>

    <!-- FORMULARIO DE PRORROGACOES -->
    <?php include_once('formularios/form_cad_internacao_prorrog.php'); ?>

    <!-- <FORMULARO DE NEGOCIACOES -->
    <?php include_once('formularios/form_cad_internacao_negoc.php'); ?>


    <?php include_once("diversos/backbtn_internacao.php"); ?>

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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
    <?php
    require_once("templates/footer.php");
    ?>
</body>

</html>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>