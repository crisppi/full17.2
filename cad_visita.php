<?php
require_once("templates/header.php");
require_once("dao/visitaDao.php");
require_once("models/message.php");
include_once("models/hospital.php");
include_once("dao/hospitalDao.php");

$visitaDao = new visitaDAO($conn, $BASE_URL);
$hospital_geral = new hospitalDAO($conn, $BASE_URL);
$hospitals = $hospital_geral->findGeral();

// Receber id do usuário
$id_visita = filter_input(INPUT_GET, "id_visita");

if (empty($id_visita)) {

    if (!empty($userData)) {

        $id = $userData->id_visita;
    } else {

        //$message->setMessage("Usuário não encontrado!", "error", "index.php");
    }
} else {

    $userData = $userDao->findById($id_visita);

    // Se não encontrar usuário
    if (!$userData) {
        $message->setMessage("visita não encontrada!", "error", "index.php");
    }
}

?>
<div id="main-container" class="container-fluid">
    <div class="row">
        <h1 class="page-title">Cadastrar visita</h1>
        <p class="page-description">Adicione informações sobre a visita</p>
        <form class="formulario" action="<?= $BASE_URL ?>process_visita.php" id="add-visita-form" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="type" value="create">

            <div class="form-group row">
                <div class="form-group col-sm-2">
                    <label class="control-label" for="fk_hospital">Hospital</label>
                    <select class="form-control" id="fk_hospital" name="fk_hospital">
                        <option value=""></option>
                        <?php foreach ($hospitals as $hospital) : ?>
                            <option value="<?= $hospital["id_hospital"] ?>"><?= $hospital["nome_hosp"] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group row">

                    <div class="form-group col-sm-2">
                        <label class="control-label" for="nome_hosp">Acomodação</label>
                        <select class="form-control" id="nome_hosp" name="nome_hosp">
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
                        <label for="valor_aco">Valor Diária</label>
                        <!-- <input type="text" class="form-control" id="valor_diaria" onKeyPress="return(moeda(this,'.',',',event))" name="valor_diaria" placeholder="Digite o valor diária"> -->
                        <input type="text" class="form-control" id="valor_aco" name="valor_aco" placeholder="Digite o valor diária">
                    </div>
                    <div class="form-group col-sm-4">
                        <label for="usuario_create">Usuário</label>
                        <input type="text" class="form-control" id="usuario_create" value="Roberto" name="usuario_create" placeholder="Digite o usuário">
                    </div>

                    <div class="form-group col-sm-4">
                        <input class="oculto" type="date" type="hidden" class="form-control" value="15-08-2022" id="data_create" name="data_create" placeholder="">
                    </div>
                </div>
                <br>
                <br>
            </div>
            <button style="margin:10px" type="submit" class="btn-sm btn-info">Cadastrar</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

    <?php
    require_once("templates/footer1.php");
    ?>