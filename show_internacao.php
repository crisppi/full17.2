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
    include_once("globals.php");
    include_once("templates/header.php");

    require_once("templates/header.php");
    require_once("dao/internacaoDao.php");
    require_once("models/message.php");
    include_once("models/hospital.php");
    include_once("dao/hospitalDao.php");
    include_once("models/patologia.php");
    include_once("dao/patologiaDao.php");
    require_once("dao/pacienteDAO.php");


    // Pegar o id do paceinte
    $id_internacao = filter_input(INPUT_GET, "id_internacao", FILTER_SANITIZE_NUMBER_INT);

    $internacao;

    $internacaoDao = new internacaoDAO($conn, $BASE_URL);

    //Instanciar o metodo internacao   
    $internacao = $internacaoDao->joininternacaoHospitalshow($id_internacao);
    ?><span><button type="submit" style="margin-left:3px; font-size: 25px; background:transparent; border-color:transparent; color:green" class="delete-btn"><i class="d-inline-block fas fa-eye check-icon"></i></button>
        <h4 style="margin-top:10px; margin-left:20px">Dados da internação do paciente: <?= $internacao['nome_pac'] ?></h4>
    </span>
    <br>

    <br>
    <div class="card-header container-fluid" id="view-contact-container">
        <span style="font-weight: 500;" class="card-title bold">Internação:</span>
        <span class="card-title bold"><?= $internacao['id_internacao'] ?></span>
        <br>
    </div>
    <div class="card-header container-fluid" id="view-contact-container">
        <span style="font-weight: 500;" class="card-title bold">Visita:</span>
        <span class="card-title bold"><?= date("d/m/Y", strtotime($internacao['data_visita_int']))  ?></span>
        <br>
    </div>
    <div class="card-body">

        <span style="font-weight: 500;" class=" card-text bold">Hospital:</span>
        <span class=" card-text bold"><?= $internacao['nome_hosp'] ?></span>
        <br>
        <span style="font-weight: 500;" class=" card-text bold">Data Internação:</span>
        <span class=" card-text bold"><?= $internacao['data_intern_int'] ?></span>
        <br>
        <span style="font-weight: 500;" class=" card-text bold">Tipo Internação:</span>
        <span class=" card-text bold"><?= $internacao['tipo_admissao_int'] ?></span>
        <br>
        <span style="font-weight: 500;" class=" card-text bold">Modo Admissão:</span>
        <span class=" card-text bold"><?= $internacao['modo_internacao_int'] ?></span>
        <br>
        <span style="font-weight: 500;" class=" card-text bold">Patologia:</span>
        <span class=" card-text bold"><?= $internacao['patologia_pat'] ?></span>
        <br>

        <span style="font-weight: 500;" class=" card-text bold">Especialidade:</span>
        <span class=" card-text bold"><?= $internacao['especialidade_int'] ?></span>
        <br>
        <span style="font-weight: 500;" class=" card-text bold">Grupo Patologia:</span>
        <span class=" card-text bold"><?= $internacao['grupo_patologia_int'] ?></span>
        <br>
        <span style="font-weight: 500;" class=" card-text bold">Médico:</span>
        <span class=" card-text bold"><?= $internacao['titular_int'] ?></span>


        <hr>
        <span style="font-weight: 500;" class=" card-text bold">Relatório auditoria:</span>
        <span class=" card-text bold"><?= $internacao['rel_int'] ?></span>
        <hr>
        <span style="font-weight: 500;" class=" card-text bold">Ações da auditoria:</span>
        <span class=" card-text bold"><?= $internacao['acoes_int'] ?></span>
        <br>
    </div>

    </div>
    <?php include_once("diversos/backbtn_internacao.php"); ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

    <?php
    include_once("templates/footer.php"); ?>
</body>

</html>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>