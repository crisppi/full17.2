<div class="row">
    <h4 class="page-title">Cadastrar visita</h4>
    <p class="page-description">Adicione informações sobre a visita</p>

    <div id="view-contact-container" class="container-fluid" style="align-items:center">
        <hr>
        <span style="font-weight: 500; margin:0px 5px 0px 0px " class="card-title bold">Internação:</span>
        <span class="card-title bold" style="font-weight: 500; margin:0px 80px 0px 5px "><?= $id_internacao ?></span>
        <span style="font-weight: 500; margin:0px 5px 0px 80px">Hospital:</span>
        <span style=" font-weight: 500; margin:0px 10px 0px 0px"><?= $nome_hosp ?></span>
        <span style="font-weight: 500; margin:0px 5px 0px 80px">Paciente:</span>
        <span style=" font-weight: 500; margin:0px 10px 0px 0px"><?= $nome_pac ?></span>
        <span style="font-weight: 500; margin:0px 5px 0px 0px">Visita:</span>
        <span style="font-weight: 500; margin:0px 80px 0px 0px"><?= $data_intern_int ?></span>
        <br>
        <hr>
    </div>
    <form class="formulario" action="<?= $BASE_URL ?>process_visita.php" id="add-visita-form" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="type" value="create">

        <div class="form-group row">

            <div class="form-group col-sm-4">
                <label for="usuario_create">Usuário</label>
                <input type="text" class="form-control" class="form-control" id="usuario_create" value="<?= $_SESSION['email_user'] ?>" name="usuario_create">
            </div>

            <div class="form-group col-sm-4">
                <label for="fk_internacao_vis">ID Int</label>
                <input type="text" class="form-control" value="<?= $id_internacao ?>" id="fk_internacao_vis" name="fk_internacao_vis" placeholder="">
            </div>
            <div>
                <label for="rel_visita_vis">Relatório Auditoria</label>
                <textarea type="textarea" rows="10" class="form-control" id="rel_visita_vis" name="rel_visita_vis" placeholder="Relatório da auditoria"></textarea>
            </div>
            <div>
                <label for="acoes_int_vis">Ações Auditoria</label>
                <textarea type="textarea" rows="10" class="form-control" id="acoes_int_vis" name="acoes_int_vis" placeholder="Ações de auditoria"></textarea>
            </div>
            <!-- ENTRADA DE DADOS AUTOMATICOS NO INPUT-->
            <div class="form-group col-sm-1">
                <input type="hidden" class="form-control" value="n" id="internado_uti_int" name="internado_uti_int">
            </div>
            <div class="form-group col-sm-1">
                <input type="hidden" class="form-control" value="n" id="internacao_uti_int" name="internacao_uti_int">
            </div>
            <div class="form-group col-sm-1">
                <input type="hidden" class="form-control" value="s" id="primeira_vis_int" name="primeira_vis_int">
            </div>
            <div class="form-group col-sm-1">
                <input type="hidden" class="form-control" value="0" id="visita_no_vis" name="visita_no_vis">
            </div>
            <div class="form-group col-sm-1">
                <input type="hidden" class="form-control" value="n" id="conta_finalizada_int" name="conta_finalizada_int">
            </div>
            <div class="form-group col-sm-1">
                <input type="hidden" class="form-control" value="n" id="conta_paga_int" name="conta_paga_int">
            </div>
            <div class="form-group col-sm-1">
                <input type="hidden" class="form-control" value="s" id="internacao_ativa_int" name="internacao_ativa_int">
            </div>
            <div class="form-group col-sm-1">
                <input type="text" class="form-control" value="<?= ($_SESSION['id_usuario']) ?>" id="fk_usuario_vis" name="fk_usuario_vis">
            </div>
            <div class="form-group col-sm-1">
                <label>medico</label>

                <input type="text" class="form-control" value="<?= ($_SESSION['cargo']) ?>" id="fk_usuario_vis" name="fk_usuario_vis">
            </div>
            <div class="form-group col-sm-1">
                <label>login</label>

                <input type="text" class="form-control" value="<?= ($_SESSION['id_usuario']) ?>" id="fk_usuario_vis" name="fk_usuario_vis">
            </div>
            <div class="form-group col-sm-2">
                <label for="data_visita_vis">Data Visita</label>
                <?php $agora = date('d/m/Y'); ?>
                <input type="text" value='<?= $agora; ?>' class="form-control" id="data_visita_vis" name="data_visita_vis">
            </div>
            <div class="form-group col-sm-1">
                <input type="text" class="form-control" id="visita_enf_vis" name="visita_enf_vis" placeholder="<?php if (($_SESSION['cargo']) === 'Enf_auditor') {
                                                                                                                    echo 's';
                                                                                                                } else {
                                                                                                                    echo 'n';
                                                                                                                }; ?>" value="<?php if (($_SESSION['cargo']) === 'Enf_auditor') {
                                                                                                                                    echo 's';
                                                                                                                                } else {
                                                                                                                                    echo 'n';
                                                                                                                                }; ?>">
            </div>
            <div class="form-group col-sm-1">
                <input type="text" class="form-control" id="visita_med_vis" name="visita_med_vis" placeholder="<?php if (($_SESSION['cargo']) === 'Med_auditor') {
                                                                                                                    echo 's';
                                                                                                                } else {
                                                                                                                    echo 'n';
                                                                                                                }; ?>" value="<?php if (($_SESSION['cargo']) == 'Med_auditor') {
                                                                                                                                    echo 's';
                                                                                                                                } else {
                                                                                                                                    echo 'n';
                                                                                                                                }; ?>">
            </div>
            <div class="form-group col-sm-1">
                <input type="text" class="form-control" id="visita_auditor_prof_enf" name="visita_auditor_prof_enf" placeholder="<?php if (($_SESSION['cargo']) === 'Enf_auditor') {
                                                                                                                                        echo ($_SESSION['login_user']);
                                                                                                                                    }; ?>" value="<?php if (($_SESSION['cargo']) === 'Enf_auditor') {
                                                                                                                                                        echo ($_SESSION['login_user']);
                                                                                                                                                    }; ?>">
            </div>
            <?php if (($_SESSION['cargo']) === 'Med_auditor') {
            }; ?>
            <div class="form-group col-sm-1">
                <label>medico</label>
                <input type="text" class="form-control" id="visita_auditor_prof_med" name="visita_auditor_prof_med" placeholder="<?php if (($_SESSION['cargo']) == 'Med_auditor') {
                                                                                                                                        echo ($_SESSION['login_user']);
                                                                                                                                    }; ?>" value="<?php if (($_SESSION['cargo']) === 'Med_auditor') {
                                                                                                                                                        echo ($_SESSION['login_user']);
                                                                                                                                                    }; ?>">
            </div>

            <br>
        </div>
        <button style="margin:10px" type="submit" class="btn-sm btn-info">Cadastrar</button>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>