<div id="container-uti" class="container" style="display:none">
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
                <input type="text" class="form-control" id="fk_internacao_uti" name="fk_internacao_uti" value="<?= ($ultimoReg) ?> " placeholder="Relatório da auditoria">
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