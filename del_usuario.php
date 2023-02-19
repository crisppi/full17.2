<?php
include_once("check_logado.php");

require_once("globals.php");
require_once("db.php");
require_once("models/usuario.php");
require_once("models/message.php");
require_once("dao/usuarioDao.php");
?>
<script>
    $(document).ready(function() {
        $('a[delete-btn]').click(function(ev) {
            var href = $(this).attr('href');
            $('.btn_acoes').removeClass('oculto');
            $('.btn_acoes').addClass('visible');
            if (!$('#confirm-delete').length) {
                $('body').append('<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"><div class="modal-dialog"><div class="modal-content"><div class="modal-header bg-danger text-white">EXCLUIR ITEM<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></div><div class="modal-body">Tem certeza de que deseja excluir o item selecionado?</div><div class="modal-footer"><button type="button" class="btn btn-success" data-dismiss="modal">Cancelar</button><a class="btn btn-danger text-white" id="dataComfirmOK">Apagar</a></div></div></div></div>');
            }
            $('#dataComfirmOK').attr('href', href);
            $('#confirm-delete').modal({
                show: true
            });
            return false;

        });

    });

    <?php
    $message = new Message($BASE_URL);
    $usuarioDao = new userDAO($conn, $BASE_URL);
    // Resgata o tipo do formulário

    $type = "delete";
    //$type = filter_input(INPUT_POST, "type");

    if ($type === "delete") {
        // Recebe os dados do form
        $id_usuario = filter_input(INPUT_GET, "id_usuario");

        $usuarioDao = new userDAO($conn, $BASE_URL);

        $usuario = $usuarioDao->findById_user($id_usuario);

        if ($usuario) {

            $usuarioDao->destroy($id_usuario);

            //include_once('list_usuario.php');
        } else {

            //$message->setMessage("Informações inválidas!", "error", "index.php");
        }
    }
