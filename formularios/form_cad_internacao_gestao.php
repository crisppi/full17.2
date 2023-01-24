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
                <input type="text" class="form-control" id="fk_internacao_ges" name="fk_internacao_ges" value="<?= ($ultimoReg) ?> " placeholder="Relatório da auditoria">
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
</div>