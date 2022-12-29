<?php
require_once("models/usuario.php");
require_once("models/acomodacao.php");
require_once("dao/usuarioDao.php");
require_once("dao/acomodacaoDao.php");
require_once("templates/header.php");
include_once("dao/hospitalDao.php");


$acomodacao = new acomodacao();
$userDao = new UserDAO($conn, $BASE_URL);
$acomodacaoDao = new acomodacaoDAO($conn, $BASE_URL);

$hospital_geral = new hospitalDAO($conn, $BASE_URL);
$hospitals = $hospital_geral->findGeral();

// Receber id do usuário
$id_acomodacao = filter_input(INPUT_GET, "id_acomodacao");

$acomodacao = $acomodacaoDao->joinAcomodacaoHospitalShow($id_acomodacao);
$acomodacaoData = $acomodacaoDao->findById($id_acomodacao);

?>

<!-- formulario update -->
<div id="main-container" class="container-fluid">
    <div class="row">
        <h1 class="page-title">Atualizar acomodação</h1>
        <p class="page-description">Selecione as informações sobre a acomodação</p>
        <form class="formulario" action="<?= $BASE_URL ?>process_acomodacao.php" id="add-movie-form" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="type" value="update">
            <div class="form-group row">

                <input type="hidden" class="form-control" id="id_acomodacao" name="id_acomodacao" value="<?= $acomodacao['id_acomodacao'] ?>" placeholder="ID">


                <div class="form-group col-sm-2">
                    <label class="control-label" for="fk_hospital">Acomodação</label>
                    <select class="form-control" style="overflow:visible" id="fk_hospital" name="fk_hospital">
                        <option value=<?= $acomodacao['acomodacaoNome'] ?>><?= $acomodacao['acomodacaoNome'] ?></option>
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
                    <label class="control-label" for="fk_hospital">Hospital</label>
                    <select class="form-control" id="fk_hospital" name="fk_hospital">
                        <option value="<?= $acomodacao['fk_hospital'] ?>"><?= $acomodacao['hospitalNome'] ?></option>

                        <?php foreach ($hospitals as $hospital) : ?>
                            <option value="<?= $hospital["id_hospital"] ?>"><?= $hospital["hospitalNome"] ?></option>
                        <?php endforeach; ?>
                    </select>

                </div>

                <div class="form-group col-sm-2">
                    <label for="valor_diaria">Valor Diária</label>
                    <input type="text" class="form-control" id="valor_diaria" value="<?= $acomodacao['valor_diaria'] ?>" name="valor_diaria" placeholder="Digite diária" required>
                </div>

                <div>
                    <button style="margin:10px" type="submit" class="btn-sm btn-info">Atualizar</button>
                </div>
            </div>
        </form>
    </div>
</div>


<?php include_once("diversos/backbtn_acomodacao.php"); ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

<?php
require_once("templates/footer1.php");
