<div id="container-negoc" class="formulario" style="display:none">
    <br>
    <h4 class="page-title">Cadastrar dados de prorrogação</h4>
    <p class="page-description">Adicione informações sobre as negociações</p>
    <form class="formulario" action="<?= $BASE_URL ?>process_negociacao.php" id="add-negociacao-form" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="type" value="create">
        <div class="form-group col-sm-1">
            <?php

            $a = ($gestaoIdMax[0]);
            $ultimoReg = ($a["ultimoReg"]);
            $lastId = $ultimoReg;
            // $negociacaoGeral = $negociacao->findGeral();
            $findMaxInt = $negociacaoLast->findByLastId($lastId);

            ?>
            <input type="hidden" class="form-control" id="fk_id_int" name="fk_id_int" value="<?= $ultimoReg ?>" placeholder="Relatório da auditoria">
        </div>

        <!-- PRORROGACAO 1 -->
        <div class="form-group row">
            <div class="form-group col-sm-2">
                <label class="control-label" for="troca_de_1">Acomodação Solicitada</label>
                <select class="form-control" id="troca_de_1" name="troca_de_1">
                    <option value="">Selecione acomodação</option>
                    <?php sort($dados_acomodacao, SORT_ASC);
                    foreach ($dados_acomodacao as $acomd) { ?>
                        <option value="<?= $acomd; ?>"><?= $acomd; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group col-sm-2">
                <label class="control-label" for="troca_para_1">Acomodação Liberada</label>
                <select class="form-control" id="troca_para_1" name="troca_para_1">
                    <option value="">Selecione acomodação</option>
                    <?php sort($dados_acomodacao, SORT_ASC);
                    foreach ($dados_acomodacao as $acomd) { ?>
                        <option value="<?= $acomd; ?>"><?= $acomd; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group col-sm-2">
                <label class="control-label" for="qtd_1">Qtd (1)</label>
                <input type="number" style="font-size:0.8em" class="form-control" id="qtd_1" name="qtd_1" min="1" max="30">
            </div>


        </div>
        <!-- PRORROGACAO 2  -->
        <div class="form-group-row">
            <div style="display:none" id="container-prog2">
                <div class="form-group col-sm-2">
                    <label class="control-label" for="acomod2_pror">Acomodação</label>
                    <select class="form-control" id="acomod2_pror" name="acomod2_pror">
                        <option value="">Selecione acomodação</option>
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
                        <option value="s">Sim</option>
                        <option value="s">Sim</option>
                        <option value="n">Não</option>
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
                        <option value="">Selecione acomodação</option>
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
                        <option value="n">Não</option>
                        <option value="s">Sim</option>
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
            <button onclick="mostrarGrupo2('container-prog2')" style="color:blue; font-size:0.8em; border:none; margin-top:15px; margin-right:10px" id="btn-gp1" class="bi bi-plus-square-fill edit-icon"> 2ª acomod</button>
        </div>
        <div style="display: inline-block; margin-left:30px" class="form-group col-sm-1">
            <button onclick="mostrarGrupo3('container-prog3')" style="color:blue; font-size:0.8em;border:none; margin-top:15px; margin-right:10px" id="btn-gp1" class="bi bi-plus-square-fill edit-icon"> 3ª acomod</button>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>