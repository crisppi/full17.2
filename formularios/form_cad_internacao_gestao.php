<div id="container-gestao" style="display:none">
    <br>
    <h4 class="page-title">Cadastrar gestão</h4>
    <p class="page-description">Adicione informações sobre a gestão que foi identificada</p>
    <form class="formulario" action="<?= $BASE_URL ?>process_gestao.php" id="add-acomodacao-form" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="type" value="create">
        <div class="form-group row">
            <?php
            $a = ($findMaxGesInt[0]);
            $ultimoReg = ($a["ultimoReg"]);
            ?>
            <div>
                <input type="hidden" class="form-control" id="fk_internacao_ges" name="fk_internacao_ges" value="<?= ($ultimoReg) ?> " placeholder="Relatório da auditoria">
            </div>
            <div class="form-group col-sm-2">
                <label for="alto_custo_ges">Alto Custo</label>
                <select class="form-control" id="alto_custo_ges" name="alto_custo_ges">
                    <option value="Não">Não</option>
                    <option value="Sim">Sim</option>
                </select>
            </div>
            <div style="display:none" id="div_rel_alto_custo">
                <label for="rel_alto_custo_ges">Relatório alto custo</label>
                <textarea type="textarea" rows="10" class="form-control" id="rel_alto_custo_ges" name="rel_alto_custo_ges" placeholder="Relatório da gestão alto custo"></textarea>
            </div>
            <div class="form-group col-sm-2">
                <label for="home_care_ges">Home care</label>
                <select class="form-control" id="home_care_ges" name="home_care_ges">
                    <option value="n">Não</option>
                    <option value="s">Sim</option>
                </select>
            </div>
            <div style="display:none" id="div_rel_home_care">
                <label for="rel_home_care">Relatório Home care</label>
                <textarea type="textarea" rows="10" class="form-control" id="rel_home_care" name="rel_home_care" placeholder="Relatório Home care"></textarea>
            </div>
            <div class="form-group col-sm-2">
                <label for="opme_ges">OPME</label>
                <select class="form-control" id="opme_ges" name="opme_ges">
                    <option value="n">Não</option>
                    <option value="s">Sim</option>
                </select>
            </div>
            <div style="display:none" id="div_rel_opme">
                <label for="rel_opme_ges">Relatório OPME</label>
                <textarea type="textarea" rows="10" class="form-control" id="rel_opme_ges" name="rel_opme_ges" placeholder="Relatório da gestão alto custo"></textarea>
            </div>
            <div class="form-group col-sm-2">
                <label for="desospitalizacao_ges">Desospitalização</label>
                <select class="form-control" id="desospitalizacao_ges" name="desospitalizacao_ges">
                    <option value="n">Não</option>
                    <option value="s">Sim</option>
                </select>
            </div>
            <div style="display:none" id="div_rel_desospitalizacao">
                <label for="rel_desospitalizacao_ges">Relatório Desospitalização</label>
                <textarea type="textarea" rows="10" class="form-control" id="rel_desospitalizacao_ges" name="rel_desospitalizacao_ges" placeholder="Relatório Desospitalização"></textarea>
            </div>
            <div class="form-group col-sm-2">
                <label for="evento_adverso_ges">Evento Adverso</label>
                <select class="form-control" id="evento_adverso_ges" name="evento_adverso_ges">
                    <option value="n">Não</option>
                    <option value="s">Sim</option>
                </select>
            </div>
            <div style="display:none" id="div_tipo_evento" class="form-group col-sm-2">
                <label for="tipo_evento_adverso_gest">Tipo Evento Adverso</label>
                <select class="form-control" id="tipo_evento_adverso_gest" name="tipo_evento_adverso_gest">
                    <?php
                    sort($dados_tipo_evento, SORT_ASC);
                    foreach ($dados_tipo_evento as $evento) { ?>
                        <option value="<?= $evento; ?>"><?= $evento; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div style="display:none" id="div_rel_evento">
                <label for="rel_evento_averso_ges">Relatório Evento Adverso</label>
                <textarea type="textarea" rows="10" class="form-control" id="rel_evento_averso_ges" name="rel_evento_averso_ges" placeholder="Relatório de Evento Adverso"></textarea>
            </div>
        </div>
        <br>
        <div>
            <button style="margin:10px" type="submit" class="btn-sm btn-info">Cadastrar</button>
        </div>
        <br>
    </form>
</div>
<script type="text/javascript">
    // JS PARA APARECER REL EVENTO ADVERSO
    var select_evento = document.querySelector('#evento_adverso_ges');

    select_evento.addEventListener('change', setEvento);

    function setEvento() {
        var choice_evento = select_evento.value;

        if (choice_evento === 'Sim') {

            if (div_rel_evento.style.display === "none") {
                div_rel_evento.style.display = "block";
                div_tipo_evento.style.display = "block";
            }

        }
        if (choice_evento === 'Não') {

            if (div_rel_evento.style.display === "block") {
                div_rel_evento.style.display = "none";
                div_tipo_evento.style.display = "none";
            }
        }
    }
    // JS PARA APARECER REL OPME
    var select_opme = document.querySelector('#opme_ges');

    select_opme.addEventListener('change', setOpme);

    function setOpme() {
        var choice_opme = select_opme.value;

        if (choice_opme === 'Sim') {

            if (div_rel_opme.style.display === "none") {
                div_rel_opme.style.display = "block";
            }

        }
        if (choice_opme === 'Não') {

            if (div_rel_opme.style.display === "block") {
                div_rel_opme.style.display = "none";
            }
        }
    }
    // JS PARA APARECER REL DESOSPITALIZACAO
    var select_desospitalizacao = document.querySelector('#desospitalizacao_ges');

    select_desospitalizacao.addEventListener('change', setdesospitalizacao);

    function setdesospitalizacao() {
        var choice_desospitalizacao = select_desospitalizacao.value;

        if (choice_desospitalizacao === 'Sim') {

            if (div_rel_desospitalizacao.style.display === "none") {
                div_rel_desospitalizacao.style.display = "block";
            }

        }
        if (choice_desospitalizacao === 'Não') {

            if (div_rel_desospitalizacao.style.display === "block") {
                div_rel_desospitalizacao.style.display = "none";
            }
        }
    }
    // JS PARA APARECER REL HOME CARE
    var select_home_care = document.querySelector('#home_care_ges');

    select_home_care.addEventListener('change', sethome_care);

    function sethome_care() {
        var choice_home_care = select_home_care.value;

        if (choice_home_care === 'Sim') {

            if (div_rel_home_care.style.display === "none") {
                div_rel_home_care.style.display = "block";
            }

        }
        if (choice_home_care === 'Não') {

            if (div_rel_home_care.style.display === "block") {
                div_rel_home_care.style.display = "none";
            }
        }
    }
    // JS PARA APARECER REL ALTO CUSTO
    var select_alto_custo = document.querySelector('#alto_custo_ges');

    select_alto_custo.addEventListener('change', setalto_custo);

    function setalto_custo() {
        var choice_alto_custo = select_alto_custo.value;

        if (choice_alto_custo === 'Sim') {

            if (div_rel_alto_custo.style.display === "none") {
                div_rel_alto_custo.style.display = "block";
            }

        }
        if (choice_alto_custo === 'Não') {

            if (div_rel_alto_custo.style.display === "block") {
                div_rel_alto_custo.style.display = "none";
            }
        }
    }
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>