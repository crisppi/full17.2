<?php
include_once("check_logado.php");

require_once("templates/header.php");
require_once("dao/seguradoraDao.php");
require_once("models/message.php");

$seguradoraDao = new seguradoraDAO($conn, $BASE_URL);

// Receber id do usuário
$id_seguradora = filter_input(INPUT_GET, "id_seguradora");

if (empty($id_seguradora)) {

    if (!empty($userData)) {

        $id = $userData->id_seguradora;
    } else {

        //$message->setMessage("Usuário não encontrado!", "error", "index.php");
    }
} else {

    $userData = $userDao->findById($id_seguradora);

    // Se não encontrar usuário
    if (!$userData) {
        $message->setMessage("Seguradora não encontrada!", "error", "index.php");
    }
}

?>
<div id="main-container" class="container">
    <div class="row">
        <h1 class="page-title">Cadastrar Seguradora</h1>
        <p class="page-description">Adicione informações sobre a Seguradora</p>
        <form class="formulario" action="<?= $BASE_URL ?>process_seguradora.php" id="add-movie-form" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="type" value="create">
            <div class="form-group row">
                <div class="form-group col-sm-4">
                    <label for="seguradora_seg">Seguradora</label>
                    <input type="text" class="form-control" id="seguradora_seg" name="seguradora_seg" placeholder="Digite o nome da Seguradora" required>
                </div>

                <div class="form-group col-sm-1">
                    <label for="cnpj_seg">CNPJ</label>
                    <input type="text" oninput="mascara(this, 'cnpj')" class="form-control" id="cnpj_seg" name="cnpj_seg" placeholder="Digite o cnpj">
                </div>
            </div>
            <div class="form-group row">
                <div class="form-group col-sm-3">
                    <label for="endereco_seg">Endereço</label>
                    <input type="text" class="form-control" id="endereco_seg" name="endereco_seg" placeholder="Digite o endereço">
                </div>

                <div class="form-group col-sm-3">
                    <label for="bairro_seg">Bairro</label>
                    <input type="text" class="form-control" id="bairro_seg" name="bairro_seg" placeholder="Digite o bairro">
                </div>
                <div class="form-group col-sm-1">
                    <label for="numero_seg">Número</label>
                    <input type="text" class="form-control" id="numero_seg" name="numero_seg" placeholder="Digite o número">
                </div>
                <div class="form-group col-sm-3">
                    <label for="cidade_seg">Cidade</label>
                    <input type="text" class="form-control" id="cidade_seg" name="cidade_seg" placeholder="Digite a cidade">
                </div>
            </div>
            <div class="form-group row">

                <div class="form-group col-sm-2">
                    <label for="email01_seg">email01</label>
                    <input type="email" class="form-control" id="email01_seg" name="email01_seg" placeholder="Digite a email01">
                </div>
                <div class="form-group col-sm-2">
                    <label for="email02_seg">email02</label>
                    <input type="email" class="form-control" id="email02_seg" name="email02_seg" placeholder="Digite a email02">
                </div>
                <div class="form-group col-sm-2">
                    <label for="telefone01_seg">Telefone</label>
                    <input type="text" onkeydown="return mascara(this, 'tel')" class="form-control" id="telefone01_seg" name="telefone01_seg" placeholder="Digite o telefone">
                </div>
                <div class="form-group col-sm-2">
                    <label for="telefone02_seg">Telefone</label>
                    <input type="text" onkeydown="return mascara(this, 'tel')" class="form-control" id="telefone02_seg" name="telefone02_seg" placeholder="Digite outro telefone">
                </div>
                <div class="form-group col-sm-1">
                    <label class="control-label" for="ativo_seg">Ativo</label>
                    <select class="form-control" id="ativo_seg" name="ativo_seg">
                        <option value="Sim">Sim</option>
                        <option value="Não">Não</option>
                    </select>
                </div>
                <div class="form-group col-sm-4">
                    <?php $agora = date('d/m/Y'); ?>
                    <input class="oculto" type="text" class="form-control" id="data_create_seg" value='<?= $agora; ?>' name="data_create_seg" placeholder="">
                </div>
                <div class="form-group col-sm-4 oculto">
                    <input type="text" class=" form-control" id="usuario_create_seg" value="<?= $_SESSION['email_user'] ?>" name="usuario_create_seg" placeholder="Digite o usuário">
                </div>
                <div class="form-group col-sm-4">
                    <input type="text" class="form-control" id="fk_usuario_seg" value="<?= $_SESSION['id_usuario'] ?>" name="fk_usuario_seg" placeholder="Digite o usuário">
                </div>
            </div>
            <br>
            <button style="margin:10px" type="submit" class="btn-sm btn-info">Cadastrar</button>
            <br>
    </div>
    </form>
</div>
</div>

<script>
    function mascara(i) {

        var v = i.value;

        if (isNaN(v[v.length - 1])) { // impede entrar outro caractere que não seja número
            i.value = v.substring(0, v.length - 1);
            return;
        }

        i.setAttribute("maxlength", "14");
        if (v.length == 3 || v.length == 7) i.value += ".";
        if (v.length == 11) i.value += "-";

    }
</script>
<script>
    function mascara(i, t) {

        var v = i.value;

        if (isNaN(v[v.length - 1])) {
            i.value = v.substring(0, v.length - 1);
            return;
        }

        if (t == "data") {
            i.setAttribute("maxlength", "10");
            if (v.length == 2 || v.length == 5) i.value += "/";
        }

        if (t == "cpf") {
            i.setAttribute("maxlength", "14");
            if (v.length == 3 || v.length == 7) i.value += ".";
            if (v.length == 11) i.value += "-";
        }

        if (t == "cnpj") {
            i.setAttribute("maxlength", "18");
            if (v.length == 2 || v.length == 6) i.value += ".";
            if (v.length == 10) i.value += "/";
            if (v.length == 15) i.value += "-";
        }

        if (t == "cep") {
            i.setAttribute("maxlength", "9");
            if (v.length == 5) i.value += "-";
        }

        if (t == "tel") {
            if (v[0] == 12) {

                i.setAttribute("maxlength", "10");
                if (v.length == 5) i.value += "-";
                if (v.length == 0) i.value += "(";

            } else {
                i.setAttribute("maxlength", "9");
                if (v.length == 4) i.value += "-";
            }
        }
    }

    function mascaraTelefone(event) {
        let tecla = event.key;
        let telefone = event.target.value.replace(/\D+/g, "");

        if (/^[0-9]$/i.test(tecla)) {
            telefone = telefone + tecla;
            let tamanho = telefone.length;

            if (tamanho >= 12) {
                return false;
            }

            if (tamanho > 10) {
                telefone = telefone.replace(/^(\d\d)(\d{5})(\d{4}).*/, "($1) $2-$3");
            } else if (tamanho > 5) {
                telefone = telefone.replace(/^(\d\d)(\d{4})(\d{0,4}).*/, "($1) $2-$3");
            } else if (tamanho > 2) {
                telefone = telefone.replace(/^(\d\d)(\d{0,5})/, "($1) $2");
            } else {
                telefone = telefone.replace(/^(\d*)/, "($1");
            }

            event.target.value = telefone;
        }

        if (!["Backspace", "Delete"].includes(tecla)) {
            return false;
        }
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
<?php
require_once("templates/footer.php");
?>