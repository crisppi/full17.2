<div id="container-uti" class="container" style="display:none">
    <br>
    <h4 class="page-title">Cadastrar dados UTI</h4>
    <p class="page-description">Adicione informações sobre a gestão que foi identificada</p>
    <form class="formulario" action="<?= $BASE_URL ?>process_uti.php" id="add-acomodacao-form" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="type" value="create">

        <div class="form-group row">
            <?php
            $a = ($utiIdMax[0]);
            $ultimoReg = ($a["ultimoReg"]);
            ?>

            <div>
                <input type="hidden" class="form-control" id="fk_internacao_uti" name="fk_internacao_uti" value="<?= ($id_internacao) ?> " placeholder="Relatório da auditoria">
            </div>
            <div>
                <input type="hidden" class="form-control" id="fk_visita_uti" name="fk_visita_uti" value="<?= ($ultimoReg) ?> " placeholder="Relatório da auditoria">
            </div>

            <div class="form-group col-sm-2">
                <label for="internado_uti">Internado UTI</label>
                <select class="form-control" id="internado_uti" name="internado_uti">
                    <option value="Sim">Sim</option>
                    <option value="Não">Não</option>
                </select>
            </div>
            <div class="form-group col-sm-2">
                <label for="internacao_uti">Motivo UTI</label>
                <select class="form-control" id="motivo_uti" name="motivo_uti">
                    <option value=" ">Selecione o Motivo</option>
                    <?php
                    sort($dados_UTI, SORT_ASC);
                    foreach ($dados_UTI as $uti) { ?>
                        <option value="<?= $uti; ?>"><?= $uti; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group col-sm-2">
                <label for="internacao_uti">Justificativa UTI</label>
                <select class="form-control" id="just_uti" name="just_uti">
                    <option value="Pertinente">Pertinente</option>
                    <option value="Não pertinente">Não pertinente</option>
                </select>
            </div>
            <div class="form-group col-sm-2">
                <label for="criterio_uti">Critério UTI</label>
                <select class="form-control" id="criterio_uti" name="criterio_uti">
                    <?php
                    sort($criterios_UTI, SORT_ASC);
                    foreach ($criterios_UTI as $uti) { ?>
                        <option value="<?= $uti; ?>"><?= $uti; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group col-sm-2">
                <label for="data_internacao_uti">Data internação UTI</label>
                <input type="date" class="form-control" id="data_internacao_uti" name="data_internacao_uti">
            </div>

            <div class="form-group row">
                <div class="form-group col-sm-2">
                    <label for="vm_uti">VM</label>
                    <select class="form-control" id="vm_uti" name="vm_uti">
                        <option value="Não">Não</option>
                        <option value="Sim">Sim</option>
                    </select>
                </div>
                <div class="form-group col-sm-2">
                    <label for="dva_uti">DVA</label>
                    <select class="form-control" id="dva_uti" name="dva_uti">
                        <option value="Não">Não</option>
                        <option value="Sim">Sim</option>
                    </select>
                </div>
                <div class="form-group col-sm-2">
                    <label for="score_uti">Score</label>
                    <select class="form-control" id="score_uti" name="score_uti">
                        <option value="">Selecione o Score</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                </div>
                <div class="form-group col-sm-2">
                    <label for="saps_uti">Saps</label>
                    <select class="form-control" id="saps_uti" name="saps_uti">
                        <option value=" ">Selecione o SAPS</option>
                        <?php
                        sort($dados_saps, SORT_ASC);
                        foreach ($dados_saps as $saps) { ?>
                            <option value="<?= $saps; ?>"><?= $saps; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div style="margin-top:30px " class="form-group col-sm-2">
                    <a style="color:blue; font-size:0.8em" href="https://www.rccc.eu/ppc/indicadores/saps3.html" target="_blank">Calcular SAPS</a>
                </div>
            </div>
            <div>
                <label for="internacao_uti">Relatório UTI</label>
                <textarea type="textarea" rows="10" class="form-control" id="rel_uti" name="rel_uti" placeholder="Relatório da visita UTI"></textarea>
            </div>
        </div>
        <div>
            <button style="margin:10px" type="submit" class="btn-sm btn-success">Cadastrar</button>
        </div>
    </form>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
<script>
    src = "https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js";
</script>