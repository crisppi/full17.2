<div id="container-prorrog" class="container" style="display:none">
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
            <input type="hidden" class="form-control" id="fk_internacao_pror" name="fk_internacao_pror" value="<?= $ultimoReg ?>" placeholder="Relatório da auditoria">
        </div>
        <!-- PRORROGACAO 1 -->
        <div class="form-group row">
            <div class="form-group col-sm-2">
                <label class="control-label" for="acomod1_pror">Acomodação</label>
                <select class="form-control" id="acomod1_pror" name="acomod1_pror">
                    <option value=""></option>
                    <?php sort($dados_acomodacao, SORT_ASC);
                    foreach ($dados_acomodacao as $acomd) { ?>
                        <option value="<?= $acomd; ?>"><?= $acomd; ?></option>
                    <?php } ?>
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
                    <option value="Não">Não</option>
                    <option value="Sim">Sim</option>
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
                        <?php sort($dados_acomodacao, SORT_ASC);
                        foreach ($dados_acomodacao as $acomd) { ?>
                            <option value="<?= $acomd; ?>"><?= $acomd; ?></option>
                        <?php } ?>
                        ?>
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
        <div class="form-group-row">
            <div style="display:none" id="container-prog3">
                <div class="form-group col-sm-2">
                    <label class="control-label" for="acomod3_pror">Acomodação (3)</label>
                    <select class="form-control" id="acomod3_pror" name="acomod3_pror">
                        <option value=""></option>
                        <?php sort($dados_acomodacao, SORT_ASC);
                        foreach ($dados_acomodacao as $acomd) { ?>
                            <option value="<?= $acomd; ?>"><?= $acomd; ?></option>
                        <?php } ?>
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
                        <option value="Não">Não</option>
                        <option value="Sim">Sim</option>
                    </select>
                </div>
            </div>
        </div>
        <div>
            <button style="margin:10px" type="submit" class="btn-sm btn-info">Cadastrar</button>
        </div>

    </form>
    <div style="margin-top:-20px" class="formulario">
        <div style="display: inline-block; margin-left:10px; margin-bottom:10px" class="form-group col-sm-1">
            <button onclick="mostrarGrupo2('container-prog2')" style="color:blue; border:none; margin-top:15px; margin-right:10px" id="btn-gp1" class="bi bi-plus-square-fill edit-icon"> Adicione 2a</button>
        </div>
        <div style="display: inline-block; margin-left:30px" class="form-group col-sm-1">
            <button onclick="mostrarGrupo3('container-prog3')" style="color:blue; border:none; margin-top:15px; margin-right:10px" id="btn-gp1" class="bi bi-plus-square-fill edit-icon"> Adicione 3a</button>
        </div>
    </div>
</div>