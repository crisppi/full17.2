<div class="row">

    <h2 class="page-title">Lançar capeante</h2>
    <p class="page-description">Adicione informações do Capeante</p>

    <form class="formulario visible" action="<?= $BASE_URL ?>process_capeante.php" id="add-internacao-form" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="type" value="create">
        <br>

        <div class="form-group row">
            <div class="form-group col-sm-2">
                <input type="text" class="form-control" id="adm_capeante" name="adm_capeante" placeholder="Digite adm">
            </div>
        </div>
        <br>

        <div class="form-group row">
            <div class="form-group col-sm-2">
                <input type="text" class="form-control" id="valor_diarias" name="valor_apresentado_capeante" placeholder="Valor apresentado">
            </div>
            <div class="form-group col-sm-2">
                <input type="text" class="form-control" id="valor_final_capeante" name="valor_final_capeante" placeholder="Valor final">
            </div>
        </div>
        <br>
        <!-- campos de dados gerais  -->
        <div class="form-group row">
            <div class="form-group col-sm-2">
                <label for="data_inicial_capeante">Data Inicial</label>
                <input type="date" class="form-control" id="data_inicial_capeante" name="data_inicial_capeante">
            </div>
            <div class="form-group col-sm-2">
                <label for="data_final_conta">Data Final</label>
                <input type="date" class="form-control" id="data_final_conta" name="data_final_conta">
            </div>
            <div class="form-group col-sm-2">
                <label for="diarias_capeante">Diárias</label>
                <input type="text" class="form-control" id="diarias_capeante" name="diarias_capeante">
            </div>

            <div class="form-group col-sm-2">
                <label for="data_fech_capeante">Data Fechamento</label>
                <input type="date" class="form-control" id="data_fech_capeante" name="data_fech_capeante">
            </div>
        </div>
        <br>
        <div class="form-group row">

            <div class="form-group col-sm-2">
                <input type="text" class="form-control" id="valor_matmed" name="valor_matmed" placeholder="Valor MatMed">
            </div>
            <div class="form-group col-sm-2">
                <input type="text" class="form-control" id="valor_oxig" name="valor_oxig" placeholder="Valor Oxigenioterapia">
            </div>
            <div class="form-group col-sm-2">
                <input type="text" class="form-control" id="valor_sadt" name="valor_sadt" placeholder="Valor taxas">
            </div>
            <div class="form-group col-sm-2">
                <input type="text" class="form-control" id="valor_taxa" name="valor_taxa" placeholder="Valor SADT">
            </div>
            <div class="form-group col-sm-2">
                <input type="text" class="form-control" id="valor_honorarios" name="valor_honorarios" placeholder="Valor honorários">
            </div>
        </div>
        <br>
        <!-- campos de valor apresentado -->
        <div class="form-group row">
            <div class="form-group col-sm-2">
                <input type="text" class="form-control" id="valor_diarias" name="valor_diarias" placeholder="Valor diárias">
            </div>
            <div class="form-group col-sm-2">
                <input type="text" class="form-control" id="valor_matmed" name="valor_matmed" placeholder="Valor MatMed">
            </div>
            <div class="form-group col-sm-2">
                <input type="text" class="form-control" id="valor_oxig" name="valor_oxig" placeholder="Valor Oxigenioterapia">
            </div>
            <div class="form-group col-sm-2">
                <input type="text" class="form-control" id="valor_sadt" name="valor_sadt" placeholder="Valor taxas">
            </div>
            <div class="form-group col-sm-2">
                <input type="text" class="form-control" id="valor_taxa" name="valor_taxa" placeholder="Valor SADT">
            </div>
            <div class="form-group col-sm-2">
                <input type="text" class="form-control" id="valor_honorarios" name="valor_honorarios" placeholder="Valor honorários">
            </div>
        </div>
        <br>

        <!-- campos de glosas -->
        <div class="form-group row">
            <div class="form-group col-sm-2">
                <input type="text" class="form-control" id="glosa_diarias" name="glosa_diarias" placeholder="Glosa diárias">
            </div>
            <div class="form-group col-sm-2">
                <input type="text" class="form-control" id="glosa_matmed" name="glosa_matmed" placeholder="Glosa MatMed">
            </div>
            <div class="form-group col-sm-2">
                <input type="text" class="form-control" id="glosa_oxig" name="glosa_oxig" placeholder="Glosa Oxigenioterapia">
            </div>
            <div class="form-group col-sm-2">
                <input type="text" class="form-control" id="glosa_sadt" name="glosa_sadt" placeholder="Glosa taxas">
            </div>
            <div class="form-group col-sm-2">
                <input type="text" class="form-control" id="glosa_taxa" name="glosa_taxa" placeholder="Glosa SADT">
            </div>
            <div class="form-group col-sm-2">
                <input type="text" class="form-control" id="glosa_honorarios" name="glosa_honorarios" placeholder="Glosa honorários">
            </div>
        </div>
        <br>

        <!-- campos de glosas por profissional-->
        <div class="form-group row">
            <div class="form-group col-sm-2">
                <input type="text" class="form-control" id="valor_glosa_enf" name="valor_glosa_enf" placeholder="Glosa enfermagem">
            </div>
            <div class="form-group col-sm-2">
                <input type="text" class="form-control" id="valor_glosa_med" name="valor_glosa_med" placeholder="Glosa Médica">
            </div>
            <div class="form-group col-sm-2">
                <input type="text" class="form-control" id="valor_glosa_total" name="valor_glosa_total" placeholder="Glosa Total">
            </div>

        </div>

        <div> <button style="margin:10px" type="submit" class="btn-sm btn-success">Cadastrar</button>
        </div>
    </form>
</div>
<div>
    <a class="btn btn-success styled" style="margin-left:120px" href="cad_capeante.php">Novo Capeante</a>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>