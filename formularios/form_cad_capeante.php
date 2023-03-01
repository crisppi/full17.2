<div class="row">

    <h2 class="page-title">Lançar capeante</h2>
    <p class="page-description">Adicione informações sobre a internação</p>

    <form class="formulario visible" action="<?= $BASE_URL ?>process_capeante.php" id="add-internacao-form" method="POST" enctype="multipart/form-data">
        <input type="text" name="type" value="create">

        <div class="form-group row">
            <div>
                <input type="text" class="form-control" id="adm_capeante" name="adm_capeante" placeholder="Digite">
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