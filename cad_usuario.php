<?php
require_once("templates/header.php");
require_once("dao/usuarioDao.php");
require_once("models/message.php");

$usuarioDao = new userDAO($conn, $BASE_URL);

// Receber id do usuário
$id_usuario = filter_input(INPUT_GET, "id_usuario");

if (empty($id_usuario)) {

    if (!empty($userData)) {

        $id = $userData->id_usuario;
    } else {

        //$message->setMessage("Usuário não encontrado!", "error", "index.php");
    }
} else {

    $userData = $userDao->findById($id_usuario);

    // Se não encontrar usuário
    if (!$userData) {
        $message->setMessage("Usuário não encontrado!", "error", "index.php");
    }
}

?>
<div id="main-container" class="container-fluid">
    <div class="row">
        <h1 class="page-title">Cadastrar Usuário</h1>
        <p class="page-description">Adicione informações sobre o usuário</p>
        <form class="formulario" action="<?= $BASE_URL ?>process_usuario.php" id="add-movie-form" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="type" value="create">
            <div class="form-group row">
                <div class="form-group col-sm-4">
                    <label for="usuario_user">Usuário</label>
                    <input type="text" class="form-control" id="usuario_user" name="usuario_user" placeholder="Digite o nome do usuário" required>
                </div>
                <div class="form-group col-sm-1">
                    <label for="idade_user">Idade</label>
                    <input type="text" class="form-control" id="idade_user" name="idade_user" placeholder="Digite a idade">
                </div>
                <div class="form-group col-sm-1 ">
                    <label class="control-label" for="sexo_user">Sexo</label>
                    <select class="form-control" name="sexo_user">
                        <option value="">Selecione</option>
                        <option value="Feminino">Feminino</option>
                        <option value="Masculino">Masculino</option>
                    </select>
                </div>
                <div class="form-group col-sm-3">
                    <label for="mae_user">Mãe</label>
                    <input type="text" class="form-control" id="mae_user" name="mae_user" placeholder="Digite a mae">
                </div>
            </div>
            <div class="form-group row">
                <div class="form-group col-sm-3">
                    <label for="endereco_user">Endereço</label>
                    <input type="text" class="form-control" id="endereco_user" name="endereco_user" placeholder="Digite a endereco">
                </div>
                <div class="form-group col-sm-3">
                    <label for="numero_user">Número</label>
                    <input type="text" class="form-control" id="numero_user" name="numero_user" placeholder="Digite o numero">
                </div>
                <div class="form-group col-sm-3">
                    <label for="bairro_user">Bairro</label>
                    <input type="text" class="form-control" id="bairro_user" name="bairro_user" placeholder="Digite o bairro">
                </div>
                <div class="form-group col-sm-3">
                    <label for="cidade_user">Cidade</label>
                    <input type="text" class="form-control" id="cidade_user" name="cidade_user" placeholder="Digite a cidade">
                </div>
            </div>
            <div class="form-group row">

                <div class="form-group col-sm-1">
                    <label for="cpf_user">CPF</label>
                    <input type="text" oninput="mascara(this, 'cpf')" class="form-control" id="cpf_user" name="cpf_user" placeholder="Digite a cpf">
                </div>
                <div class="form-group col-sm-2">
                    <label for="email_user">email01</label>
                    <input type="email" class="form-control" id="email_user" name="email_user" placeholder="Digite a email01">
                </div>
                <div class="form-group col-sm-2">
                    <label for="email02_user">email02</label>
                    <input type="email" class="form-control" id="email02_user" name="email02_user" placeholder="Digite a email02">
                </div>
                <div class="form-group col-sm-2">
                    <label for="telefone01_user">Telefone</label>
                    <input type="text" onkeydown="return mascara(this, 'tel')" class="form-control" id="telefone01_user" name="telefone01_user" placeholder="Digite o telefone">
                </div>
                <div class="form-group col-sm-2">
                    <label for="telefone02_user">Telefone</label>
                    <input type="text" onkeydown="return mascara(this, 'tel')" class="form-control" id="telefone02_user" name="telefone02_user" placeholder="Digite outro telefone">
                </div>
                <div class="form-group col-sm-1">
                    <label class="control-label" for="ativo_user">Ativo</label>
                    <select class="form-control" id="ativo_user" name="ativo_user">
                        <option value="Sim">Sim</option>
                        <option value="Não">Não</option>
                    </select>
                </div>
                <!-- <div class="form-group col-sm-4">
                    <input class="oculto" type="date" type="hidden" class="form-control" id="data_create" name="data_create" placeholder="">
                </div>
                <div class="form-group col-sm-4 oculto">
                    <input type="text" class="form-control" id="usuario_create" name="usuario_create" placeholder="Digite o usuário">
                </div> -->
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


<?php
require_once("templates/footer1.php");
?>