<div class="row">
    <h4 class="page-title">Cadastrar visita</h4>
    <p class="page-description">Adicione informações sobre a visita</p>
    <form class="formulario" action="<?= $BASE_URL ?>process_visita.php" id="add-visita-form" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="type" value="create">

        <div class="form-group row">

            <div class="form-group col-sm-4">
                <label for="usuario_create">Usuário</label>
                <input type="text" class="form-control" class="form-control" id="usuario_create" value="<?= $_SESSION['username'] ?>" name="usuario_create">
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
            <br>
        </div>
        <button style="margin:10px" type="submit" class="btn-sm btn-info">Cadastrar</button>
    </form>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>